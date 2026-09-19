<?php

namespace App\Http\Controllers\Admin\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\FileUploader;
use Illuminate\Support\Str;
use App\Models\Web\Course;
use App\Models\Language;
use App\Models\Web\KanchanCourse;

class KanchanCourseController extends Controller
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
        $this->title   = trans_choice('module_kanchan_course', 1);
        $this->route   = 'admin.kanchan-course';
        $this->view    = 'admin.web.kanchan-course';
        $this->path    = 'kanchan-course';
        $this->access  = 'kanchan-course';


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

        $data['rows'] = KanchanCourse::where('language_id', Language::version()->id)
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
        $kanchan_course = new KanchanCourse;
        $kanchan_course->language_id = Language::version()->id;
        $kanchan_course->title = $request->title;
        $kanchan_course->slug = Str::slug($request->title, '-');
       
        $kanchan_course->faculty = $request->faculty;
        $kanchan_course->semesters = $request->semesters;
        $kanchan_course->credits = $request->credits;
        $kanchan_course->courses = $request->courses;
        $kanchan_course->duration = $request->duration;
        $kanchan_course->fee = $request->fee;
        $kanchan_course->description = $request->description;
        $kanchan_course->attach = $this->uploadImage($request, 'attach', $this->path, 800, 550);
        $kanchan_course->save();


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
    public function show(Course $kanchan_course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KanchanCourse $kanchan_course)
    {
        //
        $data['title']  = $this->title;
        $data['route']  = $this->route;
        $data['view']   = $this->view;
        $data['access'] = $this->access;

        $data['row'] =  $kanchan_course;

        return view($this->view.'.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KanchanCourse $kanchan_course)
    {
        //Field Validation
        $request->validate([
            'title' => 'required|unique:courses,title,'.$kanchan_course->id,
            'fee' => 'nullable|numeric',
            'attach' => 'nullable|image',
            
        ]);

        //Data Update
        $kanchan_course->title = $request->title;
        $kanchan_course->slug = Str::slug($request->title, '-');
       
        $kanchan_course->faculty = $request->faculty;
        $kanchan_course->semesters = $request->semesters;
        $kanchan_course->credits = $request->credits;
        $kanchan_course->courses = $request->courses;
        $kanchan_course->duration = $request->duration;
        $kanchan_course->fee = $request->fee;
        $kanchan_course->description = $request->description;
        $kanchan_course->attach = $this->updateImage($request, 'attach', $this->path, 800, 550, $kanchan_course, 'attach');
        $kanchan_course->status = $request->status;
        $kanchan_course->update();


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
    public function destroy(KanchanCourse $kanchan_course)
    {
        //Delete Attach
        $this->deleteMedia($this->path, $kanchan_course);

        //Delete Data
        $kanchan_course->delete();

        // Toastr::success(__('msg_deleted_successfully'), __('msg_success'));
        $notification = array(
            'message' => __('msg_deleted_successfully'),
            'alert-type' => __('msg_success')
        );

        return redirect()->back()->with($notification);
    }
}
