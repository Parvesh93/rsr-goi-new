<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentEnroll;
use Illuminate\Http\Request;
use App\Models\Semester;
use App\Models\Program;
use App\Models\Section;
use App\Models\Session;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Grade;
use Toastr;
use Auth;
use DB;

class StudentSingleEnrollController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Module Data
        $this->title = trans_choice('module_single_enroll', 1);
        $this->route = 'admin.single-enroll';
        $this->view = 'admin.single-enroll';
        $this->path = 'student';
        $this->access = 'student-enroll';


        $this->middleware('permission:'.$this->access.'-single');
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


        // dd($request->student);

        if(!empty($request->student) || $request->student != null){
            $data['selected_student'] = $request->student;
        }
        else{
            $data['selected_student'] =  '0';
        }
        // if(!empty($request->college_status) || $request->college_status != null){
        //     $data['selected_college_id'] =$college= $request->college_status;
        // }
        // else{
        //     $data['selected_college_id'] =$college=  '0';
        // }
        


        $data['students'] = Student::whereHas('currentEnroll')->where('status', '1')->orderBy('student_id', 'asc')->get();
        
        if(!empty($request->student) && $request->student != Null){

            

            
    

            $data['row'] = $student = Student::where('student_id', $request->student)->first();

            // dd($student);

            // Filter Enroll Data
            $data['programs'] = Program::where('status', '1')->orderBy('title', 'asc')->get();

            $data['sessions'] = Session::with('programs')->whereHas('programs', function ($query) use ($student){
                $query->where('program_id', $student->program_id);
            })->where('status', '1')->orderBy('id', 'desc')->get();
            
            $data['semesters'] = Semester::with('programs')->whereHas('programs', function ($query) use ($student){
                $query->where('program_id', $student->program_id);
            })->where('status', '1')->orderBy('id', 'asc')->get();

            $data['sections'] = Section::with('semesterPrograms')->whereHas('semesterPrograms', function ($query) use ($student){
                $query->where('program_id', $student->program_id);
            })->where('status', '1')->orderBy('title', 'asc')->get();

            $data['subjects'] = Subject::with('programs')->whereHas('programs', function ($query) use ($student){
                $query->where('program_id', $student->program_id);
            })->where('status', '1')->orderBy('code', 'asc')->get();

            $data['grades'] = Grade::where('status', '1')->orderBy('min_mark', 'desc')->get();
        }
        else {
            $data['selected_student'] = Null;
        }

        return view($this->view.'.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         
        // dd($request->college_id);

        // Field Validation
        $request->validate([
            'student' => 'required',
            'program' => 'required',
            'semester' => 'required',
            'session' => 'required',
            
            'subjects' => 'required',
            
        ]);


        try{
            // DB::beginTransaction();
            // Duplicate Enroll Check
            $duplicate_check = StudentEnroll::where('student_id', $request->student)->where('session_id', $request->session)->where('semester_id', $request->semester)
            ->first();
             
            $session_check = StudentEnroll::where('student_id', $request->student)
            ->where('session_id', $request->session)
            
            ->first();
            // $semester_check = StudentEnroll::where('student_id', $request->student)->where('semester_id', $request->semester)->first();
             
            if(!isset($duplicate_check) && !isset($session_check)){
                // Pre Enroll Update
                $pre_enroll = StudentEnroll::where('student_id', $request->student)->where('status', '1')->first();
                if(isset($pre_enroll)){
                    $pre_enroll->status = '0';
                    $pre_enroll->save();
                }

                // Student New Enroll
                $enroll = new StudentEnroll;
                $enroll->student_id = $request->student;
                $enroll->program_id = $request->program;
                $enroll->session_id = $request->session;
                $enroll->semester_id = $request->semester;
                $enroll->section_id = 1;
                
                
                $enroll->created_by = Auth::guard('web')->user()->id;
                $enroll->save();

                // Attach Subject
                $enroll->subjects()->attach($request->subjects);

                // Program Update
                $student = Student::find($request->student);
                $student->program_id = $request->program;
                $student->save();

                // Toastr::success(__('msg_promoted_successfully'), __('msg_success'));
              
                $notification = array(
                'message' => __('msg_promoted_successfully'),
                'alert-type' => __('msg_success')
            );
    
             return redirect()->back()->with($notification);
            //  DB::commit();

            }
            else{

                // Toastr::error(__('msg_enroll_already_exists'), __('msg_error'));
                
                  $notification = array(
                'message' => __('msg_enroll_already_exists'),
                'alert-type' => __('msg_success')
            );
    
            return redirect()->back()->with($notification);
            }
           

            
        }
        catch(\Exception $e){

            // Toastr::error(__('msg_created_error'), __('msg_error'));
                $notification = array(
                'message' => __('msg_created_error'),
                'alert-type' => __('msg_error')
            );
    
            return redirect()->back()->with($notification);
           


            
        }
    }
}
