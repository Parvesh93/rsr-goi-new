<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CollegeDepartment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Faculty;
use App\Models\Program;
use Toastr;


class FacultyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Module Data
        $this->title = trans_choice('module_faculty', 1);
        $this->route = 'admin.faculty';
        $this->view = 'admin.faculty';
        $this->path = 'faculty';
        $this->access = 'faculty';


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
    public function index()
    {
        //

        // dd('success');
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;
        $data['access'] = $this->access;
        
        $data['programs'] = Program::where('status', '1')->orderBy('title', 'asc')->get();
        $data['departments'] = CollegeDepartment::where('status', '1')->orderBy('title', 'asc')->get();
        
        $data['rows'] = Faculty::orderBy('title', 'asc')->get();

        return view($this->view.'.index', $data);
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
        // Field Validation
        $request->validate([
            'title' => 'required|max:191|unique:faculties,title',
            'department'=>'required',
            'college_department'=>'required',
            
        ]);

        // Insert Data
        $faculty = new Faculty;
        $faculty->title = $request->title;
        $faculty->department_id = $request->college_department;
        $faculty->slug = Str::slug($request->title, '-');
        
        $faculty->shortcode = $request->shortcode;
        $faculty->teacher_department = $request->department;
        $faculty->save();


        
       $notification = array(
                'message' => __('msg_created_successfully'),
                'alert-type' => __('msg_success')
            );
    
      return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Faculty $faculty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Faculty $faculty)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Faculty $faculty)
    {
        // Field Validation
        $request->validate([
            'title' => 'required|max:191|unique:faculties,title,'.$faculty->id,
            'department'=>'required',
            'college_department'=>'required',
           
        ]);

        // Update Data
        $faculty->title = $request->title;
        $faculty->department_id = $request->college_department;
        $faculty->slug = Str::slug($request->title, '-');

        $faculty->shortcode = $request->shortcode;
        $faculty->teacher_department = $request->department;
       
        $faculty->status = $request->status;
        $faculty->save();


        // Toastr::success(__('msg_updated_successfully'), __('msg_success'));
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
    public function destroy(Faculty $faculty)
    {
        // Delete Data
        $faculty->delete();

        // Toastr::success(__('msg_deleted_successfully'), __('msg_success'));
       $notification = array(
                'message' => __('msg_deleted_successfully'),
                'alert-type' => __('msg_success')
            );
    
            return redirect()->back()->with($notification);
    }
}
