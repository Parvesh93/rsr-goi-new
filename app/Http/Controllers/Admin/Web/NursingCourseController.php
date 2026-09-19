<?php

namespace App\Http\Controllers\Admin\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\FileUploader;
use Illuminate\Support\Str;
use App\Models\Web\Course;
use App\Models\Language;
use App\Models\Web\NursingCourse;

class NursingCourseController extends Controller
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
        $this->title   = trans_choice('module_nursing_course', 1);
        $this->route   = 'admin.nursing-course';
        $this->view    = 'admin.web.nursing-course';
        $this->path    = 'nursing-course';
        $this->access  = 'nursing-course';


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

        $data['rows'] = NursingCourse::where('language_id', Language::version()->id)
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
        $nursing_course = new NursingCourse;
        $nursing_course->language_id = Language::version()->id;
        $nursing_course->title = $request->title;
        $nursing_course->slug = Str::slug($request->title, '-');
       
        $nursing_course->faculty = $request->faculty;
        $nursing_course->semesters = $request->semesters;
        $nursing_course->credits = $request->credits;
        $nursing_course->courses = $request->courses;
        $nursing_course->duration = $request->duration;
        $nursing_course->fee = $request->fee;
        $nursing_course->description = $request->description;
        $nursing_course->attach = $this->uploadImage($request, 'attach', $this->path, 800, 600);
        $nursing_course->save();


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
    public function show(NursingCourse $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NursingCourse $nursing_course)
    {
        //
        $data['title']  = $this->title;
        $data['route']  = $this->route;
        $data['view']   = $this->view;
        $data['access'] = $this->access;

        $data['row'] =  $nursing_course;

        return view($this->view.'.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, NursingCourse $nursing_course)
    {
        //Field Validation
        $request->validate([
            'title' => 'required|unique:courses,title,'.$nursing_course->id,
            'fee' => 'nullable|numeric',
            'attach' => 'nullable|image',
            
        ]);

        //Data Update
        $nursing_course->title = $request->title;
        $nursing_course->slug = Str::slug($request->title, '-');
        
        $nursing_course->faculty = $request->faculty;
        $nursing_course->semesters = $request->semesters;
        $nursing_course->credits = $request->credits;
        $nursing_course->courses = $request->courses;
        $nursing_course->duration = $request->duration;
        $nursing_course->fee = $request->fee;
        $nursing_course->description = $request->description;
        $nursing_course->attach = $this->updateImage($request, 'attach', $this->path, 800, 600, $nursing_course, 'attach');
        $nursing_course->status = $request->status;
        $nursing_course->update();


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
    public function destroy(NursingCourse $nursing_course)
    {
        //Delete Attach
        $this->deleteMedia($this->path, $nursing_course);

        //Delete Data
        $nursing_course->delete();

        // Toastr::success(__('msg_deleted_successfully'), __('msg_success'));
        $notification = array(
            'message' => __('msg_deleted_successfully'),
            'alert-type' => __('msg_success')
        );

        return redirect()->back()->with($notification);
    }
}
