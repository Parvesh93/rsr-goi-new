<?php

namespace App\Http\Controllers\Admin\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\FileUploader;
use Illuminate\Support\Str;
use App\Models\Web\Course;
use App\Models\Language;
use App\Models\Web\BedCourse;

class BedCourseController extends Controller
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
        $this->title   = trans_choice('module_bed_course', 1);
        $this->route   = 'admin.bed-course';
        $this->view    = 'admin.web.bed-course';
        $this->path    = 'bed-course';
        $this->access  = 'bed-course';


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

        $data['rows'] = BedCourse::where('language_id', Language::version()->id)
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
        $bed_course = new BedCourse;
        $bed_course->language_id = Language::version()->id;
        $bed_course->title = $request->title;
        $bed_course->slug = Str::slug($request->title, '-');
       
        $bed_course->faculty = $request->faculty;
        $bed_course->semesters = $request->semesters;
        $bed_course->credits = $request->credits;
        $bed_course->courses = $request->courses;
        $bed_course->duration = $request->duration;
        $bed_course->fee = $request->fee;
        $bed_course->description = $request->description;
        $bed_course->attach = $this->uploadImage($request, 'attach', $this->path, 800, 600);
        $bed_course->save();


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
    public function show(BedCourse $bed_course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BedCourse $bed_course)
    {
        //
        $data['title']  = $this->title;
        $data['route']  = $this->route;
        $data['view']   = $this->view;
        $data['access'] = $this->access;

        $data['row'] =  $bed_course;

        return view($this->view.'.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BedCourse $bed_course)
    {
        //Field Validation
        $request->validate([
            'title' => 'required|unique:courses,title,'.$bed_course->id,
            'fee' => 'nullable|numeric',
            'attach' => 'nullable|image',
           
        ]);

        //Data Update
        $bed_course->title = $request->title;
        $bed_course->slug = Str::slug($request->title, '-');
      
        $bed_course->faculty = $request->faculty;
        $bed_course->semesters = $request->semesters;
        $bed_course->credits = $request->credits;
        $bed_course->courses = $request->courses;
        $bed_course->duration = $request->duration;
        $bed_course->fee = $request->fee;
        $bed_course->description = $request->description;
        $bed_course->attach = $this->updateImage($request, 'attach', $this->path, 800, 600, $bed_course, 'attach');
        $bed_course->status = $request->status;
        $bed_course->update();


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
    public function destroy(BedCourse $bed_course)
    {
        //Delete Attach
        $this->deleteMedia($this->path, $bed_course);

        //Delete Data
        $bed_course->delete();

        // Toastr::success(__('msg_deleted_successfully'), __('msg_success'));
        $notification = array(
            'message' => __('msg_updated_successfully'),
            'alert-type' => __('msg_success')
        );

        return redirect()->back()->with($notification);
    }
}
