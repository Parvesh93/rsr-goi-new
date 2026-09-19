<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\CollegeDepartment;
use App\Models\Faculty;
use App\Models\InterProvisional;
use App\Models\Program;
use App\Models\Session;
use Illuminate\Http\Request;

class InterProvisionalController extends Controller
{
  /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Module Data
        $this->title = trans_choice('module_inter_provisional', 1);
        $this->route = 'admin.inter-provisional';
        $this->view = 'admin.inter-provisional';
        $this->path = 'inter-provisional';
        $this->access = 'inter-provisional';


        $this->middleware('permission:' . $this->access . '-view|' . $this->access . '-create|' . $this->access . '-edit|' . $this->access . '-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:' . $this->access . '-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:' . $this->access . '-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:' . $this->access . '-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;
        $data['access'] = $this->access;



        if (auth()->user()->is_admin === 1) {

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

            if (!empty($request->student_id) || $request->student_id != null) {
                $data['selected_student_id'] = $student_id = $request->student_id;
            } else {
                $data['selected_student_id'] = Null;
            }

            if (!empty($request->student_regi) || $request->student_regi != null) {
                $data['selected_student_regi'] = $student_regi = $request->student_regi;
            } else {
                $data['selected_student_regi'] = Null;
            }

            $data['departments'] = CollegeDepartment::where('status', '1')->orderBy('title', 'asc')->get();

            $data['faculties'] = Faculty::where('status', '1')
                ->orderBy('title', 'asc')
                ->get();
            $data['programs'] = Program::where('status', '1')
                ->orderBy('title', 'asc')
                ->get();
            $data['sessions'] = Session::where('status', '1')->orderBy('title', 'asc')->get();


            if (!empty($request->faculty) && $request->faculty != '0') {
                $data['programs'] = Program::where('faculty_id', $faculty)->where('status', '1')->orderBy('title', 'asc')->get();
            }



            if (isset($request->session) || isset($request->program)  || isset($request->student_id) || isset($request->student_regi)) {


                $inter_provisional = InterProvisional::where('status', '1');

                if (!empty($request->program)) {
                    $inter_provisional->where('program_id', $program);
                }
                if (!empty($request->session)) {
                    $inter_provisional->where('session_id', $session);
                }
                if (!empty($request->student_id)) {
                    $inter_provisional->where('student_id', 'like', '%' . $student_id . '%');
                }
                if (!empty($request->student_regi)) {
                    $inter_provisional->where('registration_no', 'like', '%' . $student_regi . '%');
                }




                $data['rows'] = $inter_provisional->orderby('id', 'desc')->get();
            }

            $data['title'] = $this->title;

            return view($this->view . '.index', $data);
        } elseif (auth()->user()->is_admin === 0) {
            $teacherDepa = auth()->user()->teacher_department; // ya ->faculty_name

            $collegeDepartment = auth()->user()->college_department_id;
            // dd($collegeDepa);
            $data['departments'] = CollegeDepartment::where('id', $collegeDepartment)->where('status', '1')->orderBy('title', 'asc')->get();

            $fac = Faculty::where('status', '1')
                ->where('teacher_department', $teacherDepa) // column match karo
                ->orderBy('title', 'asc')
                ->first();

            // $data['selected_faculty'] = $faculty = $fac->id; // Ya department_id agar wo use kar rahe ho
            // $data['selected_program'] = $program = $teacherDepa ?? null;
            if (!empty($request->department) || $request->department != null) {
                $data['college_department'] = $department = $request->department;
            } else {
                $data['college_department']  = $department = $collegeDepartment ?? null;
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


            if (!empty($request->session) || $request->session != null) {
                $data['selected_session'] = $session = $request->session;
            } else {
                $data['selected_session'] = $session = '0';
            }

            if (!empty($request->student_id) || $request->student_id != null) {
                $data['selected_student_id'] = $student_id = $request->student_id;
            } else {
                $data['selected_student_id'] = Null;
            }

            if (!empty($request->student_regi) || $request->student_regi != null) {
                $data['selected_student_regi'] = $student_regi = $request->student_regi;
            } else {
                $data['selected_student_regi'] = Null;
            }


            $data['faculties'] = Faculty::where('status', '1')
                ->where('department_id', $collegeDepartment) // column match karo
                ->orderBy('title', 'asc')
                ->get();
            $data['programs'] = Program::where('status', '1')->where('department_id', $collegeDepartment)
                ->orderBy('title', 'asc')
                ->get();

            $sessions = Session::where('status', 1);
            $sessions->with('programs')->whereHas('programs', function ($query) use ($program) {
                $query->where('program_id', $program);
            });
            $data['sessions'] = $sessions->orderBy('id', 'desc')->get();


            if (!empty($request->faculty) && $request->faculty != '0') {
                $data['programs'] = Program::where('faculty_id', $faculty)->where('status', '1')->orderBy('title', 'asc')->get();
            }



            if (isset($request->session) || isset($request->program)  || isset($request->student_id) || isset($request->student_regi)) {


                $inter_provisional = InterProvisional::where('status', '1');

                if (!empty($request->program)) {
                    $inter_provisional->where('program_id', $program);
                }
                if (!empty($request->session)) {
                    $inter_provisional->where('session_id', $session);
                }
                if (!empty($request->student_id)) {
                    $inter_provisional->where('student_id', 'like', '%' . $student_id . '%');
                }
                if (!empty($request->student_regi)) {
                    $inter_provisional->where('registration_no', 'like', '%' . $student_regi . '%');
                }




                $data['rows'] = $inter_provisional->orderby('id', 'desc')->get();
            }

            $data['title'] = $this->title;

            return view($this->view . '.index', $data);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;
        $data['access'] = $this->access;


        if (auth()->user()->is_admin === 1) {

            $data['batches'] = Batch::where('status', '1')->orderBy('id', 'desc')->get();

            $data['programs'] = Program::where('status', '1')
                ->orderBy('title', 'asc')
                ->get();
            //   $data['sessions'] = Session::where('status', '1')->orderBy('title', 'asc')->get();

            return view(
                $this->view . '.create',
                $data
            );
        } elseif (auth()->user()->is_admin === 0) {
            $teacherDepa = auth()->user()->teacher_department; // ya ->faculty_name


            $collegeDepartment = auth()->user()->college_department_id;

            $batche = Batch::where('department_id', $collegeDepartment)->where('status', '1');
            // $batche->with('programs')->whereHas('programs', function ($query) use ($teacherDepa){
            //         $query->where('program_id', $teacherDepa);
            //     });

            $data['batches'] = $batche->orderBy('title', 'asc')->get();

            $data['programs'] = Program::where('status', '1')->where('department_id', $collegeDepartment)
                ->orderBy('title', 'asc')
                ->get();

            //    $sessions = Session::where('status', 1);
            //    $sessions->with('programs')->whereHas('programs', function ($query) use ($teacherDepa){
            //     $query->where('program_id', $teacherDepa);
            //   });
            //   $data['sessions'] = $sessions->orderBy('id', 'desc')->get();

            return view(
                $this->view . '.create',
                $data
            );
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;
        $data['access'] = $this->access;

        //Field Validation
        $request->validate([
            'student_id' => 'required',
            'name' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'result' => 'required',
            'dob' => 'required|date',

            'registration_no' => 'required',


            'batch' => 'required',
            'program' => 'required',
            'session' => 'required',

        ]);
    



        try {
            //Data Insert
            $inter_provisional = new InterProvisional();
            $inter_provisional->student_id = $request->student_id;
            $inter_provisional->registration_no = $request->registration_no;

            $inter_provisional->batch_id = $request->batch;
            $inter_provisional->program_id = $request->program;

            $inter_provisional->session_id = $request->session;
            $inter_provisional->name = $request->name;
            $inter_provisional->father_name = $request->father_name;
            $inter_provisional->mother_name = $request->mother_name;
            $inter_provisional->result = $request->result;
            $inter_provisional->date = $request->dob;

            $inter_provisional->save();
            $inter_provisional->serial_no = '000' . $inter_provisional->id;

            $inter_provisional->save();

            // Generate registration number and CLC number


            // $old_student->save();


            $notification = array(
                'message' => __('msg_created_successfully'),
                'alert-type' => __('msg_success')
            );

            return redirect()->route($this->route . '.index', $data)->with($notification);
        } catch (\Exception $e) {
            $notification = array(
                'message' => __('msg_created_error'),
                'alert-type' => __('msg_error')
            );

            return redirect()->back()->with($notification);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, InterProvisional $inter_provisional)
    {
        // dd($id);
        // dd($request->all());
        // dd($old_student->program_id);

        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;
        $data['access'] = $this->access;


        if (auth()->user()->is_admin === 1) {

            $data['batches'] = Batch::where('status', '1')->orderBy('id', 'desc')->get();
            $data['row'] = $inter_provisional;
            $data['programs'] = Program::where('status', '1')
                ->orderBy('title', 'asc')
                ->get();
            $data['sessions'] = Session::where('status', '1')->orderBy('title', 'asc')->get();

            return view($this->view . '.edit', $data);
        } elseif (auth()->user()->is_admin === 0) {


            $data['row'] = $inter_provisional;
            $teacherDepa = auth()->user()->teacher_department; // ya ->faculty_name
            $program_id = $inter_provisional->program_id; // ya ->faculty_name
            $collegeDepartment = auth()->user()->college_department_id;
            $batche = Batch::where('status', '1')->where('department_id', $collegeDepartment);

            // $batche->with('programs')->whereHas('programs', function ($query) use ($teacherDepa){
            //             $query->where('program_id', $teacherDepa);
            //         });    
            $data['batches'] = $batche->orderBy('title', 'asc')->get();

            $data['programs'] = Program::where('status', '1')->where('department_id', $collegeDepartment)
                ->orderBy('title', 'asc')
                ->get();
            $sessions = Session::where('status', 1);
            $sessions->with('programs')->whereHas('programs', function ($query) use ($program_id) {
                $query->where('program_id', $program_id);
            });
            $data['sessions'] = $sessions->orderBy('title', 'asc')->get();

            return view($this->view . '.edit', $data);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InterProvisional $inter_provisional)
    {


        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;
        $data['access'] = $this->access;

        //Field Validation
        $request->validate([
            'student_id' => 'required',
            'name' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'result' => 'required',
            'dob' => 'required|date',
            'registration_no' => 'required',

            'batch' => 'required',
            'program' => 'required',
            'session' => 'required',

        ]);


        //Data Update
        $inter_provisional->student_id = $request->student_id;
        $inter_provisional->registration_no = $request->registration_no;

        $inter_provisional->batch_id = $request->batch;
        $inter_provisional->program_id = $request->program;
        $inter_provisional->session_id = $request->session;
        $inter_provisional->name = $request->name;
        $inter_provisional->father_name = $request->father_name;
        $inter_provisional->mother_name = $request->mother_name;
        $inter_provisional->result = $request->result;
        $inter_provisional->date = $request->dob;

        $inter_provisional->update();
        $notification = array(
            'message' => __('msg_updated_successfully'),
            'alert-type' => __('msg_success')
        );

        return redirect()->route($this->route . '.index', $data)->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InterProvisional $inter_provisional)
    {
        //Delete Data
        $inter_provisional->delete();

        // Toastr::success(__('msg_deleted_successfully'), __('msg_success'));
        $notification = array(
            'message' => __('msg_deleted_successfully'),
            'alert-type' => __('msg_success')
        );

        return redirect()->back()->with($notification);
    }

    public function provisional($id)
    {
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;
        $data['access'] = $this->access;

        $data['batches'] = Batch::where('status', '1')->orderBy('id', 'desc')->get();

        $data['rows'] = InterProvisional::where('id', $id)->orderBy('student_id', 'asc')->get();

        return view($this->view . '.provisional', $data);
    }
}
