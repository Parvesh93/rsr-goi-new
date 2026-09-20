<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StudentsImport;
use App\Models\StudentRelative;
use App\Models\Refrence;
use App\Models\CashReceived;
use App\Models\BankReceived;
use App\Models\IdCardSetting;
use App\Models\StudentEnroll;
use App\Models\EnrollSubject;
use Illuminate\Http\Request;
use App\Traits\FileUploader;
use App\Models\MailSetting;
use App\Mail\SendPassword;
use App\Models\StatusType;
use App\Models\Province;
use App\Models\CollegeDepartment;
use App\Models\ApplicationSetting;
use App\Models\Application;
use App\Models\District;
use App\Models\Semester;
use App\Models\Document;
use App\Models\Session;
use App\Models\Program;
use App\Models\Section;
use App\Models\Student;
use App\Models\Deduction;
use App\Models\Faculty;
use App\Models\Batch;
use App\Models\Grade;
use App\Models\Fee;
use Carbon\Carbon;
use Toastr;
use Auth;
use Hash;
use Mail;
use DB;

class StudentController extends Controller
{
    use FileUploader;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Module Data
        $this->title = trans_choice('module_student', 1);
        $this->route = 'admin.student';
        $this->view = 'admin.student';
        $this->path = 'student';
        $this->access = 'student';


        $this->middleware('permission:' . $this->access . '-view|' . $this->access . '-create|' . $this->access . '-edit|' . $this->access . '-delete|' . $this->access . '-card', ['only' => ['index', 'show', 'status', 'sendPassword']]);
        $this->middleware('permission:' . $this->access . '-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:' . $this->access . '-edit', ['only' => ['edit', 'update', 'status']]);
        $this->middleware('permission:' . $this->access . '-delete', ['only' => ['destroy']]);
        $this->middleware('permission:' . $this->access . '-password-print', ['only' => ['printPassword', 'multiPrintPassword']]);
        $this->middleware('permission:' . $this->access . '-password-change', ['only' => ['passwordChange']]);
        $this->middleware('permission:' . $this->access . '-card', ['only' => ['index', 'card']]);
        $this->middleware('permission:' . $this->access . '-import', ['only' => ['index', 'import', 'importStore']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        // dd('success');
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;
        $data['access'] = $this->access;

        // if(!empty($request->college_status) || $request->college_status != null){
        //     $data['selected_college_id'] = $college = $request->college_status;
        // }
        // else{
        //     $data['selected_college_id'] = $college = '0';
        // }


        if (auth()->user()->is_admin === 1) {
            // Admin ko saari faculties dikhni chahiye

            if (!empty($request->department) || $request->department != null) {
                $data['college_department'] = $department = $request->department;
            } else {
                $data['college_department']  = $department = '0';
            }

            if (!empty($request->faculty) || $request->faculty != null) {
                $data['selected_faculty'] = $faculty = $request->faculty;
            } else {
                $data['selected_faculty'] = $faculty = '0';
            }

            if (!empty($request->program) || $request->program != null) {
                $data['selected_program'] = $program = $request->program;
            } else {
                $data['selected_program'] = $program = '0';
            }

            if (!empty($request->session) || $request->session != null) {
                $data['selected_session'] = $session = $request->session;
            } else {
                $data['selected_session'] = $session = '0';
            }

            if (!empty($request->semester) || $request->semester != null) {
                $data['selected_semester'] = $semester = $request->semester;
            } else {
                $data['selected_semester'] = $semester = '0';
            }

            if (!empty($request->section) || $request->section != null) {
                $data['selected_section'] = $section = $request->section;
            } else {
                $data['selected_section'] = $section = '0';
            }

            if (!empty($request->status) || $request->status != null) {
                $data['selected_status'] = $status = $request->status;
            } else {
                $data['selected_status'] = '0';
            }





            if (!empty($request->student_id) || $request->student_id != null) {
                $data['selected_student_id'] = $student_id = $request->student_id;
            } else {
                $data['selected_student_id'] = $student_id =  Null;
            }

            if (!empty($request->student_regi) || $request->student_regi != null) {
                $data['selected_student_regi'] = $student_regi = $request->student_regi;
            } else {
                $data['selected_student_regi'] = $student_regi = Null;
            }

            if (!empty($request->person) || $request->person != null) {
                $data['selected_person'] = $person = $request->person;
            } else {
                $data['selected_person'] = $person = '0';
            }

            $data['persons'] = Student::pluck('refrence_person_name');


            $data['departments'] = CollegeDepartment::where('status', '1')->orderBy('title', 'asc')->get();

            $data['faculties'] = Faculty::where('status', '1')
                ->orderBy('title', 'asc')
                ->get();

            $data['statuses'] = StatusType::where('status', '1')->orderBy('title', 'asc')->get();


            if (!empty($request->faculty) && $request->faculty != '0') {
                $data['programs'] = Program::where('faculty_id', $faculty)->where('status', '1')->orderBy('title', 'asc')->get();
            }

            if (!empty($request->program) && $request->program != '0') {
                $sessions = Session::where('status', 1);
                $sessions->with('programs')->whereHas('programs', function ($query) use ($program) {
                    $query->where('program_id', $program);
                });
                $data['sessions'] = $sessions->orderBy('id', 'desc')->get();
            }

            if (!empty($request->program) && $request->program != '0') {
                $semesters = Semester::where('status', 1);
                $semesters->with('programs')->whereHas('programs', function ($query) use ($program) {
                    $query->where('program_id', $program);
                });
                $data['semesters'] = $semesters->orderBy('id', 'asc')->get();
            }

            if (!empty($request->program) && $request->program != '0' && !empty($request->semester) && $request->semester != '0') {
                $sections = Section::where('status', 1);
                $sections->with('semesterPrograms')->whereHas('semesterPrograms', function ($query) use ($program, $semester) {
                    $query->where('program_id', $program);
                    $query->where('semester_id', $semester);
                });
                $data['sections'] = $sections->orderBy('title', 'asc')->get();
            }


            if (isset($request->faculty) || isset($request->program) || isset($request->session) || isset($request->semester) || isset($request->section) || isset($request->status) || isset($request->student_id) || isset($request->student_regi)
                || isset($request->person)) {
                // Student Filter
                $students = Student::where('status', '1');
                if ($faculty != 0) {
                    $students->with('program')->whereHas('program', function ($query) use ($faculty) {
                        $query->where('faculty_id', $faculty);
                    });
                }
                $students->with('currentEnroll')->whereHas('currentEnroll', function ($query) use ($program, $session, $semester, $section) {
                    if ($program != 0) {
                        $query->where('program_id', $program);
                    }
                    if ($session != 0) {
                        $query->where('session_id', $session);
                    }
                    if ($semester != 0) {
                        $query->where('semester_id', $semester);
                    }
                    if ($section != 0) {
                        $query->where('section_id', $section);
                    }
                });
                if (!empty($request->status)) {
                    $students->with('statuses')->whereHas('statuses', function ($query) use ($status) {
                        $query->where('status_type_id', $status);
                    });
                }
                if (!empty($request->student_id)) {
                    $students->where('student_id', 'LIKE', '%' . $student_id . '%');
                }

                if (!empty($request->student_regi)) {
                    $students->where('registration_no', 'LIKE', '%' . $student_regi . '%');
                }


                 if (!empty($request->person)) {
                    $students->where('refrence_person_name', $person);
                }
                $rows = $students->orderBy('student_id', 'desc')->get();

                // Array Sorting
                $data['rows'] = $rows->sortByDesc(function ($query) {

                    return $query->student_id;
                })->all();
            }


            $data['print'] = IdCardSetting::where('slug', 'student-card')->first();


            return view($this->view . '.index', $data);
        } elseif (auth()->user()->is_admin === 0) {
            // Teacher ko sirf uske department ki faculties dikhni chahiye

            $teacherDepa = auth()->user()->teacher_department; // ya ->faculty_name
            $collegeDepartment = auth()->user()->college_department_id;

            $data['persons'] = Student::pluck('refrence_person_name');


            $fac = Faculty::where('status', '1')
                ->where('teacher_department', $teacherDepa) // column match karo
                ->orderBy('title', 'asc')
                ->first();
            //  dd($fac);

            if (!empty($request->department) || $request->department != null) {
                $data['college_department'] = $department = $request->department;
            } else {
                $data['college_department']  = $department =  $collegeDepartment;
            }

            if (!empty($request->faculty) || $request->faculty != null) {
                $data['selected_faculty'] = $faculty = $request->faculty;
            } else {
                $data['selected_faculty'] = $faculty = $fac->id ?? null;
            }
            if (!empty($request->program) || $request->program != null) {
                $data['selected_program'] = $program = $request->program;
            } else {
                $data['selected_program'] = $program = $teacherDepa ?? null;
            }



            $data['selected_session'] = $session = $request->session ?? null;
            $data['selected_semester'] = $semester = $request->semester ?? null;
            $data['selected_section'] = $section = $request->section ?? null;
            $data['selected_status'] = $status = $request->status ?? null;
            $data['selected_student_id'] = $student_id = $request->student_id ?? null;

            if (!empty($request->student_regi) || $request->student_regi != null) {
                $data['selected_student_regi'] = $student_regi = $request->student_regi;
            } else {
                $data['selected_student_regi'] =$student_regi = Null;
            }

            if (!empty($request->person) || $request->person != null) {
                $data['selected_person'] = $person = $request->person;
            } else {
                $data['selected_person'] = $person = '0';
            }
            
            $data['persons'] = Student::pluck('refrence_person_name');

            // dd($faculty);


            $data['departments'] = CollegeDepartment::where('id', $collegeDepartment)->where('status', '1')->orderBy('title', 'asc')->get();



            $data['faculties'] = Faculty::where('status', '1')
                ->where('department_id', $collegeDepartment) // column match karo
                ->orderBy('title', 'asc')
                ->get();

            $data['statuses'] = StatusType::where('status', '1')->orderBy('title', 'asc')->get();

            // dd($request->faculty);

            if (!empty($request->faculty) && $request->faculty != '0' || !empty($faculty)) {
                //  dd($faculty);
                $data['programs'] = Program::where('faculty_id', $faculty)->where('status', '1')->orderBy('title', 'asc')->get();
                // dd($da);

            }

            if (!empty($request->program) && $request->program != '0') {
                $sessions = Session::where('status', 1);
                $sessions->with('programs')->whereHas('programs', function ($query) use ($program) {
                    $query->where('program_id', $program);
                });
                $data['sessions'] = $sessions->orderBy('id', 'desc')->get();
            }

            if (!empty($request->program) && $request->program != '0') {
                $semesters = Semester::where('status', 1);
                $semesters->with('programs')->whereHas('programs', function ($query) use ($program) {
                    $query->where('program_id', $program);
                });
                $data['semesters'] = $semesters->orderBy('id', 'asc')->get();
            }

            if (!empty($request->program) && $request->program != '0' && !empty($request->semester) && $request->semester != '0') {
                $sections = Section::where('status', 1);
                $sections->with('semesterPrograms')->whereHas('semesterPrograms', function ($query) use ($program, $semester) {
                    $query->where('program_id', $program);
                    $query->where('semester_id', $semester);
                });
                $data['sections'] = $sections->orderBy('title', 'asc')->get();
            }


            if (
                isset($request->faculty) || isset($request->program) || isset($request->session) || isset($request->semester) || isset($request->section) || isset($request->status) || isset($request->student_id)
                || isset($request->student_regi) || isset($request->person)
            ) {
                // Student Filter
                $students = Student::where('status', '1');
                if ($faculty != 0) {
                    $students->with('program')->whereHas('program', function ($query) use ($faculty) {
                        $query->where('faculty_id', $faculty);
                    });
                }
                $students->with('currentEnroll')->whereHas('currentEnroll', function ($query) use ($program, $session, $semester, $section) {
                    if ($program != 0) {
                        $query->where('program_id', $program);
                    }
                    if ($session != 0) {
                        $query->where('session_id', $session);
                    }
                    if ($semester != 0) {
                        $query->where('semester_id', $semester);
                    }
                    if ($section != 0) {
                        $query->where('section_id', $section);
                    }
                });
                if (!empty($request->status)) {
                    $students->with('statuses')->whereHas('statuses', function ($query) use ($status) {
                        $query->where('status_type_id', $status);
                    });
                }
                if (!empty($request->student_id)) {
                    $students->where('student_id', 'LIKE', '%' . $student_id . '%');
                }

                if (!empty($request->person)) {
                    $students->where('refrence_person_name', $person);
                }

                if (!empty($request->student_regi)) {
                    $students->where('registration_no', 'LIKE', '%' . $student_regi . '%');
                }

                $rows = $students->orderBy('student_id', 'desc')->get();

                // Array Sorting
                $data['rows'] = $rows->sortByDesc(function ($query) {

                    return $query->student_id;
                })->all();
            }


            $data['print'] = IdCardSetting::where('slug', 'student-card')->first();


            return view($this->view . '.index', $data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        // dd('success');
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;




        if (auth()->user()->is_admin === 1) {
            // Admin ko saari batches dikhni chahiye
            $data['batches'] = Batch::where('status', '1')->orderBy('id', 'desc')->get();
            $data['is_admin'] = auth()->user()->is_admin;

            $data['statuses'] = StatusType::where('status', '1')->orderBy('title', 'asc')->get();
            $data['provinces'] = Province::where('status', '1')->orderBy('title', 'asc')->get();

            return view($this->view . '.create', $data);
        } elseif (auth()->user()->is_admin === 0) {
            // Teacher ko sirf uske department ki batch dikhni chahiye
            $teacherDepartment = auth()->user()->teacher_department; // ya ->faculty_name

            $collegeDepartment = auth()->user()->college_department_id;

            $batche = Batch::where('status', '1')->where('department_id', $collegeDepartment);

            //  $batche->with('programs')->whereHas('programs', function ($query) use ($teacherDepartment){
            //             $query->where('program_id', $teacherDepartment);
            //         });
            $sessions = Session::where('status', 1);
            $sessions->with('programs')->whereHas('programs', function ($query) use ($teacherDepartment) {
                $query->where('program_id', $teacherDepartment);
            });

            $data['sessions'] = $sessions->orderBy('id', 'desc')->get();

            $semesters = Semester::where('status', 1);
            $semesters->with('programs')->whereHas('programs', function ($query) use ($teacherDepartment) {
                $query->where('program_id', $teacherDepartment);
            });
            $data['semesters'] = $semesters->orderBy('id', 'asc')->get();

            $allSections = [];

            foreach ($semesters as $key => $semester) {
                $sem = $semester->id;

                $sections = Section::where('status', 1)
                    ->with('semesterPrograms')
                    ->whereHas('semesterPrograms', function ($query) use ($teacherDepartment, $sem) {
                        $query->where('program_id', $teacherDepartment)
                            ->where('semester_id', $sem);
                    })
                    ->orderBy('title', 'asc')
                    ->get();

                // Store by semester ID
                $allSections[$sem] = $sections;
            }

            //    Store globally in $data

            $data['all_sections'] = $allSections;

            $data['is_admin'] = auth()->user()->is_admin;
            $data['programs'] = Program::where('department_id', $collegeDepartment)->where('status', '1')->orderBy('title', 'asc')->get();

            $data['batches'] = $batche->orderBy('title', 'asc')->get();

            $data['statuses'] = StatusType::where('status', '1')->orderBy('title', 'asc')->get();
            $data['provinces'] = Province::where('status', '1')->orderBy('title', 'asc')->get();

            return view($this->view . '.create', $data);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Field Validation
        $request->validate([
            'student_id' => 'required|unique:students,student_id',
            'batch' => 'required',
            'program' => 'required',
            'session' => 'required',
            'semester' => 'required',
            // 'section' => 'required',
            'first_name' => 'required',

            'email' => 'required|email|unique:students,email',
            'phone' => 'required',
            'gender' => 'required',
            'caste' => 'required',
            'admission_mode' => 'required',
            'total_course_fees' => 'required',

            'dob' => 'required|date',
            'admission_date' => 'required|date',

            'photo' => 'nullable|image',
            'signature' => 'nullable|image',
        ]);

        // dd($request->college_status);
        // Random Password
        $password = str_random(8);

        // Insert Data
        try {
            DB::beginTransaction();

            $student = new Student;
            $student->student_id = $request->student_id;
            $student->batch_id = $request->batch;
            $student->program_id = $request->program;
            $student->admission_date = $request->admission_date;

            $student->first_name = $request->first_name;
            $student->last_name = $request->last_name;
            $student->father_name = $request->father_name;
            $student->mother_name = $request->mother_name;
            $student->father_occupation = $request->father_occupation;
            $student->mother_occupation = $request->mother_occupation;
            $student->email = $request->email;
            $student->password = Hash::make($password);
            $student->password_text = Crypt::encryptString($password);

            $student->country = $request->country;
            $student->present_province = $request->present_province;
            $student->present_district = $request->present_district;
            $student->present_village = $request->present_village;
            $student->present_address = $request->present_address;
            $student->present_post = $request->present_post;
            $student->present_pin = $request->present_pin;
            $student->present_police_station = $request->present_police_station;

            $student->permanent_province = $request->permanent_province;
            $student->permanent_district = $request->permanent_district;
            $student->permanent_village = $request->permanent_village;
            $student->permanent_address = $request->permanent_address;
            $student->permanent_post = $request->permanent_post;
            $student->permanent_pin = $request->permanent_pin;
            $student->permanent_police_station = $request->permanent_police_station;


            $student->gender = $request->gender;

            $student->pan_id = $request->pan_id;

            $student->dob = $request->dob;
            $student->phone = $request->phone;
            // $student->emergency_phone = $request->emergency_phone;

            $student->religion = $request->religion;
            $student->caste = $request->caste;
            $student->mother_tongue = $request->mother_tongue;
            $student->marital_status = $request->marital_status;
            $student->blood_group = $request->blood_group;
            $student->nationality = $request->nationality;
            $student->national_id = $request->national_id;
            $student->passport_no = $request->passport_no;


            $student->high_school_name = $request->high_school_name;
            $student->high_school_address = $request->high_school_study_address;
            $student->high_school_graduation_year = $request->high_school_graduation_year;
            $student->high_school_graduation_percentage = $request->high_school_graduation_percentage;
            $student->high_school_total_marks = $request->high_school_total_marks;
            $student->high_school_marks_obtained = $request->high_school_total_marks_obtained;


            $student->intermediate_name = $request->intermediate_name;
            $student->intermediate_address = $request->intermediate_study_address;
            $student->intermediate_graduation_year = $request->intermediate_graduation_year;
            $student->inter_graduation_percentage = $request->intermediate_graduation_percentage;
            $student->intermediate_total_marks = $request->intermediate_total_marks;
            $student->intermediate_marks_obtained = $request->intermediate_total_marks_obtained;

            $student->bach_college_name = $request->bachelor_college_name;
            $student->bach_college_address = $request->bachelor_study_address;
            $student->bach_gradu_year = $request->bachelor_graduation_year;
            $student->bach_gradu_percentage = $request->bachelor_graduation_percentage;
            $student->bach_total_marks = $request->bachelor_total_marks;
            $student->bach_marks_obtained = $request->bachelor_total_marks_obtained;



            $student->master_college_name = $request->master_college_name;
            $student->master_college_address = $request->master_study_address;
            $student->master_gradu_year = $request->master_graduation_year;
            $student->master_gradu_percentage = $request->master_graduation_percentage;
            $student->master_total_marks = $request->master_total_marks;
            $student->master_marks_obtained = $request->master_total_marks_obtained;





            if ($request->has('total_amounts')) {
                $student->total_amounts = $request->total_amounts;
            }

            if ($request->has('RefT')) {
                $student->refTotal = $request->RefT;
            }
            if ($request->has('CashT')) {
                $student->cashTotal = $request->CashT;
            }
            if ($request->has('BankT')) {
                $student->bankTotal = $request->BankT;
            }

            if ($request->has('deductionT')) {
                $student->deductionTotal = $request->deductionT;
            }


            $student->admission_mode = $request->admission_mode;
            $student->total_course_fees = $request->total_course_fees;
            $student->refrence_person_name = $request->refrence_person_name;
            $student->refrence_person_contact = $request->refrence_person_contact;


            $student->school_transcript = $this->uploadMedia($request, 'high_school_certificate', $this->path);
            $student->high_school_certificate = $this->uploadMedia($request, 'high_school_certi', $this->path);
            $student->school_slc = $this->uploadMedia($request, 'high_school_slc', $this->path);

            $student->school_certificate = $this->uploadMedia($request, 'intermediate_certificate', $this->path);
            $student->intermediate_certificate = $this->uploadMedia($request, 'intermediate_certi', $this->path);
            $student->intermediate_clc = $this->uploadMedia($request, 'intermediate_clc', $this->path);
            $student->intermediate_migration = $this->uploadMedia($request, 'intermediate_migration', $this->path);

            $student->collage_transcript = $this->uploadMedia($request, 'bachelor_certificate', $this->path);
            $student->collage_certificate = $this->uploadMedia($request, 'master_certificate', $this->path);
            $student->collage_migration = $this->uploadMedia($request, 'graduation_migration', $this->path);

            $student->adhar_card = $this->uploadMedia($request, 'adhar_card', $this->path);
            $student->parents_id = $this->uploadMedia($request, 'parents_id', $this->path);
            $student->pan_card = $this->uploadMedia($request, 'pan_card', $this->path);

            $student->domicile = $this->uploadMedia($request, 'domicile', $this->path);
            $student->caste_certificate = $this->uploadMedia($request, 'caste_certificate', $this->path);


            $student->photo = $this->uploadImage($request, 'photo', $this->path, 300, 300);
            $student->signature = $this->uploadImage($request, 'signature', $this->path, 300, 100);

            $student->bonafide_certificate = $this->uploadMedia($request, 'bonafide_certificate', $this->path);
            $student->drcc_receiving = $this->uploadMedia($request, 'drcc_receiving', $this->path);
            $student->tpva_form = $this->uploadMedia($request, 'tpva_form', $this->path);
            $student->drcc_selection_letter = $this->uploadMedia($request, 'drcc_selection_letter', $this->path);

            $student->status = '1';
            $student->created_by = Auth::guard('web')->user()->id;
            $student->save();

            $student->registration_no = '000' . $student->id;
            $student->cls_no = 7279 + $student->id;
            $student->save();




            // Attach Status
            $student->statuses()->attach($request->statuses);




            // Student Relatives
            if (is_array($request->relations)) {
                foreach ($request->relations as $key => $relation) {
                    if ($relation != '' && $relation != null) {
                        // Insert Data
                        $relation = new StudentRelative;
                        $relation->student_id = $student->id;

                        $relation->relation = $request->relations[$key];
                        $relation->name = $request->relative_names[$key];
                        $relation->occupation = $request->occupations[$key];
                        // $relation->email = $request->relative_emails[$key];
                        $relation->phone = $request->relative_phones[$key];
                        $relation->address = $request->addresses[$key];
                        $relation->save();
                    }
                }
            }



            if (is_array($request->refrence_ids)) {
                foreach ($request->refrence_ids as $key => $refrence) {
                    if ($refrence != '' && $refrence != null) {
                        // Insert Data
                        $reference = new Refrence();
                        $reference->student_id = $student->id;
                        $reference->utr_no = $request->refrence_ids[$key];
                        $reference->ref_amount = $request->ref_amounts[$key];
                        $reference->ref_date = $request->ref_dates[$key];
                        $reference->ref_name = $request->ref_names[$key];
                        $reference->save();
                    }
                }
            }

            if (is_array($request->cash_ids)) {
                foreach ($request->cash_ids as $key => $cash) {
                    if ($cash != '' && $cash != null) {
                        // Insert Data
                        $cashReceived = new CashReceived();
                        $cashReceived->student_id = $student->id;
                        $cashReceived->utr_no = $request->cash_ids[$key];
                        $cashReceived->cash_amount = $request->cash_amounts[$key];
                        $cashReceived->cash_date = $request->cash_dates[$key];
                        $cashReceived->cash_name = $request->cash_names[$key];
                        $cashReceived->save();
                    }
                }
            }


            if (is_array($request->bank_ids)) {
                foreach ($request->bank_ids as $key => $bank) {
                    if ($bank != '' && $bank != null) {
                        // Insert Data
                        $bankReceived = new BankReceived();
                        $bankReceived->student_id = $student->id;
                        $bankReceived->receipt_no = $request->bank_ids[$key];
                        $bankReceived->utr_no = $request->utr_nos[$key];
                        $bankReceived->bank_amount = $request->bank_amounts[$key];
                        $bankReceived->bank_date = $request->bank_dates[$key];
                        $bankReceived->bank_name = $request->bank_names[$key];
                        $bankReceived->save();
                    }
                }
            }

            if (is_array($request->deduction_ids)) {
                foreach ($request->deduction_ids as $key => $deduction) {
                    if ($deduction != '' && $deduction != null) {
                        // Insert Data
                        $deductionReceived = new Deduction();
                        $deductionReceived->student_id = $student->id;
                        $deductionReceived->utr_no = $request->deduction_ids[$key];
                        $deductionReceived->deduction_amount = $request->deduction_amounts[$key];
                        $deductionReceived->deduction_date = $request->deduction_dates[$key];
                        $deductionReceived->deduction_name = $request->deduction_names[$key];
                        $deductionReceived->save();
                    }
                }
            }


            // Student Documents
            if (is_array($request->documents)) {
                $documents = $request->file('documents');
                foreach ($documents as $key => $attach) {

                    // Valid extension check
                    $valid_extensions = array('JPG', 'JPEG', 'jpg', 'jpeg', 'png', 'gif', 'ico', 'svg', 'webp', 'pdf', 'doc', 'docx', 'txt', 'zip', 'rar', 'csv', 'xls', 'xlsx', 'ppt', 'pptx', 'mp3', 'avi', 'mp4', 'mpeg', '3gp', 'mov', 'ogg', 'mkv');
                    $file_ext = $attach->getClientOriginalExtension();
                    if (in_array($file_ext, $valid_extensions, true)) {

                        //Upload Files
                        $filename = $attach->getClientOriginalName();
                        $extension = $attach->getClientOriginalExtension();
                        $fileNameToStore = str_replace([' ', '-', '&', '#', '$', '%', '^', ';', ':'], '_', $filename) . '_' . time() . '.' . $extension;

                        // Move file inside public/uploads/ directory
                        $attach->move('uploads/' . $this->path . '/', $fileNameToStore);

                        // Insert Data
                        $document = new Document;
                        $document->title = $request->titles[$key];
                        $document->attach = $fileNameToStore;
                        $document->save();

                        // Attach
                        $document->students()->attach($student->id);
                    }
                }
            }


            // Student Enroll
            $enroll = new StudentEnroll();
            $enroll->student_id = $student->id;
            $enroll->session_id = $request->session;
            $enroll->semester_id = $request->semester;
            $enroll->program_id = $request->program;
            $enroll->section_id = 1;

            $enroll->created_by = Auth::guard('web')->user()->id;
            $enroll->save();


            // Assign Subjects
            $enrollSubject = EnrollSubject::where('program_id', $request->program)->where('semester_id', $request->semester)->where('section_id', $request->section)->first();

            if (isset($enrollSubject)) {
                foreach ($enrollSubject->subjects as $subject) {
                    // Attach Subject
                    $enroll->subjects()->attach($subject->id);
                }
            }

            DB::commit();


            // Toastr::success(__('msg_created_successfully'), __('msg_success'));


            $notification = array(
                'message' => __('msg_created_successfully'),
                'alert-type' => __('msg_success')
            );

            return redirect()->route($this->route . '.index')->with($notification);
        } catch (\Exception $e) {

            // Toastr::error(__('msg_created_error'), __('msg_error'));



            $notification = array(
                'message' => __('msg_created_error'),
                'alert-type' => __('msg_error')
            );

            return redirect()->back()->with($notification);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;
        $data['access'] = $this->access;

        $data['row'] = $student;

        $data['fees'] = Fee::with('studentEnroll')->whereHas('studentEnroll', function ($query) use ($student) {
            $query->where('student_id', $student->id);
        })
            ->orderBy('id', 'desc')->get();

        $data['grades'] = Grade::where('status', '1')->orderBy('min_mark', 'desc')->get();

        return view($this->view . '.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
        // dd($student->admission_college);
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;


        $data['provinces'] = Province::where('status', '1')
            ->orderBy('title', 'asc')->get();
        $data['present_districts'] = District::where('status', '1')
            ->where('province_id', $student->present_province)
            ->orderBy('title', 'asc')->get();
        $data['permanent_districts'] = District::where('status', '1')
            ->where('province_id', $student->permanent_province)
            ->orderBy('title', 'asc')->get();
        $data['statuses'] = StatusType::where('status', '1')->get();

        if (auth()->user()->is_admin === 1) {
            // Admin ko saari batches dikhni chahiye
            $data['batches'] = Batch::where('status', '1')->orderBy('id', 'desc')->get();
        } elseif (auth()->user()->is_admin === 0) {
            // Teacher ko sirf uske department ki batch dikhni chahiye
            $teacherDepartment = auth()->user()->teacher_department; // ya ->faculty_name
            $collegeDepartment = auth()->user()->college_department_id;

            $batche = Batch::where('status', '1')->where('department_id', $collegeDepartment);

            //  $batche->with('programs')->whereHas('programs', function ($query) use ($teacherDepartment){
            //             $query->where('program_id', $teacherDepartment);
            //         });



            $data['batches'] = $batche->orderBy('title', 'asc')->get();
        }

        $data['row'] = $student;


        return view($this->view . '.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        // Field Validation
        $request->validate([
            'student_id' => 'required|unique:students,student_id,' . $student->id,
            'batch' => 'required',
            'first_name' => 'required',

            'email' => 'required|email|unique:students,email,' . $student->id,
            'phone' => 'required',

            'admission_mode' => 'required',
            'total_course_fees' => 'required',

            'gender' => 'required',
            'dob' => 'required|date',
            'caste' => 'required',
            'admission_date' => 'required|date',
            'photo' => 'nullable|image',
            'signature' => 'nullable|image',
        ]);

        // Update Data
        try {
            DB::beginTransaction();

            $student->student_id = $request->student_id;
            $student->batch_id = $request->batch;
            $student->admission_date = $request->admission_date;
            $student->registration_no = $request->registration_no;
            $student->first_name = $request->first_name;
            $student->last_name = $request->last_name;
            $student->father_name = $request->father_name;
            $student->mother_name = $request->mother_name;
            $student->father_occupation = $request->father_occupation;
            $student->mother_occupation = $request->mother_occupation;
            $student->email = $request->email;

            $student->country = $request->country;
            $student->present_province = $request->present_province;
            $student->present_district = $request->present_district;
            $student->present_village = $request->present_village;
            $student->present_address = $request->present_address;
            $student->present_post = $request->present_post;
            $student->present_pin = $request->present_pin;
            $student->present_police_station = $request->present_police_station;

            $student->permanent_province = $request->permanent_province;
            $student->permanent_district = $request->permanent_district;
            $student->permanent_village = $request->permanent_village;
            $student->permanent_address = $request->permanent_address;
            $student->permanent_post = $request->permanent_post;
            $student->permanent_pin = $request->permanent_pin;
            $student->permanent_police_station = $request->permanent_police_station;

            $student->gender = $request->gender;

            $student->pan_id = $request->pan_id;

            $student->dob = $request->dob;
            $student->phone = $request->phone;
            $student->emergency_phone = $request->emergency_phone;

            $student->religion = $request->religion;
            $student->caste = $request->caste;
            $student->mother_tongue = $request->mother_tongue;
            $student->marital_status = $request->marital_status;
            $student->blood_group = $request->blood_group;
            $student->nationality = $request->nationality;
            $student->national_id = $request->national_id;
            $student->passport_no = $request->passport_no;



            $student->high_school_name = $request->high_school_name;
            $student->high_school_address = $request->high_school_study_address;
            $student->high_school_graduation_year = $request->high_school_graduation_year;
            $student->high_school_graduation_percentage = $request->high_school_graduation_percentage;
            $student->high_school_total_marks = $request->high_school_total_marks;
            $student->high_school_marks_obtained = $request->high_school_total_marks_obtained;


            $student->intermediate_name = $request->intermediate_name;
            $student->intermediate_address = $request->intermediate_study_address;
            $student->intermediate_graduation_year = $request->intermediate_graduation_year;
            $student->inter_graduation_percentage = $request->intermediate_graduation_percentage;
            $student->intermediate_total_marks = $request->intermediate_total_marks;
            $student->intermediate_marks_obtained = $request->intermediate_total_marks_obtained;

            $student->bach_college_name = $request->bachelor_college_name;
            $student->bach_college_address = $request->bachelor_study_address;
            $student->bach_gradu_year = $request->bachelor_graduation_year;
            $student->bach_gradu_percentage = $request->bachelor_graduation_percentage;
            $student->bach_total_marks = $request->bachelor_total_marks;
            $student->bach_marks_obtained = $request->bachelor_total_marks_obtained;



            $student->master_college_name = $request->master_college_name;
            $student->master_college_address = $request->master_study_address;
            $student->master_gradu_year = $request->master_graduation_year;
            $student->master_gradu_percentage = $request->master_graduation_percentage;
            $student->master_total_marks = $request->master_total_marks;
            $student->master_marks_obtained = $request->master_total_marks_obtained;



            if ($request->has('total_amounts')) {
                $student->total_amounts = $request->total_amounts;
            }
            if ($request->has('RefT')) {
                $student->refTotal = $request->RefT;
            }
            if ($request->has('CashT')) {
                $student->cashTotal = $request->CashT;
            }
            if ($request->has('BankT')) {
                $student->bankTotal = $request->BankT;
            }

            if ($request->has('deductionT')) {
                $student->deductionTotal = $request->deductionT;
            }

            $student->admission_mode = $request->admission_mode;
            $student->total_course_fees = $request->total_course_fees;
            $student->refrence_person_name = $request->refrence_person_name;
            $student->refrence_person_contact = $request->refrence_person_contact;



            $student->school_transcript = $this->updateMultiMedia($request, 'high_school_certificate', $this->path, $student, 'school_transcript');
            $student->high_school_certificate = $this->updateMultiMedia($request, 'high_school_certi', $this->path, $student, 'high_school_certificate');
            $student->school_slc = $this->updateMultiMedia($request, 'high_school_slc', $this->path, $student, 'school_slc');


            $student->school_certificate = $this->updateMultiMedia($request, 'intermediate_certificate', $this->path, $student, 'school_certificate');
            $student->intermediate_certificate = $this->updateMultiMedia($request, 'intermediate_certi', $this->path, $student, 'intermediate_certificate');
            $student->intermediate_clc = $this->updateMultiMedia($request, 'intermediate_clc', $this->path, $student, 'intermediate_clc');
            $student->intermediate_migration = $this->updateMultiMedia($request, 'intermediate_migration', $this->path, $student, 'intermediate_migration');


            $student->collage_transcript = $this->updateMultiMedia($request, 'bachelor_certificate', $this->path, $student, 'collage_transcript');
            $student->collage_certificate = $this->updateMultiMedia($request, 'master_certificate', $this->path, $student, 'collage_certificate');
            $student->collage_migration = $this->updateMultiMedia($request, 'graduation_migration', $this->path, $student, 'collage_migration');

            $student->adhar_card = $this->updateMultiMedia($request, 'adhar_card', $this->path, $student, 'adhar_card');
            $student->parents_id = $this->updateMultiMedia($request, 'parents_id', $this->path, $student, 'parents_id');
            $student->pan_card = $this->updateMultiMedia($request, 'pan_card', $this->path, $student, 'pan_card');

            $student->domicile = $this->updateMultiMedia($request, 'domicile', $this->path, $student, 'domicile');
            $student->caste_certificate = $this->updateMultiMedia($request, 'caste_certificate', $this->path, $student, 'caste_certificate');


            $student->photo = $this->updateImage($request, 'photo', $this->path, 300, 300, $student, 'photo');
            $student->signature = $this->updateImage($request, 'signature', $this->path, 300, 100, $student, 'signature');

            $student->bonafide_certificate = $this->updateMultiMedia($request, 'bonafide_certificate', $this->path, $student, 'bonafide_certificate');
            $student->drcc_receiving = $this->updateMultiMedia($request, 'drcc_receiving', $this->path, $student, 'drcc_receiving');
            $student->tpva_form = $this->updateMultiMedia($request, 'tpva_form', $this->path, $student, 'tpva_form');
            $student->drcc_selection_letter = $this->updateMultiMedia($request, 'drcc_selection_letter', $this->path, $student, 'drcc_selection_letter');

            $student->updated_by = Auth::guard('web')->user()->id;
            $student->save();




            // Update Status
            $student->statuses()->sync($request->statuses);


            // Remove Old Relatives
            StudentRelative::where('student_id', $student->id)->delete();
            // Student Relatives
            if (is_array($request->relations)) {
                foreach ($request->relations as $key => $relation) {
                    if ($relation != '' && $relation != null) {
                        // Insert Data
                        $relation = new StudentRelative;
                        $relation->student_id = $student->id;

                        $relation->relation = $request->relations[$key];
                        $relation->name = $request->relative_names[$key];
                        $relation->occupation = $request->occupations[$key];
                        // $relation->email = $request->relative_emails[$key];
                        $relation->phone = $request->relative_phones[$key];
                        $relation->address = $request->addresses[$key];
                        $relation->save();
                    }
                }
            }

            //Remove Old References
            Refrence::where('student_id', $student->id)->delete();

            if (is_array($request->refrence_ids)) {
                foreach ($request->refrence_ids as $key => $refrence) {
                    if ($refrence != '' && $refrence != null) {
                        // Insert Data
                        $reference = new Refrence();
                        $reference->student_id = $student->id;
                        $reference->utr_no = $request->refrence_ids[$key];
                        $reference->ref_amount = $request->ref_amounts[$key];
                        $reference->ref_date = $request->ref_dates[$key];
                        $reference->ref_name = $request->ref_names[$key];
                        $reference->save();
                    }
                }
            }

            //Remove Old Cash Received
            CashReceived::where('student_id', $student->id)->delete();

            if (is_array($request->cash_ids)) {
                foreach ($request->cash_ids as $key => $cash) {
                    if ($cash != '' && $cash != null) {
                        // Insert Data
                        $cashReceived = new CashReceived();
                        $cashReceived->student_id = $student->id;
                        $cashReceived->utr_no = $request->cash_ids[$key];
                        $cashReceived->cash_amount = $request->cash_amounts[$key];
                        $cashReceived->cash_date = $request->cash_dates[$key];
                        $cashReceived->cash_name = $request->cash_names[$key];
                        $cashReceived->save();
                    }
                }
            }

            //Remove Old Bank Received
            BankReceived::where('student_id', $student->id)->delete();

            if (is_array($request->bank_ids)) {
                foreach ($request->bank_ids as $key => $bank) {
                    if ($bank != '' && $bank != null) {
                        // Insert Data
                        $bankReceived = new BankReceived();
                        $bankReceived->student_id = $student->id;
                        $bankReceived->receipt_no = $request->bank_ids[$key];
                        $bankReceived->utr_no = $request->utr_nos[$key];
                        $bankReceived->bank_amount = $request->bank_amounts[$key];
                        $bankReceived->bank_date = $request->bank_dates[$key];
                        $bankReceived->bank_name = $request->bank_names[$key];
                        $bankReceived->save();
                    }
                }
            }

            //Remove Old Deduction Received
            Deduction::where('student_id', $student->id)->delete();

            if (is_array($request->deduction_ids)) {
                foreach ($request->deduction_ids as $key => $deduction) {
                    if ($deduction != '' && $deduction != null) {
                        // Insert Data
                        $deductionReceived = new Deduction();
                        $deductionReceived->student_id = $student->id;
                        $deductionReceived->utr_no = $request->deduction_ids[$key];
                        $deductionReceived->deduction_amount = $request->deduction_amounts[$key];
                        $deductionReceived->deduction_date = $request->deduction_dates[$key];
                        $deductionReceived->deduction_name = $request->deduction_names[$key];
                        $deductionReceived->save();
                    }
                }
            }


            // Student Documents
            if (is_array($request->documents)) {
                $documents = $request->file('documents');
                foreach ($documents as $key => $attach) {

                    // Valid extension check
                    $valid_extensions = array('JPG', 'JPEG', 'jpg', 'jpeg', 'png', 'gif', 'ico', 'svg', 'webp', 'pdf', 'doc', 'docx', 'txt', 'zip', 'rar', 'csv', 'xls', 'xlsx', 'ppt', 'pptx', 'mp3', 'avi', 'mp4', 'mpeg', '3gp', 'mov', 'ogg', 'mkv');
                    $file_ext = $attach->getClientOriginalExtension();
                    if (in_array($file_ext, $valid_extensions, true)) {

                        //Upload Files
                        $filename = $attach->getClientOriginalName();
                        $extension = $attach->getClientOriginalExtension();
                        $fileNameToStore = str_replace([' ', '-', '&', '#', '$', '%', '^', ';', ':'], '_', $filename) . '_' . time() . '.' . $extension;

                        // Move file inside public/uploads/ directory
                        $attach->move('uploads/' . $this->path . '/', $fileNameToStore);

                        // Insert Data
                        $document = new Document;
                        $document->title = $request->titles[$key];
                        $document->attach = $fileNameToStore;
                        $document->save();

                        // Attach
                        $document->students()->sync($student->id);
                    }
                }
            }

            DB::commit();



            $notification = array(
                'message' => __('msg_updated_successfully'),
                'alert-type' => __('msg_success')
            );

            return redirect()->back()->with($notification);
        } catch (\Exception $e) {

            toastr('Update Error Occur', 'error');


            $notification = array(
                'message' => __('msg_updated_error'),
                'alert-type' => __('msg_error')
            );

            return redirect()->back()->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        DB::beginTransaction();
        // Delete
        $this->deleteMultiMedia($this->path, $student, 'photo');
        $this->deleteMultiMedia($this->path, $student, 'signature');
        $this->deleteMultiMedia($this->path, $student, 'school_transcript');
        $this->deleteMultiMedia($this->path, $student, 'school_certificate');
        $this->deleteMultiMedia($this->path, $student, 'collage_transcript');
        $this->deleteMultiMedia($this->path, $student, 'collage_certificate');

        // Detach
        $student->relatives()->delete();

        $student->refrences()->delete();
        $student->cashReceived()->delete();
        $student->bankReceived()->delete();
        $student->deductions()->delete();

        $student->statuses()->detach();
        $student->documents()->detach();
        $student->contents()->detach();
        $student->notices()->detach();
        $student->member()->delete();
        $student->hostelRoom()->delete();
        $student->transport()->delete();
        $student->notes()->delete();

        $student->delete();
        DB::commit();

        // Toastr::success(__('msg_deleted_successfully'), __('msg_success'));

        $notification = array(
            'message' => __('msg_deleted_successfully'),
            'alert-type' => __('msg_success')
        );

        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function status($id)
    {
        // Set Status
        $user = Student::where('id', $id)->firstOrFail();

        if ($user->login == 1) {
            $user->login = 0;
            $user->save();
        } else {
            $user->login = 1;
            $user->save();
        }

        // Toastr::success(__('msg_updated_successfully'), __('msg_success'));

        $notification = array(
            'message' => __('msg_updated_successfully'),
            'alert-type' => __('msg_success')
        );

        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sendPassword($id)
    {
        //
        $user = Student::where('id', $id)->firstOrFail();

        $mail = MailSetting::where('status', '1')->first();

        if (isset($mail->sender_email) && isset($mail->sender_name)) {

            $sendTo = $user->email;
            $receiver = $user->first_name . ' ' . $user->last_name;

            // Passing data to email template
            $data['name'] = $user->first_name . ' ' . $user->first_name;
            $data['student_id'] = $user->student_id;
            $data['registration_no'] = $user->registration_no;
            $data['email'] = $user->email;
            $data['password'] = Crypt::decryptString($user->password_text);

            // Mail Information
            $data['subject'] = __('msg_your_login_credentials');
            $data['from'] = $mail->sender_email;
            $data['sender'] = $mail->sender_name;


            // Send Mail
            Mail::to($sendTo, $receiver)->send(new SendPassword($data));


            // Toastr::success(__('msg_sent_successfully'), __('msg_success'));

            $notification = array(
                'message' => __('msg_sent_successfully'),
                'alert-type' => __('msg_success')
            );

            return redirect()->back()->with($notification);
        } else {
            // Toastr::success(__('msg_receiver_not_found'), __('msg_success'));

            $notification = array(
                'message' => __('msg_receiver_not_found'),
                'alert-type' => __('msg_success')
            );

            return redirect()->back()->with($notification);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function printPassword($id)
    {
        //
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;

        $data['rows'] = Student::where('id', $id)->get();

        return view($this->view . '.password-print', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function multiPrintPassword(Request $request)
    {
        //
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;

        $students = explode(",", $request->students);

        // View
        $data['rows'] = Student::whereIn('id', $students)->orderBy('id', 'asc')->get();

        return view($this->view . '.password-print', $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function passwordChange(Request $request)
    {
        // Field Validation
        $request->validate([
            'student_id' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        // Update Data
        $student = Student::findOrFail($request->student_id);
        $student->password = Hash::make($request->password);
        $student->password_text = Crypt::encryptString($request->password);
        $student->save();


        // Toastr::success(__('msg_updated_successfully'), __('msg_success'));
        $notification = array(
            'message' => __('msg_updated_successfully'),
            'alert-type' => __('msg_success')
        );

        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function card($id)
    {
        //
        $data['title']     = $this->title;
        $data['route']     = $this->route;
        $data['view']      = $this->view;
        $data['path']      = $this->path;

        $data['rows'] = Student::where('id', $id)->orderBy('student_id', 'asc')->get();

        $data['print'] = IdCardSetting::where('slug', 'student-card')->firstOrFail();

        return view('admin.id-card.print', $data);
    }


    public function studentCls($id)
    {
        $data['title']     = $this->title;
        $data['route']     = $this->route;
        $data['view']      = $this->view;
        $data['path']      = $this->path;
        $data['rows'] = Student::where('id', $id)->orderBy('student_id', 'asc')->get();

        $data['batches'] = Batch::where('status', '1')->orderBy('id', 'desc')->get();

        $data['print'] = IdCardSetting::where('slug', 'student-card')->firstOrFail();

        return view('admin.id-card.cls', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request)
    {


        if (auth()->user()->is_admin === 1) {
            // dd('s');
            //
            $data['title']     = $this->title;
            $data['route']     = $this->route;
            $data['view']      = $this->view;
            $data['access']    = $this->access;

            //
            $data['batches'] = Batch::where('status', '1')
                ->orderBy('id', 'desc')->get();

            return view($this->view . '.import', $data);
        } elseif (auth()->user()->is_admin === 0) {
            // dd('s');
            //
            $data['title']     = $this->title;
            $data['route']     = $this->route;
            $data['view']      = $this->view;
            $data['access']    = $this->access;

            $collegeDepartment = auth()->user()->college_department_id;

            //
            $data['batches'] = Batch::where('department_id', $collegeDepartment)->where('status', '1')
                ->orderBy('id', 'desc')->get();

            return view($this->view . '.import', $data);
        }
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function importStore(Request $request)
    {
        // Field Validation
        $request->validate([
            'batch' => 'required',
            'program' => 'required',
            'session' => 'required',
            'semester' => 'required',
            // 'section' => 'required',
            'import' => 'required|file|mimes:xlsx',

        ]);


        // Passing Data
        $data['batch'] = $request->batch;
        $data['program'] = $request->program;
        $data['session'] = $request->session;
        $data['semester'] = $request->semester;
        $data['section'] = 1;


        Excel::import(new StudentsImport($data), $request->file('import'));


        // Toastr::success(__('msg_updated_successfully'), __('msg_success'));
        $notification = array(
            'message' => __('msg_updated_successfully'),
            'alert-type' => __('msg_success')
        );

        return redirect()->back()->with($notification);
    }



    public function downloadApplication($id)
    {

        $data['title']     = $this->title;
        $data['route']     = $this->route;
        $data['view']      = $this->view;
        $data['access']    = $this->access;

        $data['applicationSetting'] = ApplicationSetting::where('slug', 'admission')->where('status', '1')->firstOrFail();


        $apStudent = Student::where('id', $id)->where('status', '1')->first();

        $data['student'] = $apStudent;

        $data['application'] = Application::where('email', $apStudent->email)->first();

        return view($this->view . '.download_application', $data);
    }

    public function specialStudent()
    {
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;
        $data['access'] = $this->access;




        $students = Student::where('status', '1')
                   ->whereNotNull('total_amounts');

        $data['rows'] = $students->orderBy('student_id', 'desc')->get();
        $data['print'] = IdCardSetting::where('slug', 'student-card')->first();

        return view($this->view . '.special_student', $data);
    }


    public function feesStudent(Request $request)
    {
        //   dd($request->all());
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;
        $data['access'] = $this->access;

       


        if (auth()->user()->is_admin === 1) {
            // Admin ko saari faculties dikhni chahiye

            if (!empty($request->department) || $request->department != null) {
                $data['college_department'] = $department = $request->department;
            } else {
                $data['college_department']  = $department = '0';
            }

            if (!empty($request->faculty) || $request->faculty != null) {
                $data['selected_faculty'] = $faculty = $request->faculty;
            } else {
                $data['selected_faculty'] = $faculty = '0';
            }

            if (!empty($request->program) || $request->program != null) {
                $data['selected_program'] = $program = $request->program;
            } else {
                $data['selected_program'] = $program = '0';
            }

            if (!empty($request->session) || $request->session != null) {
                $data['selected_session'] = $session = $request->session;
            } else {
                $data['selected_session'] = $session = '0';
            }

            if (!empty($request->semester) || $request->semester != null) {
                $data['selected_semester'] = $semester = $request->semester;
            } else {
                $data['selected_semester'] = $semester = '0';
            }

            if (!empty($request->section) || $request->section != null) {
                $data['selected_section'] = $section = $request->section;
            } else {
                $data['selected_section'] = $section = '0';
            }

            if (!empty($request->status) || $request->status != null) {
                $data['selected_status'] = $status = $request->status;
            } else {
                $data['selected_status'] = '0';
            }





            if (!empty($request->student_id) || $request->student_id != null) {
                $data['selected_student_id'] = $student_id = $request->student_id;
            } else {
                $data['selected_student_id'] = $student_id =  Null;
            }

            if (!empty($request->student_regi) || $request->student_regi != null) {
                $data['selected_student_regi'] = $student_regi = $request->student_regi;
            } else {
                $data['selected_student_regi'] = $student_regi = Null;
            }

            if (!empty($request->person) || $request->person != null) {
                $data['selected_person'] = $person = $request->person;
            } else {
                $data['selected_person'] = $person = '0';
            }

            $data['persons'] = Student::pluck('refrence_person_name');


            $data['departments'] = CollegeDepartment::where('status', '1')->orderBy('title', 'asc')->get();

            $data['faculties'] = Faculty::where('status', '1')
                ->orderBy('title', 'asc')
                ->get();

            $data['statuses'] = StatusType::where('status', '1')->orderBy('title', 'asc')->get();


            if (!empty($request->faculty) && $request->faculty != '0') {
                $data['programs'] = Program::where('faculty_id', $faculty)->where('status', '1')->orderBy('title', 'asc')->get();
            }

            if (!empty($request->program) && $request->program != '0') {
                $sessions = Session::where('status', 1);
                $sessions->with('programs')->whereHas('programs', function ($query) use ($program) {
                    $query->where('program_id', $program);
                });
                $data['sessions'] = $sessions->orderBy('id', 'desc')->get();
            }

            if (!empty($request->program) && $request->program != '0') {
                $semesters = Semester::where('status', 1);
                $semesters->with('programs')->whereHas('programs', function ($query) use ($program) {
                    $query->where('program_id', $program);
                });
                $data['semesters'] = $semesters->orderBy('id', 'asc')->get();
            }

            if (!empty($request->program) && $request->program != '0' && !empty($request->semester) && $request->semester != '0') {
                $sections = Section::where('status', 1);
                $sections->with('semesterPrograms')->whereHas('semesterPrograms', function ($query) use ($program, $semester) {
                    $query->where('program_id', $program);
                    $query->where('semester_id', $semester);
                });
                $data['sections'] = $sections->orderBy('title', 'asc')->get();
            }


            if (isset($request->faculty) || isset($request->program) || isset($request->session) || isset($request->semester) || isset($request->section) || isset($request->status) || isset($request->student_id) || isset($request->student_regi)
                || isset($request->person)) {
                // Student Filter
                $students = Student::where('status', '1');
                if ($faculty != 0) {
                    $students->with('program')->whereHas('program', function ($query) use ($faculty) {
                        $query->where('faculty_id', $faculty);
                    });
                }
                $students->with('currentEnroll')->whereHas('currentEnroll', function ($query) use ($program, $session, $semester, $section) {
                    if ($program != 0) {
                        $query->where('program_id', $program);
                    }
                    if ($session != 0) {
                        $query->where('session_id', $session);
                    }
                    if ($semester != 0) {
                        $query->where('semester_id', $semester);
                    }
                    if ($section != 0) {
                        $query->where('section_id', $section);
                    }
                });
                if (!empty($request->status)) {
                    $students->with('statuses')->whereHas('statuses', function ($query) use ($status) {
                        $query->where('status_type_id', $status);
                    });
                }
                if (!empty($request->student_id)) {
                    $students->where('student_id', 'LIKE', '%' . $student_id . '%');
                }

                if (!empty($request->student_regi)) {
                    $students->where('registration_no', 'LIKE', '%' . $student_regi . '%');
                }


                 if (!empty($request->person)) {
                    $students->where('refrence_person_name', $person);
                }
                $rows = $students->orderBy('student_id', 'desc')->get();

                // Array Sorting
                $data['rows'] = $rows->sortByDesc(function ($query) {

                    return $query->student_id;
                })->all();
            }


            $data['print'] = IdCardSetting::where('slug', 'student-card')->first();


            return view('admin.income.student_fees', $data);
        } elseif (auth()->user()->is_admin === 0) {
            // Teacher ko sirf uske department ki faculties dikhni chahiye

            $teacherDepa = auth()->user()->teacher_department; // ya ->faculty_name
            $collegeDepartment = auth()->user()->college_department_id;

            $data['persons'] = Student::pluck('refrence_person_name');


            $fac = Faculty::where('status', '1')
                ->where('teacher_department', $teacherDepa) // column match karo
                ->orderBy('title', 'asc')
                ->first();
            //  dd($fac);

            if (!empty($request->department) || $request->department != null) {
                $data['college_department'] = $department = $request->department;
            } else {
                $data['college_department']  = $department =  $collegeDepartment;
            }

            if (!empty($request->faculty) || $request->faculty != null) {
                $data['selected_faculty'] = $faculty = $request->faculty;
            } else {
                $data['selected_faculty'] = $faculty = $fac->id ?? null;
            }
            if (!empty($request->program) || $request->program != null) {
                $data['selected_program'] = $program = $request->program;
            } else {
                $data['selected_program'] = $program = $teacherDepa ?? null;
            }



            $data['selected_session'] = $session = $request->session ?? null;
            $data['selected_semester'] = $semester = $request->semester ?? null;
            $data['selected_section'] = $section = $request->section ?? null;
            $data['selected_status'] = $status = $request->status ?? null;
            $data['selected_student_id'] = $student_id = $request->student_id ?? null;

            if (!empty($request->student_regi) || $request->student_regi != null) {
                $data['selected_student_regi'] = $student_regi = $request->student_regi;
            } else {
                $data['selected_student_regi'] =$student_regi = Null;
            }

            if (!empty($request->person) || $request->person != null) {
                $data['selected_person'] = $person = $request->person;
            } else {
                $data['selected_person'] = $person = '0';
            }


            // dd($faculty);


            $data['departments'] = CollegeDepartment::where('id', $collegeDepartment)->where('status', '1')->orderBy('title', 'asc')->get();



            $data['faculties'] = Faculty::where('status', '1')
                ->where('department_id', $collegeDepartment) // column match karo
                ->orderBy('title', 'asc')
                ->get();

            $data['statuses'] = StatusType::where('status', '1')->orderBy('title', 'asc')->get();

            // dd($request->faculty);

            if (!empty($request->faculty) && $request->faculty != '0' || !empty($faculty)) {
                //  dd($faculty);
                $data['programs'] = Program::where('faculty_id', $faculty)->where('status', '1')->orderBy('title', 'asc')->get();
                // dd($da);

            }

            if (!empty($request->program) && $request->program != '0') {
                $sessions = Session::where('status', 1);
                $sessions->with('programs')->whereHas('programs', function ($query) use ($program) {
                    $query->where('program_id', $program);
                });
                $data['sessions'] = $sessions->orderBy('id', 'desc')->get();
            }

            if (!empty($request->program) && $request->program != '0') {
                $semesters = Semester::where('status', 1);
                $semesters->with('programs')->whereHas('programs', function ($query) use ($program) {
                    $query->where('program_id', $program);
                });
                $data['semesters'] = $semesters->orderBy('id', 'asc')->get();
            }

            if (!empty($request->program) && $request->program != '0' && !empty($request->semester) && $request->semester != '0') {
                $sections = Section::where('status', 1);
                $sections->with('semesterPrograms')->whereHas('semesterPrograms', function ($query) use ($program, $semester) {
                    $query->where('program_id', $program);
                    $query->where('semester_id', $semester);
                });
                $data['sections'] = $sections->orderBy('title', 'asc')->get();
            }


            if (
                isset($request->faculty) || isset($request->program) || isset($request->session) || isset($request->semester) || isset($request->section) || isset($request->status) || isset($request->student_id)
                || isset($request->student_regi) || isset($request->person)
            ) {
                // Student Filter
                $students = Student::where('status', '1');
                if ($faculty != 0) {
                    $students->with('program')->whereHas('program', function ($query) use ($faculty) {
                        $query->where('faculty_id', $faculty);
                    });
                }
                $students->with('currentEnroll')->whereHas('currentEnroll', function ($query) use ($program, $session, $semester, $section) {
                    if ($program != 0) {
                        $query->where('program_id', $program);
                    }
                    if ($session != 0) {
                        $query->where('session_id', $session);
                    }
                    if ($semester != 0) {
                        $query->where('semester_id', $semester);
                    }
                    if ($section != 0) {
                        $query->where('section_id', $section);
                    }
                });
                if (!empty($request->status)) {
                    $students->with('statuses')->whereHas('statuses', function ($query) use ($status) {
                        $query->where('status_type_id', $status);
                    });
                }
                if (!empty($request->student_id)) {
                    $students->where('student_id', 'LIKE', '%' . $student_id . '%');
                }

                if (!empty($request->person)) {
                    $students->where('refrence_person_name', $person);
                }

                if (!empty($request->student_regi)) {
                    $students->where('registration_no', 'LIKE', '%' . $student_regi . '%');
                }

                $rows = $students->orderBy('student_id', 'desc')->get();

                // Array Sorting
                $data['rows'] = $rows->sortByDesc(function ($query) {

                    return $query->student_id;
                })->all();
            }


            $data['print'] = IdCardSetting::where('slug', 'student-card')->first();


            return view('admin.income.student_fees', $data);
        }
    }

public function cancelStudent(Request $request)
    {

        $data['title'] = 'Cancelled Students';

        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;
        $data['access'] = $this->access;


        $sta = StatusType::where('title', 'Rejected')->where('status', '1')->first();


        if (!empty($request->department) || $request->department != null) {
            $data['college_department'] = $department = $request->department;
        } else {
            $data['college_department']  = $department = '0';
        }

        if (!empty($request->faculty) || $request->faculty != null) {
            $data['selected_faculty'] = $faculty = $request->faculty;
        } else {
            $data['selected_faculty'] = $faculty = '0';
        }

        if (!empty($request->program) || $request->program != null) {
            $data['selected_program'] = $program = $request->program;
        } else {
            $data['selected_program'] = $program = '0';
        }

        if (!empty($request->session) || $request->session != null) {
            $data['selected_session'] = $session = $request->session;
        } else {
            $data['selected_session'] = $session = '0';
        }

        if (!empty($request->semester) || $request->semester != null) {
            $data['selected_semester'] = $semester = $request->semester;
        } else {
            $data['selected_semester'] = $semester = '0';
        }

        if (!empty($request->section) || $request->section != null) {
            $data['selected_section'] = $section = $request->section;
        } else {
            $data['selected_section'] = $section = '0';
        }

        if (!empty($request->status) || $request->status != null) {
            $data['selected_status'] = $status = $request->status;
        } else {
            $data['selected_status'] = $status = $sta->id ?? '0';
        }

        if (!empty($request->student_id) || $request->student_id != null) {
            $data['selected_student_id'] = $student_id = $request->student_id;
        } else {
            $data['selected_student_id'] = $student_id =  Null;
        }

        if (!empty($request->student_regi) || $request->student_regi != null) {
            $data['selected_student_regi'] = $student_regi = $request->student_regi;
        } else {
            $data['selected_student_regi'] = $student_regi = Null;
        }

        if (!empty($request->person) || $request->person != null) {
            $data['selected_person'] = $person = $request->person;
        } else {
            $data['selected_person'] = $person = '0';
        }

        // $data['persons'] = Student::pluck('refrence_person_name');
        $data['persons'] = Student::whereNotNull('refrence_person_name')
            ->where('refrence_person_name', '!=', '')
            ->distinct()
            ->pluck('refrence_person_name');


        $data['departments'] = CollegeDepartment::where('status', '1')->orderBy('title', 'asc')->get();

        $data['faculties'] = Faculty::where('status', '1')
            ->orderBy('title', 'asc')
            ->get();

        $data['statuses'] = StatusType::where('title', 'Rejected')->where('status', '1')->orderBy('title', 'asc')->get();


        if (!empty($request->faculty) && $request->faculty != '0') {
            $data['programs'] = Program::where('faculty_id', $faculty)->where('status', '1')->orderBy('title', 'asc')->get();
        }

        if (!empty($request->program) && $request->program != '0') {
            $sessions = Session::where('status', 1);
            $sessions->with('programs')->whereHas('programs', function ($query) use ($program) {
                $query->where('program_id', $program);
            });
            $data['sessions'] = $sessions->orderBy('id', 'desc')->get();
        }

        if (!empty($request->program) && $request->program != '0') {
            $semesters = Semester::where('status', 1);
            $semesters->with('programs')->whereHas('programs', function ($query) use ($program) {
                $query->where('program_id', $program);
            });
            $data['semesters'] = $semesters->orderBy('id', 'asc')->get();
        }

        if (!empty($request->program) && $request->program != '0' && !empty($request->semester) && $request->semester != '0') {
            $sections = Section::where('status', 1);
            $sections->with('semesterPrograms')->whereHas('semesterPrograms', function ($query) use ($program, $semester) {
                $query->where('program_id', $program);
                $query->where('semester_id', $semester);
            });
            $data['sections'] = $sections->orderBy('title', 'asc')->get();
        }


        if (
            isset($request->faculty) || isset($request->program) || isset($request->session) || isset($request->semester) || isset($request->section) || isset($request->status) || isset($request->student_id) || isset($request->student_regi)
            || isset($request->person)
        ) {
            // Student Filter
            $students = Student::where('status', '1');
            if ($faculty != 0) {
                $students->with('program')->whereHas('program', function ($query) use ($faculty) {
                    $query->where('faculty_id', $faculty);
                });
            }
            $students->with('currentEnroll')->whereHas('currentEnroll', function ($query) use ($program, $session, $semester, $section) {
                if ($program != 0) {
                    $query->where('program_id', $program);
                }
                if ($session != 0) {
                    $query->where('session_id', $session);
                }
                if ($semester != 0) {
                    $query->where('semester_id', $semester);
                }
                if ($section != 0) {
                    $query->where('section_id', $section);
                }
            });
            if (!empty($request->status)) {
                $students->with('statuses')->whereHas('statuses', function ($query) use ($status) {
                    $query->where('status_type_id', $status);
                });
            }
            if (!empty($request->student_id)) {
                $students->where('student_id', 'LIKE', '%' . $student_id . '%');
            }

            if (!empty($request->student_regi)) {
                $students->where('registration_no', 'LIKE', '%' . $student_regi . '%');
            }


            if (!empty($request->person)) {
                $students->where('refrence_person_name', $person);
            }
            $rows = $students->orderBy('student_id', 'desc')->get();

            // Array Sorting
            $data['rows'] = $rows->sortByDesc(function ($query) {

                return $query->student_id;
            })->all();
        }


        $data['print'] = IdCardSetting::where('slug', 'student-card')->first();


        return view($this->view . '.cancel_student', $data);
    }

public function feesCollection(Request $request)
    {
        // dd('success');
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;
        $data['access'] = $this->access;

        // if(!empty($request->college_status) || $request->college_status != null){
        //     $data['selected_college_id'] = $college = $request->college_status;
        // }
        // else{
        //     $data['selected_college_id'] = $college = '0';
        // }


        if (auth()->user()->is_admin === 1) {
            // Admin ko saari faculties dikhni chahiye

            // dd('s');

            if (!empty($request->department) || $request->department != null) {
                $data['college_department'] = $department = $request->department;
            } else {
                $data['college_department']  = $department = '0';
            }

            if (!empty($request->faculty) || $request->faculty != null) {
                $data['selected_faculty'] = $faculty = $request->faculty;
            } else {
                $data['selected_faculty'] = $faculty = '0';
            }

            if (!empty($request->program) || $request->program != null) {
                $data['selected_program'] = $program = $request->program;
            } else {
                $data['selected_program'] = $program = '0';
            }

            if (!empty($request->session) || $request->session != null) {
                $data['selected_session'] = $session = $request->session;
            } else {
                $data['selected_session'] = $session = '0';
            }

            if (!empty($request->semester) || $request->semester != null) {
                $data['selected_semester'] = $semester = $request->semester;
            } else {
                $data['selected_semester'] = $semester = '0';
            }

            if (!empty($request->section) || $request->section != null) {
                $data['selected_section'] = $section = $request->section;
            } else {
                $data['selected_section'] = $section = '0';
            }

            if (!empty($request->status) || $request->status != null) {
                $data['selected_status'] = $status = $request->status;
            } else {
                $data['selected_status'] = '0';
            }





            if (!empty($request->student_id) || $request->student_id != null) {
                $data['selected_student_id'] = $student_id = $request->student_id;
            } else {
                $data['selected_student_id'] = $student_id =  Null;
            }

            if (!empty($request->student_regi) || $request->student_regi != null) {
                $data['selected_student_regi'] = $student_regi = $request->student_regi;
            } else {
                $data['selected_student_regi'] = $student_regi = Null;
            }

            if (!empty($request->person) || $request->person != null) {
                $data['selected_person'] = $person = $request->person;
            } else {
                $data['selected_person'] = $person = '0';
            }

            $data['persons'] = Student::pluck('refrence_person_name');


            $data['departments'] = CollegeDepartment::where('status', '1')->orderBy('title', 'asc')->get();

            $data['faculties'] = Faculty::where('status', '1')
                ->orderBy('title', 'asc')
                ->get();

            $data['statuses'] = StatusType::where('status', '1')->orderBy('title', 'asc')->get();


            if (!empty($request->faculty) && $request->faculty != '0') {
                $data['programs'] = Program::where('faculty_id', $faculty)->where('status', '1')->orderBy('title', 'asc')->get();
            }

            if (!empty($request->program) && $request->program != '0') {
                $sessions = Session::where('status', 1);
                $sessions->with('programs')->whereHas('programs', function ($query) use ($program) {
                    $query->where('program_id', $program);
                });
                $data['sessions'] = $sessions->orderBy('id', 'desc')->get();
            }

            if (!empty($request->program) && $request->program != '0') {
                $semesters = Semester::where('status', 1);
                $semesters->with('programs')->whereHas('programs', function ($query) use ($program) {
                    $query->where('program_id', $program);
                });
                $data['semesters'] = $semesters->orderBy('id', 'asc')->get();
            }

            if (!empty($request->program) && $request->program != '0' && !empty($request->semester) && $request->semester != '0') {
                $sections = Section::where('status', 1);
                $sections->with('semesterPrograms')->whereHas('semesterPrograms', function ($query) use ($program, $semester) {
                    $query->where('program_id', $program);
                    $query->where('semester_id', $semester);
                });
                $data['sections'] = $sections->orderBy('title', 'asc')->get();
            }


            if (
                isset($request->faculty) || isset($request->program) || isset($request->session) || isset($request->semester) || isset($request->section) || isset($request->status) || isset($request->student_id) || isset($request->student_regi)
                || isset($request->person)
            ) {
                // Student Filter
                $students = Student::where('status', '1');
                if ($faculty != 0) {
                    $students->with('program')->whereHas('program', function ($query) use ($faculty) {
                        $query->where('faculty_id', $faculty);
                    });
                }
                $students->with('currentEnroll')->whereHas('currentEnroll', function ($query) use ($program, $session, $semester, $section) {
                    if ($program != 0) {
                        $query->where('program_id', $program);
                    }
                    if ($session != 0) {
                        $query->where('session_id', $session);
                    }
                    if ($semester != 0) {
                        $query->where('semester_id', $semester);
                    }
                    if ($section != 0) {
                        $query->where('section_id', $section);
                    }
                });
                if (!empty($request->status)) {
                    $students->with('statuses')->whereHas('statuses', function ($query) use ($status) {
                        $query->where('status_type_id', $status);
                    });
                }
                if (!empty($request->student_id)) {
                    $students->where('student_id', 'LIKE', '%' . $student_id . '%');
                }

                if (!empty($request->student_regi)) {
                    $students->where('registration_no', 'LIKE', '%' . $student_regi . '%');
                }


                if (!empty($request->person)) {
                    $students->where('refrence_person_name', $person);
                }
                $rows = $students->orderBy('student_id', 'desc')->get();

                // Array Sorting
                $data['rows'] = $rows->sortByDesc(function ($query) {

                    return $query->student_id;
                })->all();
            }


            $data['print'] = IdCardSetting::where('slug', 'student-card')->first();


            return view('admin.income.add_student_fees', $data);
        } elseif (auth()->user()->is_admin === 0) {
            // Teacher ko sirf uske department ki faculties dikhni chahiye

            $teacherDepa = auth()->user()->teacher_department; // ya ->faculty_name
            $collegeDepartment = auth()->user()->college_department_id;

            $data['persons'] = Student::pluck('refrence_person_name');


            $fac = Faculty::where('status', '1')
                ->where('teacher_department', $teacherDepa) // column match karo
                ->orderBy('title', 'asc')
                ->first();
            //  dd($fac);

            if (!empty($request->department) || $request->department != null) {
                $data['college_department'] = $department = $request->department;
            } else {
                $data['college_department']  = $department =  $collegeDepartment;
            }

            if (!empty($request->faculty) || $request->faculty != null) {
                $data['selected_faculty'] = $faculty = $request->faculty;
            } else {
                $data['selected_faculty'] = $faculty = $fac->id ?? null;
            }
            if (!empty($request->program) || $request->program != null) {
                $data['selected_program'] = $program = $request->program;
            } else {
                $data['selected_program'] = $program = $teacherDepa ?? null;
            }



            $data['selected_session'] = $session = $request->session ?? null;
            $data['selected_semester'] = $semester = $request->semester ?? null;
            $data['selected_section'] = $section = $request->section ?? null;
            $data['selected_status'] = $status = $request->status ?? null;
            $data['selected_student_id'] = $student_id = $request->student_id ?? null;

            if (!empty($request->student_regi) || $request->student_regi != null) {
                $data['selected_student_regi'] = $student_regi = $request->student_regi;
            } else {
                $data['selected_student_regi'] = $student_regi = Null;
            }

            if (!empty($request->person) || $request->person != null) {
                $data['selected_person'] = $person = $request->person;
            } else {
                $data['selected_person'] = $person = '0';
            }


            // dd($faculty);


            $data['departments'] = CollegeDepartment::where('id', $collegeDepartment)->where('status', '1')->orderBy('title', 'asc')->get();



            $data['faculties'] = Faculty::where('status', '1')
                ->where('department_id', $collegeDepartment) // column match karo
                ->orderBy('title', 'asc')
                ->get();

            $data['statuses'] = StatusType::where('status', '1')->orderBy('title', 'asc')->get();

            // dd($request->faculty);

            if (!empty($request->faculty) && $request->faculty != '0' || !empty($faculty)) {
                //  dd($faculty);
                $data['programs'] = Program::where('faculty_id', $faculty)->where('status', '1')->orderBy('title', 'asc')->get();
                // dd($da);

            }

            if (!empty($request->program) && $request->program != '0') {
                $sessions = Session::where('status', 1);
                $sessions->with('programs')->whereHas('programs', function ($query) use ($program) {
                    $query->where('program_id', $program);
                });
                $data['sessions'] = $sessions->orderBy('id', 'desc')->get();
            }

            if (!empty($request->program) && $request->program != '0') {
                $semesters = Semester::where('status', 1);
                $semesters->with('programs')->whereHas('programs', function ($query) use ($program) {
                    $query->where('program_id', $program);
                });
                $data['semesters'] = $semesters->orderBy('id', 'asc')->get();
            }

            if (!empty($request->program) && $request->program != '0' && !empty($request->semester) && $request->semester != '0') {
                $sections = Section::where('status', 1);
                $sections->with('semesterPrograms')->whereHas('semesterPrograms', function ($query) use ($program, $semester) {
                    $query->where('program_id', $program);
                    $query->where('semester_id', $semester);
                });
                $data['sections'] = $sections->orderBy('title', 'asc')->get();
            }


            if (
                isset($request->faculty) || isset($request->program) || isset($request->session) || isset($request->semester) || isset($request->section) || isset($request->status) || isset($request->student_id)
                || isset($request->student_regi) || isset($request->person)
            ) {
                // Student Filter
                $students = Student::where('status', '1');
                if ($faculty != 0) {
                    $students->with('program')->whereHas('program', function ($query) use ($faculty) {
                        $query->where('faculty_id', $faculty);
                    });
                }
                $students->with('currentEnroll')->whereHas('currentEnroll', function ($query) use ($program, $session, $semester, $section) {
                    if ($program != 0) {
                        $query->where('program_id', $program);
                    }
                    if ($session != 0) {
                        $query->where('session_id', $session);
                    }
                    if ($semester != 0) {
                        $query->where('semester_id', $semester);
                    }
                    if ($section != 0) {
                        $query->where('section_id', $section);
                    }
                });
                if (!empty($request->status)) {
                    $students->with('statuses')->whereHas('statuses', function ($query) use ($status) {
                        $query->where('status_type_id', $status);
                    });
                }
                if (!empty($request->student_id)) {
                    $students->where('student_id', 'LIKE', '%' . $student_id . '%');
                }

                if (!empty($request->person)) {
                    $students->where('refrence_person_name', $person);
                }

                if (!empty($request->student_regi)) {
                    $students->where('registration_no', 'LIKE', '%' . $student_regi . '%');
                }

                $rows = $students->orderBy('student_id', 'desc')->get();

                // Array Sorting
                $data['rows'] = $rows->sortByDesc(function ($query) {

                    return $query->student_id;
                })->all();
            }


            $data['print'] = IdCardSetting::where('slug', 'student-card')->first();


            return view('admin.income.add_student_fees', $data);
        }
    }

public function editFeesCollection($id)
    {
        // dd($id);
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;

        $student = Student::findOrFail($id);

        $data['provinces'] = Province::where('status', '1')
            ->orderBy('title', 'asc')->get();
        $data['present_districts'] = District::where('status', '1')
            ->where('province_id', $student->present_province)
            ->orderBy('title', 'asc')->get();
        $data['permanent_districts'] = District::where('status', '1')
            ->where('province_id', $student->permanent_province)
            ->orderBy('title', 'asc')->get();
        $data['statuses'] = StatusType::where('status', '1')->get();

        if (auth()->user()->is_admin === 1) {
            // Admin ko saari batches dikhni chahiye
            $data['batches'] = Batch::where('status', '1')->orderBy('id', 'desc')->get();
        } elseif (auth()->user()->is_admin === 0) {
            // Teacher ko sirf uske department ki batch dikhni chahiye
            $teacherDepartment = auth()->user()->teacher_department; // ya ->faculty_name
            $collegeDepartment = auth()->user()->college_department_id;

            $batche = Batch::where('status', '1')->where('department_id', $collegeDepartment);

            //  $batche->with('programs')->whereHas('programs', function ($query) use ($teacherDepartment){
            //             $query->where('program_id', $teacherDepartment);
            //         });



            $data['batches'] = $batche->orderBy('title', 'asc')->get();
        }



        $data['row'] = $student;


        return view('admin.income.edit_fees_collection', $data);
    }

public function updateFeesCollection(Request $request, $id)
    {

        // Update Data
        try {
            DB::beginTransaction();

            $student = Student::findOrFail($id);

            if ($request->has('total_amounts')) {
                $student->total_amounts = $request->total_amounts;
            }
            if ($request->has('RefT')) {
                $student->refTotal = $request->RefT;
            }
            if ($request->has('CashT')) {
                $student->cashTotal = $request->CashT;
            }
            if ($request->has('BankT')) {
                $student->bankTotal = $request->BankT;
            }

            if ($request->has('deductionT')) {
                $student->deductionTotal = $request->deductionT;
            }


            $student->updated_by = Auth::guard('web')->user()->id;

            $student->save();


            //Remove Old References
            Refrence::where('student_id', $student->id)->delete();

            if (is_array($request->refrence_ids)) {
                foreach ($request->refrence_ids as $key => $refrence) {
                    if ($refrence != '' && $refrence != null) {
                        // Insert Data
                        $reference = new Refrence();
                        $reference->student_id = $student->id;
                        $reference->utr_no = $request->refrence_ids[$key];
                        $reference->ref_amount = $request->ref_amounts[$key];
                        $reference->ref_date = $request->ref_dates[$key];
                        $reference->ref_name = $request->ref_names[$key];
                        $reference->save();
                    }
                }
            }

            //Remove Old Cash Received
            CashReceived::where('student_id', $student->id)->delete();

            if (is_array($request->cash_ids)) {
                foreach ($request->cash_ids as $key => $cash) {
                    if ($cash != '' && $cash != null) {
                        // Insert Data
                        $cashReceived = new CashReceived();
                        $cashReceived->student_id = $student->id;
                        $cashReceived->utr_no = $request->cash_ids[$key];
                        $cashReceived->cash_amount = $request->cash_amounts[$key];
                        $cashReceived->cash_date = $request->cash_dates[$key];
                        $cashReceived->cash_name = $request->cash_names[$key];
                        $cashReceived->save();
                    }
                }
            }

            //Remove Old Bank Received
            BankReceived::where('student_id', $student->id)->delete();

            if (is_array($request->bank_ids)) {
                foreach ($request->bank_ids as $key => $bank) {
                    if ($bank != '' && $bank != null) {
                        // Insert Data
                        $bankReceived = new BankReceived();
                        $bankReceived->student_id = $student->id;
                        $bankReceived->receipt_no = $request->bank_ids[$key];
                        $bankReceived->utr_no = $request->utr_nos[$key];
                        $bankReceived->bank_amount = $request->bank_amounts[$key];
                        $bankReceived->bank_date = $request->bank_dates[$key];
                        $bankReceived->bank_name = $request->bank_names[$key];
                        $bankReceived->save();
                    }
                }
            }

            //Remove Old Deduction Received
            Deduction::where('student_id', $student->id)->delete();

            if (is_array($request->deduction_ids)) {
                foreach ($request->deduction_ids as $key => $deduction) {
                    if ($deduction != '' && $deduction != null) {
                        // Insert Data
                        $deductionReceived = new Deduction();
                        $deductionReceived->student_id = $student->id;
                        $deductionReceived->deduction_id = $request->deduction_ids[$key];
                        $deductionReceived->utr_no  = $request->utr_nos[$key];
                        $deductionReceived->purpose = $request->purposes[$key];
                        $deductionReceived->deduction_amount = $request->deduction_amounts[$key];
                        $deductionReceived->deduction_date = $request->deduction_dates[$key];
                        $deductionReceived->deduction_name = $request->deduction_names[$key];
                        
                        $deductionReceived->save();
                    }
                }
            }


            DB::commit();



            $notification = array(
                'message' => __('msg_updated_successfully'),
                'alert-type' => __('msg_success')
            );

            return redirect()->back()->with($notification);
        } catch (\Exception $e) {

            toastr('Update Error Occur', 'error');


            $notification = array(
                'message' => __('msg_updated_error'),
                'alert-type' => __('msg_error')
            );

            return redirect()->back()->with($notification);
        }
    }

public function feesReceipt(Request $request, $id)
    {

        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;

        $data['rows'] = Student::where('id', $id)->orderBy('student_id', 'asc')->get();

        return view('admin.income.fees_receipt', $data);
    }

public function feesMultiPrint(Request $request)
    {
        //
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;

        $students = explode(",", $request->students);

        // View
        $data['rows'] = Student::whereIn('id', $students)->orderBy('student_id', 'asc')->get();
        // $data['print'] = IdCardSetting::where('slug', 'student-card')->firstOrFail();

        return view('admin.income.fees_receipt', $data);
    }
}
