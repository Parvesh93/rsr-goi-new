<?php

namespace App\Http\Controllers\Admin\Web;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Web\RsrCourse;
use App\Traits\FileUploader;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class EngineeringCourseController extends Controller
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
        $this->title   = trans_choice('module_rsr_course', 1);
        $this->route   = 'admin.rsr-course';
        $this->view    = 'admin.web.rsr-course';
        $this->path    = 'rsr-course';
        $this->access  = 'rsr-course';


        $this->middleware('permission:'.$this->access.'-view|'.$this->access.'-create|'.$this->access.'-edit|'.$this->access.'-delete', ['only' => ['index','show']]);
        $this->middleware('permission:'.$this->access.'-create', ['only' => ['create','store']]);
        $this->middleware('permission:'.$this->access.'-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:'.$this->access.'-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data['title']  = $this->title;
        $data['route']  = $this->route;
        $data['view']   = $this->view;
        $data['path']   = $this->path;
        $data['access'] = $this->access;

        $data['rows'] = RsrCourse::where('language_id', Language::version()->id)
                        ->orderby('id', 'asc')
                        ->get();

        return view($this->view.'.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $data['title']  = $this->title;
        $data['route']  = $this->route;
        $data['view']   = $this->view;
        $data['access'] = $this->access;


        return view($this->view.'.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Field Validation
        $request->validate([
            'title' => 'required|unique:courses,title',
            'fee' => 'nullable|numeric',
            'attach' => 'required|image',
            
        ]);

        //Data Insert
        $rsr_course = new RsrCourse;
        $rsr_course->language_id = Language::version()->id;
        $rsr_course->title = $request->title;
        $rsr_course->slug = Str::slug($request->title, '-');
       
        $rsr_course->faculty = $request->faculty;
        $rsr_course->semesters = $request->semesters;
        $rsr_course->credits = $request->credits;
        $rsr_course->courses = $request->courses;
        $rsr_course->duration = $request->duration;
        $rsr_course->fee = $request->fee;
        $rsr_course->description = $request->description;
        $rsr_course->attach = $this->uploadImage($request, 'attach', $this->path, 800, 600);
        $rsr_course->save();


        // Toastr::success(__('msg_created_successfully'), __('msg_success'));

        $notification = array(
            'message' => __('msg_created_successfully'),
            'alert-type' => __('msg_success')
        );

        return redirect()->route($this->route.'.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(RsrCourse $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RsrCourse $rsr_course)
    {
        
        //
        $data['title']  = $this->title;
        $data['route']  = $this->route;
        $data['view']   = $this->view;
        $data['access'] = $this->access;
       
        $data['row'] =  $rsr_course;
       
        return view($this->view.'.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RsrCourse $rsr_course)
    {
        //Field Validation
        $request->validate([
            'title' => 'required|unique:courses,title,'.$rsr_course->id,
            'fee' => 'nullable|numeric',
            'attach' => 'nullable|image',
            
        ]);

        //Data Update
        $rsr_course->title = $request->title;
        $rsr_course->slug = Str::slug($request->title, '-');
       
        $rsr_course->faculty = $request->faculty;
        $rsr_course->semesters = $request->semesters;
        $rsr_course->credits = $request->credits;
        $rsr_course->courses = $request->courses;
        $rsr_course->duration = $request->duration;
        $rsr_course->fee = $request->fee;
        $rsr_course->description = $request->description;
        $rsr_course->attach = $this->updateImage($request, 'attach', $this->path, 800, 600, $rsr_course, 'attach');
        $rsr_course->status = $request->status;
        $rsr_course->update();


        // Toastr::success(__('msg_updated_successfully'), __('msg_success'));

        $notification = array(
            'message' => __('msg_updated_successfully'),
            'alert-type' => __('msg_success')
        );

        return redirect()->route($this->route.'.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RsrCourse $rsr_course)
    {
        //Delete Attach
        $this->deleteMedia($this->path, $rsr_course);

        //Delete Data
        $rsr_course->delete();

        // Toastr::success(__('msg_deleted_successfully'), __('msg_success'));
        $notification = array(
            'message' => __('msg_deleted_successfully'),
            'alert-type' => __('msg_success')
        );

        return redirect()->back()->with($notification);
    }
}
