<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ApplicationSetting;
use Illuminate\Http\Request;
use App\Traits\FileUploader;
use App\Models\Application;
use App\Models\Language;
use App\Models\Province;
use App\Models\Program;
use App\Models\Web\About;
use App\Models\Web\AboutUs;
use App\Models\Web\Gallery;
use App\Models\Web\Slider;
use App\Models\Web\Page;
use App\Models\Session;
use App\Models\Web\TopbarSetting;
use App\Models\Batch;
use App\Models\CollegeDepartment;
use Carbon\Carbon;

use DB;
use Illuminate\Support\Facades\Schema;

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
        $this->route = 'application';
        $this->view = 'admin.application';
        $this->path = 'student';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // dd('s');
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;
        
        // dd($id);

        $data['id']=0;
        $data['departments'] = CollegeDepartment::where('status', '1')->orderBy('title', 'asc')->get(); 
        $data['programs'] = Program::where('status', '1')->orderBy('title', 'asc')->get();

        $data['provinces'] = Province::where('status', '1')->orderBy('title', 'asc')->get();
        $data['sessions'] = Session::where('status', '1')->get();
        $data['applicationSetting'] = ApplicationSetting::where('slug', 'admission')->where('status', '1')->firstOrFail();


        // dd($data);
        return view($this->view . '.create', $data);
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
            'program' => 'required',
            'college_department' => 'required',
            'session' => 'required',
            'first_name' => 'required',
            'email' => 'required|email|unique:applications,email',
            'phone' => 'required',
            'caste'=>'required',
            'admission_mode'=>'required',
            'gender' => 'required',
            'dob' => 'required|date',
            'photo' => 'nullable|image',
            'signature' => 'nullable|image',
            'nationality'=>'required'
            
        ]);
        
        
        // $notification = array(
        //         'message' => __('msg_created_successfully'),
        //         'alert-type' => __('msg_success')
        //     );
    
        //     return redirect()->route($this->route . '.index')->with($notification);
        
        // $applicationSetting = ApplicationSetting::where('slug', 'admission')->where('status', '1')->firstOrFail();

        // Insert Data
        try {
            DB::beginTransaction();

            $student = new Application();
            $student->program_id = $request->program;
            $student->department_id = $request->college_department;
            $student->apply_date = Carbon::today();

            $student->first_name = $request->first_name;
            $student->last_name = $request->last_name;
            $student->father_name = $request->father_name;
            $student->mother_name = $request->mother_name;
            $student->father_occupation = $request->father_occupation;
            $student->mother_occupation = $request->mother_occupation;

            $student->country = $request->country;
            
            $student->present_province = $request->present_province;
            $student->present_district = $request->present_district;
            $student->present_village = $request->present_village;
            $student->present_address = $request->present_address;
             $student->present_pin = $request->present_pin;
            $student->present_post = $request->present_post;
            $student->present_police_station = $request->present_police_station;
            
            $student->permanent_province = $request->permanent_province;
            $student->permanent_district = $request->permanent_district;
            $student->permanent_village = $request->permanent_village;
            $student->permanent_address = $request->permanent_address;
             $student->permanent_pin = $request->permanent_pin;
            $student->permanent_post = $request->permanent_post;
            $student->permanent_police_station = $request->permanent_police_station;

            $student->gender = $request->gender;
            
            $student->pan_id = $request->pan_id;
            $student->admission_mode=$request->admission_mode;

            if (Schema::hasColumn('applications', 'ref_persion')) {
                $student->ref_persion = $request->ref_persion;
            }
            if (Schema::hasColumn('applications', 'refrence_person_contact')) {
                $student->refrence_person_contact = $request->refrence_person_contact;
            }
            

            $student->dob = $request->dob;
            $student->email = $request->email;
            $student->phone = $request->phone;
            $student->parent_phone = $request->parent_phone;
            $student->session = $request->session;
            $student->emergency_phone = $request->emergency_phone;

            $student->religion = $request->religion;
            $student->caste = $request->caste;
            $student->mother_tongue = $request->mother_tongue;
            $student->marital_status = $request->marital_status;
            $student->blood_group = $request->blood_group;
            $student->nationality = $request->nationality;
            $student->national_id = $request->national_id;
            $student->passport_no = $request->passport_no;
            $student->nationality = $request->nationality;

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
            
            $student->photo = $this->uploadImage($request, 'photo', $this->path, 300, 300);
            $student->signature = $this->uploadImage($request, 'signature', $this->path, 300, 100);
            $student->status = '1';
            
            

            $student->save();

            $student->registration_no = '00' . $student->id;
            $student->save();

            DB::commit();
            


          $notification = array(
                'message' => __('msg_form_successfully'),
                'alert-type' => __('msg_success')
            );
    
          return redirect()->route('application.print',$request->email)->with($notification);
            // return redirect()->route('application.print',$request->email)->with($notification);

            // return redirect()->route($this->route . '.index')->with('success', __('msg_sent_successfully'));
        } catch (\Exception $e) {

          $notification = array(
                'message' => __('msg_form_error'),
                'alert-type' => __('msg_error')
            );
    
            return redirect()->back()->with($notification);
        }
        
    //       $notification = array(
    //             'message' => __('msg_form_successfully'),
    //             'alert-type' => __('msg_success'),
    //             'abc'=>$request->first_name,
                
                
    //         );
    //         // return redirect()->route('application.index')->with($notification);
    
    // return redirect()->route('application.print',$request->email)->with($notification);
    
    }



   public function printApplication($email)
   {
        
        $data['title'] = "Application Form";
    
        $data['path'] = "student";
        // $data['access'] = "application";
        
        $data['applicationSetting'] = ApplicationSetting::where('slug', 'admission')->where('status', '1')->firstOrFail();
        
         $data['application']= Application::where('email', $email)->first();

        // $data['row'] = $application;

        return view('admin.application.web_show_application', $data);
   }
   
   
    public function cardApplication($id){
        
        // dd($email);
        $data['rows'] = Batch::where('status', '1')->orderBy('id', 'desc')->get();
        $data['title']="Application Form";
         $data['applicationSetting'] = ApplicationSetting::where('slug', 'admission')->where('status', '1')->firstOrFail();
        
       $data['application']= Application::where('id', $id)->first();
      // dd($application);
        
        return view('admin.id-card.new_print_application',$data);
     }
     
      public function downloadApplication($id){
        
        // dd($email);
        $data['rows'] = Batch::where('status', '1')->orderBy('id', 'desc')->get();
        $data['title']="Application Form";
        
        $data['applicationSetting'] = ApplicationSetting::where('slug', 'admission')->where('status', '1')->firstOrFail();
        
        $data['application']= Application::where('id', $id)->first();
        // dd($application);
        
        return view('admin.id-card.download_application',$data);
     }



    public function aboutApplication()
    {
        // About Us
        $data['about'] = About::where('language_id', Language::version()->id)
            ->where('status', '1')
            ->first();
        // Sliders
        $data['sliders'] = Slider::where('language_id', Language::version()->id)
             ->where('section','application')
            ->where('status', '1')
            ->orderBy('id', 'asc')
            ->get();
            $data['galleries'] = Gallery::where('language_id', Language::version()->id)
            ->where('section', 'course')
            ->where('status', '1')
            ->orderBy('id', 'desc')
            ->limit(3)
            ->get();    

        return view('web.about-us', $data);
    }
    
    public function Download()
    {
        // About Us
        $data['download'] = Page::where('language_id', Language::version()->id)
             ->where('section','download')
             ->where('status', '1')
             ->first();
            
            // dd($data);
        // Sliders
        $data['sliders'] = Slider::where('language_id', Language::version()->id)
             ->where('section','download')
              ->where('status', '1')
             ->orderBy('id', 'asc')
             ->get();
            
            // dd($data);
            $data['galleries'] = Gallery::where('language_id', Language::version()->id)
            ->where('section', 'course')
            ->where('status', '1')
            ->orderBy('id', 'desc')
            ->limit(3)
            ->get();    

        return view('web.download', $data);
    }

    public function contactApplication(){

         //topBar Setting 
         $data['topBarSetting'] = TopbarSetting::where('status', '1')
         ->first();
         
         // Sliders
        $data['sliders'] = Slider::where('language_id', Language::version()->id)
        ->where('section','contact')
        ->where('status', '1')
        ->orderBy('id', 'asc')
        ->get();



        return view('web.contact-us',$data);
    }
    
    public function campusApplication()
    {
         // Sliders
         $data['sliders'] = Slider::where('language_id', Language::version()->id)
         ->where('status', '1')
         ->orderBy('id', 'asc')
         ->limit(1)
         ->get();
          // Galleries
        $data['galleries'] = Gallery::where('language_id', Language::version()->id)
        ->where('section', 'course')
        ->where('status', '1')
        ->orderBy('id', 'desc')
        ->limit(3)
        ->get();
         
        return view('web.campus_facilities',$data);
    }

    public function admissionApplication(){
        $data['sliders'] = Slider::where('language_id', Language::version()->id)
         ->where('status', '1')
         ->orderBy('id', 'asc')
         ->limit(1)
         ->get();
           // Galleries
        $data['galleries'] = Gallery::where('language_id', Language::version()->id)
        ->where('section', 'course')
        ->where('status', '1')
        ->orderBy('id', 'desc')
        ->limit(3)
        ->get();
         return view('web.admission',$data);
    }

    public function placementApplication(){
        $data['sliders'] = Slider::where('language_id', Language::version()->id)
         ->where('status', '1')
         ->orderBy('id', 'asc')
         ->limit(1)
         ->get();
           // Galleries
        $data['galleries'] = Gallery::where('language_id', Language::version()->id)
        ->where('section', 'course')
        ->where('status', '1')
        ->orderBy('id', 'desc')
        ->limit(3)
        ->get();
         return view('web.placement',$data);
    }
    public function academicApplication(){
        $data['sliders'] = Slider::where('language_id', Language::version()->id)
         ->where('status', '1')
         ->orderBy('id', 'asc')
         ->limit(1)
         ->get();
           // Galleries
        $data['galleries'] = Gallery::where('language_id', Language::version()->id)
        ->where('section', 'course')
        ->where('status', '1')
        ->orderBy('id', 'desc')
        ->limit(3)
        ->get();
         return view('web.academic',$data);
    }
    public function labApplication(){
        $data['sliders'] = Slider::where('language_id', Language::version()->id)
         ->where('status', '1')
         ->orderBy('id', 'asc')
         ->limit(1)
         ->get();
           // Galleries
        $data['galleries'] = Gallery::where('language_id', Language::version()->id)
        ->where('section', 'course')
        ->where('status', '1')
        ->orderBy('id', 'desc')
        ->limit(3)
        ->get();
         return view('web.lab',$data);
    }



     public function reset()
     {
        
        // dd('s');
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // Truncate table
        DB::table('students')->truncate();
        // Enable foreign key checks back
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        return redirect()->back();
    }


 
    




}
