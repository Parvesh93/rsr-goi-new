<?php

namespace App\Http\Controllers\Admin\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\FileUploader;
use Illuminate\Support\Str;
use App\Models\Web\Course;
use App\Models\Language;
use App\Models\Web\RbsCourse;

class RbsCourseController extends Controller
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
        $this->title   = trans_choice('module_rbs_course', 1);
        $this->route   = 'admin.rbs-course';
        $this->view    = 'admin.web.rbs-course';
        $this->path    = 'rbs-course';
        $this->access  = 'rbs-course';


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

        $data['rows'] = RbsCourse::where('language_id', Language::version()->id)
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
        $rbs_course = new RbsCourse;
        $rbs_course->language_id = Language::version()->id;
        $rbs_course->title = $request->title;
        $rbs_course->slug = Str::slug($request->title, '-');
        
        $rbs_course->faculty = $request->faculty;
        $rbs_course->semesters = $request->semesters;
        $rbs_course->credits = $request->credits;
        $rbs_course->courses = $request->courses;
        $rbs_course->duration = $request->duration;
        $rbs_course->fee = $request->fee;
        $rbs_course->description = $request->description;
        $rbs_course->attach = $this->uploadImage($request, 'attach', $this->path, 800, 600);
        $rbs_course->save();


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
    public function show(RbsCourse $rbs_course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RbsCourse $rbs_course)
    {
        //
        $data['title']  = $this->title;
        $data['route']  = $this->route;
        $data['view']   = $this->view;
        $data['access'] = $this->access;

        $data['row'] =  $rbs_course;

        return view($this->view.'.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RbsCourse $rbs_course)
    {
        //Field Validation
        $request->validate([
            'title' => 'required|unique:courses,title,'.$rbs_course->id,
            'fee' => 'nullable|numeric',
            'attach' => 'nullable|image',
            
        ]);

        //Data Update
        $rbs_course->title = $request->title;
        $rbs_course->slug = Str::slug($request->title, '-');
      
        $rbs_course->faculty = $request->faculty;
        $rbs_course->semesters = $request->semesters;
        $rbs_course->credits = $request->credits;
        $rbs_course->courses = $request->courses;
        $rbs_course->duration = $request->duration;
        $rbs_course->fee = $request->fee;
        $rbs_course->description = $request->description;
        $rbs_course->attach = $this->updateImage($request, 'attach', $this->path, 800, 600, $rbs_course, 'attach');
        $rbs_course->status = $request->status;
        $rbs_course->update();


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
    public function destroy(RbsCourse $rbs_course)
    {
        //Delete Attach
        $this->deleteMedia($this->path, $rbs_course);

        //Delete Data
        $rbs_course->delete();

        // Toastr::success(__('msg_deleted_successfully'), __('msg_success'));
        $notification = array(
            'message' => __('msg_deleted_successfully'),
            'alert-type' => __('msg_success')
        );

        return redirect()->back()->with($notification);
    }
}
