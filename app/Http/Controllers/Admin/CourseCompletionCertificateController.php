<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\CollegeDepartment;
use App\Models\CourseCompletion;
use App\Models\Faculty;
use App\Models\Program;
use App\Models\Session;
use Illuminate\Http\Request;

class CourseCompletionCertificateController extends Controller
{
    private array $types = [
        'inter' => ['label' => 'Inter', 'access' => 'inter-clc'],
        'degree' => ['label' => 'Degree', 'access' => 'degree-clc'],
        'nursing' => ['label' => 'Nursing', 'access' => 'nursing-clc'],
        'pharmacy' => ['label' => 'Pharmacy', 'access' => 'old-student'],
        'education' => ['label' => 'Education', 'access' => 'education-clc'],
        'engineering' => ['label' => 'Engineering', 'access' => 'engineering-clc'],
    ];

    private function config(string $type): array
    {
        abort_unless(isset($this->types[$type]), 404);
        return $this->types[$type];
    }

    private function baseData(string $type): array
    {
        $config = $this->config($type);
        $departmentId = auth()->user()->is_admin === 0 ? auth()->user()->college_department_id : null;

        $batches = Batch::where('status', 1);
        $programs = Program::where('status', 1);
        $faculties = Faculty::where('status', 1);

        if ($departmentId) {
            $batches->where('department_id', $departmentId);
            $programs->where('department_id', $departmentId);
            $faculties->where('department_id', $departmentId);
        }

        return [
            'type' => $type,
            'title' => $config['label'] . ' Course Completion Certificate',
            'access' => $config['access'],
            'departments' => $departmentId
                ? CollegeDepartment::where('id', $departmentId)->where('status', 1)->get()
                : CollegeDepartment::where('status', 1)->orderBy('title')->get(),
            'faculties' => $faculties->orderBy('title')->get(),
            'programs' => $programs->orderBy('title')->get(),
            'sessions' => Session::where('status', 1)->orderByDesc('id')->get(),
            'batches' => $batches->orderByDesc('id')->get(),
        ];
    }

    public function index(Request $request, string $type)
    {
        $data = $this->baseData($type);

        $data['selected_department'] = $request->get('department', '0');
        $data['selected_faculty'] = $request->get('faculty', '0');
        $data['selected_program'] = $request->get('program', '0');
        $data['selected_session'] = $request->get('session', '0');
        $data['selected_student_id'] = $request->get('student_id');
        $data['selected_student_regi'] = $request->get('student_regi');

        $rows = CourseCompletion::with(['batch', 'program.faculty', 'program.department', 'session'])
            ->where('type', $type)
            ->where('status', 1);

        if (auth()->user()->is_admin === 0) {
            $departmentId = auth()->user()->college_department_id;
            $rows->whereHas('program', fn ($query) => $query->where('department_id', $departmentId));
        }

        if ($data['selected_department'] !== '0') {
            $department = $data['selected_department'];
            $rows->whereHas('program', fn ($query) => $query->where('department_id', $department));
        }

        if ($data['selected_faculty'] !== '0') {
            $faculty = $data['selected_faculty'];
            $rows->whereHas('program', fn ($query) => $query->where('faculty_id', $faculty));
        }

        if ($data['selected_program'] !== '0') {
            $rows->where('program_id', $data['selected_program']);
        }

        if ($data['selected_session'] !== '0') {
            $rows->where('session_id', $data['selected_session']);
        }

        if (!empty($data['selected_student_id'])) {
            $rows->where('student_id', 'like', '%' . $data['selected_student_id'] . '%');
        }

        if (!empty($data['selected_student_regi'])) {
            $rows->where('registration_no', 'like', '%' . $data['selected_student_regi'] . '%');
        }

        $data['rows'] = $rows->orderByDesc('id')->get();

        return view('admin.course-completion.index', $data);
    }

    public function create(string $type)
    {
        return view('admin.course-completion.create', $this->baseData($type));
    }

    public function store(Request $request, string $type)
    {
        $this->config($type);

        $validated = $request->validate([
            'student_id' => 'required|string|max:191',
            'registration_no' => 'nullable|string|max:191',
            'name' => 'required|string|max:191',
            'father_name' => 'required|string|max:191',
            'mother_name' => 'nullable|string|max:191',
            'date' => 'required|date',
            'course_start_date' => 'required|date',
            'course_end_date' => 'required|date|after_or_equal:course_start_date',
            'relieving_date' => 'required|date|after_or_equal:course_start_date',
            'college_name' => 'nullable|string|max:191',
            'batch_id' => 'required|exists:batches,id',
            'program_id' => 'required|exists:programs,id',
            'session_id' => 'required|exists:sessions,id',
        ]);

        $nextSerial = ((int) CourseCompletion::where('type', $type)->max('serial_no')) + 1;

        CourseCompletion::create(array_merge($validated, [
            'type' => $type,
            'serial_no' => $nextSerial,
            'status' => 1,
        ]));

        return redirect()
            ->route('admin.course-completion.index', ['type' => $type])
            ->with(['message' => __('msg_created_successfully'), 'alert-type' => __('msg_success')]);
    }

    public function edit(string $type, CourseCompletion $courseCompletion)
    {
        $this->ensureType($type, $courseCompletion);
        $data = $this->baseData($type);
        $data['row'] = $courseCompletion;

        return view('admin.course-completion.edit', $data);
    }

    public function update(Request $request, string $type, CourseCompletion $courseCompletion)
    {
        $this->ensureType($type, $courseCompletion);

        $validated = $request->validate([
            'student_id' => 'required|string|max:191',
            'registration_no' => 'nullable|string|max:191',
            'name' => 'required|string|max:191',
            'father_name' => 'required|string|max:191',
            'mother_name' => 'nullable|string|max:191',
            'date' => 'required|date',
            'course_start_date' => 'required|date',
            'course_end_date' => 'required|date|after_or_equal:course_start_date',
            'relieving_date' => 'required|date|after_or_equal:course_start_date',
            'college_name' => 'nullable|string|max:191',
            'batch_id' => 'required|exists:batches,id',
            'program_id' => 'required|exists:programs,id',
            'session_id' => 'required|exists:sessions,id',
        ]);

        $courseCompletion->update($validated);

        return redirect()
            ->route('admin.course-completion.index', ['type' => $type])
            ->with(['message' => __('msg_updated_successfully'), 'alert-type' => __('msg_success')]);
    }

    public function destroy(string $type, CourseCompletion $courseCompletion)
    {
        $this->ensureType($type, $courseCompletion);
        $courseCompletion->delete();

        return redirect()
            ->route('admin.course-completion.index', ['type' => $type])
            ->with(['message' => __('msg_deleted_successfully'), 'alert-type' => __('msg_success')]);
    }

    public function print(string $type, CourseCompletion $courseCompletion)
    {
        $this->ensureType($type, $courseCompletion);
        $courseCompletion->load(['batch', 'program', 'session']);

        return view('admin.course-completion.print', [
            'type' => $type,
            'title' => $this->config($type)['label'] . ' Course Completion Certificate',
            'row' => $courseCompletion,
        ]);
    }

    private function ensureType(string $type, CourseCompletion $courseCompletion): void
    {
        $this->config($type);
        abort_unless($courseCompletion->type === $type, 404);
    }
}
