<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\Controller;
use App\Models\StudentRelative;
use App\Models\Refrence;
use App\Models\CashReceived;
use App\Models\BankReceived;
use App\Models\StudentEnroll;
use App\Models\EnrollSubject;
use Illuminate\Http\Request;
use App\Traits\FileUploader;
use App\Models\Application;
use App\Models\StatusType;
use App\Models\Province;
use App\Models\District;
use App\Models\Document;
use App\Models\Program;
use App\Models\Student;
use App\Models\Deduction;
use App\Models\Batch;
use Carbon\Carbon;
use App\Models\CollegeDepartment;

use Auth;
use Hash;
use DB;

class ApplicationController extends Controller
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
        $this->title = trans_choice('module_application', 1);
        $this->route = 'admin.application';
        $this->view = 'admin.application';
        $this->path = 'student';
        $this->access = 'application';


        $this->middleware('permission:'.$this->access.'-view|'.$this->access.'-create|'.$this->access.'-edit|'.$this->access.'-delete', ['only' => ['index','show']]);
        $this->middleware('permission:'.$this->access.'-create', ['only' => ['create','store']]);
        $this->middleware('permission:'.$this->access.'-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:'.$this->access.'-delete', ['only' => ['destroy']]);
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
        

       
       if(auth()->user()->is_admin === 1)
       {
           
           
        
             if (!empty($request->department) || $request->department != null) {
                $data['college_department'] = $department = $request->department;
            } else {
                $data['college_department']  = $department = '0';
            }   
           
           
        if(!empty($request->batch) || $request->batch != null){
        $data['selected_batch'] = $batch = $request->batch;
        }
        else{
            $data['selected_batch'] = '0';
        }

        if(!empty($request->program) || $request->program != null){
            $data['selected_program'] = $program = $request->program;
        }
        else{
            $data['selected_program'] = '0';
        }

        if(!empty($request->status) || $request->status != null){
            $data['selected_status'] = $status = $request->status;
        }
        else{
            $data['selected_status'] = $status = '99';
        }

        if(!empty($request->start_date) || $request->start_date != null){
            $data['selected_start_date'] = $start_date = $request->start_date;
        }
        else{
            $data['selected_start_date'] = $start_date = date('Y-m-d', strtotime(Carbon::now()->subYear()));
        }

        if(!empty($request->end_date) || $request->end_date != null){
            $data['selected_end_date'] = $end_date = $request->end_date;
        }
        else{
            $data['selected_end_date'] = $end_date = date('Y-m-d', strtotime(Carbon::today()));
        }

        if(!empty($request->registration_no) || $request->registration_no != null){
            $data['selected_registration_no'] = $registration_no = $request->registration_no;
        }
        else{
            $data['selected_registration_no'] = Null;
        }
        
        
        if (!empty($request->person) || $request->person != null) {
                $data['selected_person'] = $person = $request->person;
            } else {
                $data['selected_person'] = $person = '0';
            }
            // $data['persons'] = Application::pluck('ref_persion');
            
            $data['persons'] = Application::whereNotNull('refrence_person_name')
                ->where('refrence_person_name', '!=', '')
                ->distinct()
                ->orderBy('refrence_person_name')
                ->pluck('refrence_person_name');

 
        // Search Filter
        $data['departments'] = CollegeDepartment::where('status', '1')->orderBy('title', 'asc')->get();
        $data['batches'] = Batch::where('status', '1')->orderBy('id', 'desc')->get();
        $data['programs'] = Program::where('status', '1')->orderBy('title', 'asc')->get();


        if(isset($request->program) || isset($request->status) || isset($request->registration_no) || isset($request->person) || isset($request->department)){
            // Application Filter
            $applications = Application::whereDate('apply_date', '>=', $start_date)
                        ->whereDate('apply_date', '<=', $end_date);
                        if(!empty($request->batch)){
                            $applications->where('batch_id', $batch);
                        }
                        if(!empty($request->program)){
                            $applications->where('program_id', $program);
                        }
                        if(!empty($request->department) && $department != '0'){
                            $applications->where('department_id', $department);
                        }
                        if(!empty($request->person) && $person != '0'){
                            $applications->where('refrence_person_name', $person);
                        }
                        if(!empty($request->registration_no)){
                            $applications->where('registration_no', 'LIKE', '%'.$registration_no.'%');
                        }
                        if(!empty($request->status) || $request->status != null){
                            $applications->where('status', $status);
                        }
            $data['rows'] = $applications->orderBy('registration_no', 'desc')->get();
        }


        return view($this->view.'.index', $data);
           
       }elseif(auth()->user()->is_admin === 0)
       {
           
        $teacherDepa = auth()->user()->teacher_department; // ya ->faculty_name
        $collegeDepartment = auth()->user()->college_department_id;
        
        
             if (!empty($request->department) || $request->department != null) {
                $data['college_department'] = $department = $request->department;
            } else {
                $data['college_department']  = $department = $collegeDepartment ?? null;
            }
           
        if(!empty($request->batch) || $request->batch != null){
            $data['selected_batch'] = $batch = $request->batch;
        }
        else{
            $data['selected_batch'] = '0';
        }

         if (!empty($request->program) || $request->program != null) {
                $data['selected_program'] = $program = $request->program;
            } else {
                $data['selected_program'] = $program = $teacherDepa ?? null;
        }

        //  $data['selected_program'] = $program = $teacherDepa ?? null;

        if(!empty($request->status) || $request->status != null){
            $data['selected_status'] = $status = $request->status;
        }
        else{
            $data['selected_status'] = $status = '99';
        }

        if(!empty($request->start_date) || $request->start_date != null){
            $data['selected_start_date'] = $start_date = $request->start_date;
        }
        else{
            $data['selected_start_date'] = $start_date = date('Y-m-d', strtotime(Carbon::now()->subYear()));
        }

        if(!empty($request->end_date) || $request->end_date != null){
            $data['selected_end_date'] = $end_date = $request->end_date;
        }
        else{
            $data['selected_end_date'] = $end_date = date('Y-m-d', strtotime(Carbon::today()));
        }

        if(!empty($request->registration_no) || $request->registration_no != null){
            $data['selected_registration_no'] = $registration_no = $request->registration_no;
        }
        else{
            $data['selected_registration_no'] = Null;
        }
        
         if (!empty($request->person) || $request->person != null) {
                $data['selected_person'] = $person = $request->person;
            } else {
                $data['selected_person'] = $person = '0';
            }
            // $data['persons'] = Application::pluck('ref_persion');
            
            $data['persons'] = collect();


        // Search Filter
        $data['departments'] = CollegeDepartment::where('id', $collegeDepartment)->where('status', '1')->orderBy('title', 'asc')->get();
        
        $data['batches'] = Batch::where('status', '1')->orderBy('id', 'desc')->get();
        $data['programs'] = Program::where('status', '1')->where('department_id',$collegeDepartment)->orderBy('title', 'asc')->get();


        if(isset($request->program) || isset($request->status) || isset($request->registration_no)){
            // Application Filter
            $applications = Application::whereDate('apply_date', '>=', $start_date)
                        ->whereDate('apply_date', '<=', $end_date);
                        if(!empty($request->batch)){
                            $applications->where('batch_id', $batch);
                        }
                        if(!empty($request->program)){
                            $applications->where('program_id', $program);
                        }
                        if(!empty($request->registration_no)){
                            $applications->where('registration_no', 'LIKE', '%'.$registration_no.'%');
                        }
                        if(!empty($request->status) || $request->status != null){
                            $applications->where('status', $status);
                        }
            $data['rows'] = $applications->orderBy('registration_no', 'desc')->get();
        }


        return view($this->view.'.index', $data);
           
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        
        // dd($request->total_amounts);
        // Field Validation
        $request->validate([
            'student_id' => 'required|unique:students,student_id',
            'batch' => 'required',
            'program' => 'required',
            'session' => 'required',
            'semester' => 'required',
            
            'first_name' => 'required',
            
            'email' => 'required|email|unique:students,email',
            'phone' => 'required',
            'gender' => 'required',
            'caste'=>'required',
            'admission_mode'=>'required',
            'total_course_fees'=>'required',
            
            'dob' => 'required|date',
            'admission_date' => 'required|date',
            'photo' => 'nullable|image',
            'signature' => 'nullable|image',
        ]);
        
        // dd('su');

        // Random Password
        $password = str_random(8);
        $data = Application::where('registration_no', $request->registration_no)->firstOrFail();

        // Insert Data
         try{
            DB::beginTransaction();
            
            $application = new Student;
            $application->student_id = $request->student_id;
            // $application->registration_no = $request->registration_no;
            $application->batch_id = $request->batch;
            $application->program_id = $request->program;
            $application->admission_date = $request->admission_date;

            $application->first_name = $request->first_name;
            $application->last_name = $request->last_name;
            $application->father_name = $request->father_name;
            $application->mother_name = $request->mother_name;
            $application->father_occupation = $request->father_occupation;
            $application->mother_occupation = $request->mother_occupation;
            $application->email = $request->email;
            $application->password = Hash::make($password);
            $application->password_text = Crypt::encryptString($password);

            $application->country = $request->country;
            
            $application->present_province = $request->present_province;
            $application->present_district = $request->present_district;
            $application->present_village = $request->present_village;
            $application->present_address = $request->present_address;
            $application->present_post = $request->present_post;
            $application->present_pin = $request->present_pin;
            $application->present_police_station = $request->present_police_station;
            
            $application->permanent_province = $request->permanent_province;
            $application->permanent_district = $request->permanent_district;
            $application->permanent_village = $request->permanent_village;
            $application->permanent_address = $request->permanent_address;
            $application->permanent_post = $request->permanent_post;
            $application->permanent_pin = $request->permanent_pin;
            $application->permanent_police_station = $request->permanent_police_station;


            $application->gender = $request->gender;
            
            $application->pan_id = $request->pan_id;

            $application->dob = $request->dob;
            $application->phone = $request->phone;
            $application->emergency_phone = $request->emergency_phone;

            $application->religion = $request->religion;
            $application->caste = $request->caste;
            $application->mother_tongue = $request->mother_tongue;
            $application->marital_status = $request->marital_status;
            $application->blood_group = $request->blood_group;
            $application->nationality = $request->nationality;
            $application->national_id = $request->national_id;
            $application->passport_no = $request->passport_no;

            $application->high_school_name = $request->high_school_name;
            $application->high_school_address = $request->high_school_study_address;
            $application->high_school_graduation_year = $request->high_school_graduation_year;
            $application->high_school_graduation_percentage = $request->high_school_graduation_percentage;
            $application->high_school_total_marks = $request->high_school_total_marks;
            $application->high_school_marks_obtained = $request->high_school_total_marks_obtained;


            $application->intermediate_name = $request->intermediate_name;
            $application->intermediate_address = $request->intermediate_study_address;
            $application->intermediate_graduation_year = $request->intermediate_graduation_year;
            $application->inter_graduation_percentage = $request->intermediate_graduation_percentage;
            $application->intermediate_total_marks = $request->intermediate_total_marks;
            $application->intermediate_marks_obtained = $request->intermediate_total_marks_obtained;

            $application->bach_college_name = $request->bachelor_college_name;
            $application->bach_college_address = $request->bachelor_study_address;
            $application->bach_gradu_year = $request->bachelor_graduation_year;
            $application->bach_gradu_percentage = $request->bachelor_graduation_percentage;
            $application->bach_total_marks = $request->bachelor_total_marks;
            $application->bach_marks_obtained = $request->bachelor_total_marks_obtained;
            
            if ($request->has('total_amounts')) {
              $application->total_amounts = $request->total_amounts;
            }
            if ($request->has('RefT')) {
              $application->refTotal = $request->RefT;
            }
            if ($request->has('CashT')) {
              $application->cashTotal = $request->CashT;
            }
            if ($request->has('BankT')) {
              $application->bankTotal = $request->BankT;
            }
            
             if ($request->has('deductionT')) {
              $application->deductionTotal = $request->deductionT;
            }
            
            
            
            $application->admission_mode = $request->admission_mode;
            $application->total_course_fees = $request->total_course_fees;
            $application->refrence_person_name = $request->refrence_person_name;

            $application->master_college_name = $request->master_college_name;
            $application->master_college_address = $request->master_study_address;
            $application->master_gradu_year = $request->master_graduation_year;
            $application->master_gradu_percentage = $request->master_graduation_percentage;
            $application->master_total_marks = $request->master_total_marks;
            $application->master_marks_obtained = $request->master_total_marks_obtained;

            if($request->hasFile('school_transcript')){
            $application->school_transcript = $this->uploadMedia($request, 'high_school_certificate', $this->path);
            }
            else{
            $application->school_transcript = $data->school_transcript;
            }
            
            if($request->hasFile('high_school_certificate')){
            $application->high_school_certificate = $this->uploadMedia($request, 'high_school_certi', $this->path);
            }
            else{
            $application->high_school_certificate = $data->high_school_certificate;
            }
            
            if($request->hasFile('school_slc')){
            $application->school_slc = $this->uploadMedia($request, 'high_school_slc', $this->path);
            }
            else{
            $application->school_slc = $data->school_slc;
            }
            
            if($request->hasFile('school_certificate')){
            $application->school_certificate = $this->uploadMedia($request, 'intermediate_certificate', $this->path);
            }
            else{
            $application->school_certificate = $data->school_certificate;
            }
            
            if($request->hasFile('intermediate_certificate')){
            $application->intermediate_certificate = $this->uploadMedia($request, 'intermediate_certi', $this->path);
            }
            else{
            $application->intermediate_certificate = $data->intermediate_certificate;
            }
            
            
            if($request->hasFile('intermediate_clc')){
            $application->intermediate_clc = $this->uploadMedia($request, 'intermediate_clc', $this->path);
            }
            else{
            $application->intermediate_clc = $data->intermediate_clc;
            }
            if($request->hasFile('intermediate_migration')){
            $application->intermediate_migration = $this->uploadMedia($request, 'intermediate_migration', $this->path);
            }
            else{
            $application->intermediate_migration = $data->intermediate_migration;
            }
            
            
            if($request->hasFile('collage_transcript')){
            $application->collage_transcript = $this->uploadMedia($request, 'bachelor_certificate', $this->path);
            }
            else{
            $application->collage_transcript = $data->collage_transcript;
            }
            if($request->hasFile('collage_certificate')){
            $application->collage_certificate = $this->uploadMedia($request, 'master_certificate', $this->path);
            }
            else{
            $application->collage_certificate = $data->collage_certificate;
            }
            
            if($request->hasFile('collage_migration')){
            $application->collage_migration = $this->uploadMedia($request, 'collage_migration', $this->path);
            }
            else{
            $application->collage_migration = $data->collage_migration;
            }
            
            if($request->hasFile('adhar_card')){
            $application->adhar_card = $this->uploadMedia($request, 'adhar_card', $this->path);
            }
            else{
            $application->adhar_card = $data->adhar_card;
            }
            
            if($request->hasFile('parents_id')){
            $application->parents_id = $this->uploadMedia($request, 'parents_id', $this->path);
            }
            else{
            $application->parents_id = $data->parents_id;
            }
            
              if($request->hasFile('pan_card')){
            $application->pan_card = $this->uploadMedia($request, 'pan_card', $this->path);
            }
            else{
            $application->pan_card = $data->pan_card;
            }
            
            
            if($request->hasFile('photo')){
            $application->photo = $this->uploadImage($request, 'photo', $this->path, 300, 300);
            }
            else{
            $application->photo = $data->photo;
            }
            if($request->hasFile('signature')){
            $application->signature = $this->uploadImage($request, 'signature', $this->path, 300, 100);
            }
            else{
            $application->signature = $data->signature;
            }
            $application->status = '1';
            $application->created_by = Auth::guard('web')->user()->id;
            $application->save();
            
            $application->registration_no = '000' . $application->id;
            $application->cls_no = 7279 + $application->id;
            $application->save();
            


            // Attach Status
            $application->statuses()->attach($request->statuses);


            // Student Relatives
            if(is_array($request->relations)){
            foreach($request->relations as $key =>$relation){
                if($relation != '' && $relation != null){
                // Insert Data
                $relation = new StudentRelative;
                //Student Relative me bhi college ko add karana h 
                $relation->student_id = $application->id;
               
                $relation->relation = $request->relations[$key];
                $relation->name = $request->relative_names[$key];
                $relation->occupation = $request->occupations[$key];
                // $relation->email = $request->relative_emails[$key];
                $relation->phone = $request->relative_phones[$key];
                $relation->address = $request->addresses[$key];
                $relation->save();
                }
            }}
            
            
            
             if(is_array($request->refrence_ids)){
                foreach($request->refrence_ids as $key =>$refrence){
                    if($refrence != '' && $refrence != null){
                    // Insert Data
                     $reference =new Refrence();
                     $reference->student_id = $application->id;
                     $reference->utr_no=$request->refrence_ids[$key];
                     $reference->ref_amount=$request->ref_amounts[$key];
                     $reference->ref_date=$request->ref_dates[$key];
                     $reference->ref_name=$request->ref_names[$key];
                     $reference->save();
                    }
                }}
                
                if(is_array($request->cash_ids)){
                foreach($request->cash_ids as $key =>$cash){
                    if($cash != '' && $cash != null){
                    // Insert Data
                     $cashReceived = new CashReceived();
                     $cashReceived->student_id = $application->id;
                     $cashReceived->utr_no=$request->cash_ids[$key];
                     $cashReceived->cash_amount=$request->cash_amounts[$key];
                     $cashReceived->cash_date=$request->cash_dates[$key];
                     $cashReceived->cash_name=$request->cash_names[$key];
                     $cashReceived->save();
                    }
                }}
    
               
                if(is_array($request->bank_ids)){
                foreach($request->bank_ids as $key =>$bank){
                    if($bank != '' && $bank != null){
                    // Insert Data
                     $bankReceived = new BankReceived();
                     $bankReceived->student_id = $application->id;
                     $bankReceived->receipt_no=$request->bank_ids[$key];
                     $bankReceived->utr_no=$request->utr_nos[$key];
                     $bankReceived->bank_amount=$request->bank_amounts[$key];
                     $bankReceived->bank_date=$request->bank_dates[$key];
                     $bankReceived->bank_name=$request->bank_names[$key];
                     $bankReceived->save();
                    }
                }}
                
                
                if(is_array($request->deduction_ids)){
                foreach($request->deduction_ids as $key =>$deduction){
                    if($deduction != '' && $deduction != null){
                    // Insert Data
                     $deductionReceived = new Deduction();
                     $deductionReceived->student_id = $application->id;
                     $deductionReceived->utr_no=$request->deduction_ids[$key];
                     $deductionReceived->deduction_amount=$request->deduction_amounts[$key];
                     $deductionReceived->deduction_date=$request->deduction_dates[$key];
                     $deductionReceived->deduction_name=$request->deduction_names[$key];
                     $deductionReceived->save();
                    }
                }}


            // Student Documents
            if(is_array($request->documents)){
            $documents = $request->file('documents');
            foreach($documents as $key =>$attach){

                // Valid extension check
                $valid_extensions = array('JPG','JPEG','jpg','jpeg','png','gif','ico','svg','webp','pdf','doc','docx','txt','zip','rar','csv','xls','xlsx','ppt','pptx','mp3','avi','mp4','mpeg','3gp','mov','ogg','mkv');
                $file_ext = $attach->getClientOriginalExtension();
                if(in_array($file_ext, $valid_extensions, true))
                {

                //Upload Files
                $filename = $attach->getClientOriginalName();
                $extension = $attach->getClientOriginalExtension();
                $fileNameToStore = str_replace([' ','-','&','#','$','%','^',';',':'],'_',$filename).'_'.time().'.'.$extension;

                // Move file inside public/uploads/ directory
                $attach->move('uploads/'.$this->path.'/', $fileNameToStore);

                // Insert Data
                $document = new Document;
                $document->title = $request->titles[$key];
                $document->attach = $fileNameToStore;
                $document->save();

                // Attach
                $document->students()->attach($application->id);

                }
            }}
            

            // Student Enroll
            $enroll = new StudentEnroll();

            $enroll->student_id = $application->id;
            $enroll->program_id = $request->program;
            $enroll->session_id = $request->session;
            $enroll->semester_id = $request->semester;
            $enroll->section_id = 1;
           
            $enroll->created_by = Auth::guard('web')->user()->id;
            $enroll->save();


            // Assign Subjects
            $enrollSubject = EnrollSubject::where('program_id', $request->program)->where('semester_id', $request->semester)->where('section_id', $request->section)->first();
            
            if(isset($enrollSubject)){
                foreach($enrollSubject->subjects as $subject){
                    // Attach Subject
                    $enroll->subjects()->attach($subject->id);
                }
            }


            // Application Status Update
            $data->status = '2';
            $data->updated_by = Auth::guard('web')->user()->id;
            $data->save();

            DB::commit();


          
            $notification = array(
                'message' => __('msg_created_successfully'),
                'alert-type' => __('msg_success')
            );
    
            return redirect()->route($this->route.'.index')->with($notification);
           
        }
        catch(\Exception $e){

            $notification = array(
                'message' => __('msg_created_error'),
                'alert-type' => __('msg_error')
            );
    
            return redirect()->back()->with($notification);
            // toastr('created error','error');

            // return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Application $application)
    {
        //
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;
        $data['access'] = $this->access;

        $data['row'] = $application;

        return view($this->view.'.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Application $application)
    {
        
    
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;
        
        
        if(auth()->user()->is_admin === 1)
        {
            
        $data['provinces'] = Province::where('status', '1')
                            ->orderBy('title', 'asc')->get();
        $data['present_districts'] = District::where('status', '1')
                            ->where('province_id', $application->present_province)
                            ->orderBy('title', 'asc')->get();
        $data['permanent_districts'] = District::where('status', '1')
                            ->where('province_id', $application->permanent_province)
                            ->orderBy('title', 'asc')->get();
        $data['statuses'] = StatusType::where('status', '1')->get();
        $data['batches'] = Batch::where('status', '1')->orderBy('id', 'desc')->get();

        $data['row'] = $application;


        return view($this->view.'.edit', $data);
            
        }elseif(auth()->user()->is_admin === 0)
        {
            
        $data['is_admin']= auth()->user()->is_admin;
        
        $teacherDepartment = auth()->user()->teacher_department; // ya ->faculty_name
        $collegeDepartment = auth()->user()->college_department_id;
        
         $batche = Batch::where('status', '1')->where('department_id', $collegeDepartment);
        //  $batche->with('programs')->whereHas('programs', function ($query) use ($teacherDepartment){
        //             $query->where('program_id', $teacherDepartment);
        //         });
        $data['batches'] = $batche->orderBy('title', 'asc')->get();              
            
        $data['provinces'] = Province::where('status', '1')
                            ->orderBy('title', 'asc')->get();
        $data['present_districts'] = District::where('status', '1')
                            ->where('province_id', $application->present_province)
                            ->orderBy('title', 'asc')->get();
        $data['permanent_districts'] = District::where('status', '1')
                            ->where('province_id', $application->permanent_province)
                            ->orderBy('title', 'asc')->get();
        $data['statuses'] = StatusType::where('status', '1')->get();
        // $data['batches'] = Batch::where('status', '1')->orderBy('id', 'desc')->get();

        $data['row'] = $application;


        return view($this->view.'.edit', $data);
            
        }
        

       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Application $application)
    {
        //
        if($application->status == 0){
        $application->status = '1';
        }else{
        $application->status = '0';
        }
        $application->updated_by = Auth::guard('web')->user()->id;
        $application->save();

        
        $notification = array(
                'message' => __('msg_updated_successfully'),
                'alert-type' => __('msg_success')
            );
    
            return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Application $application)
    {
        DB::beginTransaction();
        // Delete
        $this->deleteMultiMedia($this->path, $application, 'photo');
        $this->deleteMultiMedia($this->path, $application, 'signature');
        $this->deleteMultiMedia($this->path, $application, 'school_transcript');
        $this->deleteMultiMedia($this->path, $application, 'school_certificate');
        $this->deleteMultiMedia($this->path, $application, 'collage_transcript');
        $this->deleteMultiMedia($this->path, $application, 'collage_certificate');
        
        $application->delete();
        DB::commit();

        // Toastr::success(__('msg_deleted_successfully'), __('msg_success'));
        $notification = array(
                'message' => __('msg_deleted_successfully'),
                'alert-type' => __('msg_success')
            );
    
            return redirect()->back()->with($notification);
    }
    
    // public function cardApplication($id){
        
    //     dd($id);
    //     $data['rows'] = Batch::where('status', '1')->orderBy('id', 'desc')->get();
        
    //     return view('admin.id-card.print_application',$data);
        
    // }
}
