<?php

namespace App\Http\Controllers\Admin\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\FileUploader;
use Illuminate\Support\Str;
use App\Models\Web\Course;
use App\Models\Language;
use App\Models\Web\PharmacyCourse;

class PharmacyCourseController extends Controller
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
        $this->title   = trans_choice('module_pharmacy_course', 1);
        $this->route   = 'admin.pharmacy-course';
        $this->view    = 'admin.web.pharmacy-course';
        $this->path    = 'pharmacy-course';
        $this->access  = 'pharmacy-course';


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

        $data['rows'] = PharmacyCourse::where('language_id', Language::version()->id)
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
        $pharmacy_course = new PharmacyCourse;
        $pharmacy_course->language_id = Language::version()->id;
        $pharmacy_course->title = $request->title;
        $pharmacy_course->slug = Str::slug($request->title, '-');
        
        $pharmacy_course->faculty = $request->faculty;
        $pharmacy_course->semesters = $request->semesters;
        $pharmacy_course->credits = $request->credits;
        $pharmacy_course->courses = $request->courses;
        $pharmacy_course->duration = $request->duration;
        $pharmacy_course->fee = $request->fee;
        $pharmacy_course->description = $request->description;
        $pharmacy_course->attach = $this->uploadImage($request, 'attach', $this->path, 800, 600);
        $pharmacy_course->save();


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
    public function show(PharmacyCourse $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PharmacyCourse $pharmacy_course)
    {
        //
        $data['title']  = $this->title;
        $data['route']  = $this->route;
        $data['view']   = $this->view;
        $data['access'] = $this->access;

        $data['row'] =  $pharmacy_course;

        return view($this->view.'.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PharmacyCourse $pharmacy_course)
    {
        //Field Validation
        $request->validate([
            'title' => 'required|unique:courses,title,'.$pharmacy_course->id,
            'fee' => 'nullable|numeric',
            'attach' => 'nullable|image',
            
        ]);

        //Data Update
        $pharmacy_course->title = $request->title;
        $pharmacy_course->slug = Str::slug($request->title, '-');
 
        $pharmacy_course->faculty = $request->faculty;
        $pharmacy_course->semesters = $request->semesters;
        $pharmacy_course->credits = $request->credits;
        $pharmacy_course->courses = $request->courses;
        $pharmacy_course->duration = $request->duration;
        $pharmacy_course->fee = $request->fee;
        $pharmacy_course->description = $request->description;
        $pharmacy_course->attach = $this->updateImage($request, 'attach', $this->path, 800, 600, $pharmacy_course, 'attach');
        $pharmacy_course->status = $request->status;
        $pharmacy_course->update();


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
    public function destroy(PharmacyCourse $pharmacy_course)
    {
        //Delete Attach
        $this->deleteMedia($this->path, $pharmacy_course);

        //Delete Data
        $pharmacy_course->delete();

        // Toastr::success(__('msg_deleted_successfully'), __('msg_success'));
        $notification = array(
            'message' => __('msg_deleted_successfully'),
            'alert-type' => __('msg_success')
        );

        return redirect()->back()->with($notification);
    }
}
