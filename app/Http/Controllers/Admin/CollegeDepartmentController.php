<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CollegeDepartment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CollegeDepartmentController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Module Data
        $this->title = trans_choice('module_college_department', 1);
        $this->route = 'admin.college-department';
        $this->view = 'admin.college-department';
        $this->path = 'college-department';
        $this->access = 'college-department';


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
        
        // $data['programs'] = Program::where('status', '1')->orderBy('title', 'asc')->get();
        
        $data['rows'] = CollegeDepartment::orderBy('title', 'asc')->get();

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
            
            
        ]);

        // Insert Data
        $collegeDepartment = new CollegeDepartment;
        $collegeDepartment->title = $request->title;
        $collegeDepartment->slug = Str::slug($request->title, '-');
        
        $collegeDepartment->shortcode = $request->shortcode;
        
        $collegeDepartment->save();


        
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
    public function show(CollegeDepartment $collegeDepartment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CollegeDepartment $collegeDepartment)
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
    public function update(Request $request, CollegeDepartment $collegeDepartment)
    {
        // Field Validation
        $request->validate([
            'title' => 'required|max:191|unique:faculties,title,'.$collegeDepartment->id,
            
           
        ]);

        // Update Data
        $collegeDepartment->title = $request->title;
        $collegeDepartment->slug = Str::slug($request->title, '-');

        $collegeDepartment->shortcode = $request->shortcode;
        
       
        $collegeDepartment->status = $request->status;
        $collegeDepartment->save();


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
    public function destroy(CollegeDepartment $collegeDepartment)
    {
        // Delete Data
        $collegeDepartment->delete();

        // Toastr::success(__('msg_deleted_successfully'), __('msg_success'));
        $notification = array(
                'message' => __('msg_deleted_successfully'),
                'alert-type' => __('msg_success')
            );
    
        return redirect()->back()->with($notification);
    }
}
