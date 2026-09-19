<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\Bilash;
use App\Models\Faculty;
use App\Models\Program;
use App\Models\Session;
use Illuminate\Http\Request;

class BilashController extends Controller
{



    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Module Data
        $this->title = trans_choice('module_bilash', 1);
        $this->route = 'admin.bilash';
        $this->view = 'admin.bilash';
        $this->path = 'bilash';
        $this->access = 'bilash-clc';


        $this->middleware('permission:' . $this->access . '-create|' . $this->access . '-edit|' . $this->access . '-delete', ['only' => ['index', 'show']]);
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

        if(auth()->user()->is_admin === 1)
        {

        $collegeDepart=auth()->user()->college_department_id; 
        
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
        $batch=Batch::where('department_id',$collegeDepart)->where('status', '1')
            ->orderBy('title', 'asc')
            ->first();   
        $ids = $batch->programs; // ya ->faculty_name

        $data['faculties'] = Faculty::where('status', '1')
             ->wherein('teacher_department',$ids->pluck('id')) // column match karo
            ->orderBy('title', 'asc')
            ->get();
        $data['programs'] = $ids;
        $data['sessions'] = Session::where('status', '1')->orderBy('title', 'asc')->get();

        if (!empty($request->faculty) && $request->faculty != '0') {
            $data['programs'] = Program::where('faculty_id', $faculty)->where('status', '1')->orderBy('title', 'asc')->get();
        }



        if (isset($request->session) || isset($request->program)  || isset($request->student_id) || isset($request->student_regi)) {


            $bilash = Bilash::where('status', '1');

            if (!empty($request->program)) {
                $bilash->where('program_id', $program);
            }
            if (!empty($request->session)) {
                $bilash->where('session_id', $session);
            }
            if (!empty($request->student_id)) {
                $bilash->where('student_id', 'like', '%' . $student_id . '%');
            }
            if (!empty($request->student_regi)) {
                $bilash->where('student_regi', 'like', '%' . $student_regi . '%');
            }




            $data['rows'] = $bilash->orderby('id', 'asc')->get();
        }

        $data['title'] = $this->title;

        return view($this->view . '.index', $data);

        }elseif(auth()->user()->is_admin === 0)
        {
        $teacherDepa = auth()->user()->teacher_department; // ya ->faculty_name
        $collegeDepartment=auth()->user()->college_department_id; 

        $fac = Faculty::where('status', '1')
         ->where('teacher_department', $teacherDepa) // column match karo
         ->orderBy('title', 'asc')
         ->first();
         
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
        $data['programs'] = Program::where('status', '1')->where('department_id',$collegeDepartment)
            ->orderBy('title', 'asc')
            ->get();
         
        $sessions = Session::where('status', 1);
        $sessions->with('programs')->whereHas('programs', function ($query) use ($program){
            $query->where('program_id', $program);
        });
        $data['sessions'] = $sessions->orderBy('id', 'desc')->get();

        if (!empty($request->faculty) && $request->faculty != '0') {
            $data['programs'] = Program::where('faculty_id', $faculty)->where('status', '1')->orderBy('title', 'asc')->get();
        }

        if (isset($request->session) || isset($request->program)  || isset($request->student_id) || isset($request->student_regi)) {


            $bilash = Bilash::where('status', '1');

            if (!empty($request->program)) {
                $bilash->where('program_id', $program);
            }
            if (!empty($request->session)) {
                $bilash->where('session_id', $session);
            }
            if (!empty($request->student_id)) {
                $bilash->where('student_id', 'like', '%' . $student_id . '%');
            }
            if (!empty($request->student_regi)) {
                $bilash->where('student_regi', 'like', '%' . $student_regi . '%');
            }




            $data['rows'] = $bilash->orderby('id', 'asc')->get();
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

        if(auth()->user()->is_admin === 1)
        {
        $collegeDepart=auth()->user()->college_department_id;
        //    dd($collegeDepart);
        $data['batches'] = Batch::where('department_id', $collegeDepart)->where('status', '1')->orderBy('id', 'desc')->get();
        $data['programs'] = Program::where('status', '1')->where('department_id',$collegeDepart)
            ->orderBy('title', 'asc')
            ->get();

        return view(
            $this->view . '.create',
            $data
        );
        }elseif(auth()->user()->is_admin === 0)
        {
            $teacherDepa = auth()->user()->teacher_department; // ya ->faculty_name
            $collegeDepartment=auth()->user()->college_department_id;

            $batche = Batch::where('department_id', $collegeDepartment)->where('status', '1');
        
            $data['batches'] = $batche->orderBy('title', 'asc')->get();
            $data['programs'] = Program::where('status', '1')->where('department_id',$collegeDepartment)
            ->orderBy('title', 'asc')
            ->get();

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
            'division' => 'required',
            'dob' => 'required|date',
            'mr_no' => 'required',
            'registration_no' => 'required',
            'college_name' => 'required',

            'batch' => 'required',
            'program' => 'required',
            'session' => 'required',

        ]);

        try{
        //Data Insert
            $bilash = new Bilash();
            $bilash->student_id = $request->student_id;
            $bilash->registration_no = $request->registration_no;
            $bilash->clc_no = $request->mr_no;
            $bilash->batch_id = $request->batch;
            $bilash->program_id = $request->program;

            $bilash->session_id = $request->session;
            $bilash->name = $request->name;
            $bilash->father_name = $request->father_name;
            $bilash->mother_name = $request->mother_name;
            $bilash->division = $request->division;
            $bilash->date = $request->dob;
            $bilash->mr_no = $request->mr_no;

            $bilash->college_name = $request->college_name;
            $bilash->status = '1';
            $bilash->save();


            $notification = array(
            'message' => __('msg_created_successfully'),
            'alert-type' => __('msg_success')
             );

        return redirect()->route($this->route . '.index', $data)->with($notification);

        }catch(\Exception $e)
        {
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
    public function edit(Bilash $bilash)
    {
        

        
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;
        $data['access'] = $this->access;

         if (auth()->user()->is_admin === 1) {
            $data['row'] = $bilash;

            $program_id = $bilash->program_id; // ya ->faculty_name

            $collegeDepart=auth()->user()->college_department_id;
            //    dd($collegeDepart);
            $data['batches'] = Batch::where('department_id', $collegeDepart)->where('status', '1')->orderBy('id', 'desc')->get();
            $data['programs'] = Program::where('status', '1')->where('department_id',$collegeDepart)
            ->orderBy('title', 'asc')
            ->get();


            $sessions = Session::where('status', 1);
            $sessions->with('programs')->whereHas('programs', function ($query) use ($program_id) {
                $query->where('program_id', $program_id);
            });
            $data['sessions'] = $sessions->orderBy('title', 'asc')->get();

            return view($this->view . '.edit', $data);
        } elseif (auth()->user()->is_admin === 0) {
            $data['row'] = $bilash;

            $teacherDepa = auth()->user()->teacher_department; // ya ->faculty_name
            $program_id = $bilash->program_id; // ya ->faculty_name
            $collegeDepartment=auth()->user()->college_department_id;
            $data['batches'] = Batch::where('department_id', $collegeDepartment)->where('status', '1')
                ->orderBy('title', 'asc')
                ->get();
            
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
    public function update(Request $request, Bilash $bilash)
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
            'division' => 'required',
            'dob' => 'required|date',
            'mr_no' => 'required',

            'college_name' => 'required',

            'batch' => 'required',
            'program' => 'required',
            'session' => 'required',

        ]);


        //Data Update
        $bilash->student_id = $request->student_id;
        $bilash->registration_no = $request->registration_no;
        $bilash->clc_no = $request->mr_no;
        $bilash->batch_id = $request->batch;
        $bilash->program_id = $request->program;
        $bilash->session_id = $request->session;
        $bilash->name = $request->name;
        $bilash->father_name = $request->father_name;
        $bilash->mother_name = $request->mother_name;
        $bilash->division = $request->division;
        $bilash->date = $request->dob;
        $bilash->mr_no = $request->mr_no;

        $bilash->college_name = $request->college_name;
        $bilash->status = '1';
        $bilash->update();
        $notification = array(
            'message' => __('msg_updated_successfully'),
            'alert-type' => __('msg_success')
        );

        return redirect()->route($this->route . '.index' ,$data)->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bilash $bilash)
    {
        
            //Delete Data
        $bilash->delete();
        $notification = array(
            'message' => __('msg_deleted_successfully'),
            'alert-type' => __('msg_success')
        );

        return redirect()->back()->with($notification);
    }

    public function clc($id)
    {
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;
        $data['access'] = $this->access;

        $data['rows'] =  Bilash::where('id', $id)->orderBy('student_id', 'asc')->get();

        return view($this->view . '.clc', $data);
    }
}
