<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Program;
use App\Models\Batch;
use App\Models\CollegeDepartment;
use Toastr;
use App\Traits\FileUploader;

class BatchController extends Controller
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
        $this->title = trans_choice('module_batch', 1);
        $this->route = 'admin.batch';
        $this->view = 'admin.batch';
        $this->path = 'batch';
        $this->access = 'batch';


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
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;
        $data['access'] = $this->access;
        
        $data['programs'] = Program::where('status', '1')
                            ->orderBy('title', 'asc')->get();

        $data['departments'] = CollegeDepartment::where('status', '1')->orderBy('title', 'asc')->get();  

        $data['rows'] = Batch::orderBy('id', 'desc')->get();

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
            'title' => 'required|max:191|unique:batches,title',
            
            'clc_college'=>'required',
            'cc_college'=>'required',
            'start_date' => 'required|date',
            'programs' => 'required',
            'college_department'=>'required',
            
        ]);

        // Insert Data
        $batch = new Batch;
        $batch->title = $request->title;
        $batch->department_id = $request->college_department;
        $batch->clc_college=$request->clc_college;
        $batch->clc_college_add=$request->clc_college_add;
        $batch->clc_college_run=$request->clc_college_run;
        $batch->clc_college_reco=$request->clc_college_reco;
        $batch->clc_college_app=$request->clc_college_app;
        $batch->clc_college_var=$request->clc_college_veri;
        $batch->clc_college_img=$this->uploadImage($request, 'attach', $this->path,1024, 1536,);
        $batch->clc_logo_img=$this->uploadImage($request, 'clc_image', $this->path,213, 213,);

        // Separate Course Completion Certificate header/settings
        $batch->cc_college = $request->cc_college;
        $batch->cc_college_add = $request->cc_college_add;
        $batch->cc_college_run = $request->cc_college_run;
        $batch->cc_college_reco = $request->cc_college_reco;
        $batch->cc_college_app = $request->cc_college_app;
        $batch->cc_college_var = $request->cc_college_veri;
        $batch->cc_watermark_text = $request->cc_watermark_text;
        $batch->cc_logo_img = $this->uploadImage($request, 'cc_image', $this->path,213, 213,);
        $batch->cc_college_email = $request->cc_college_email;
        $batch->cc_college_phone = $request->cc_college_phone;
        
        $batch->college_email = $request->college_email;
        $batch->college_phone = $request->college_phone;
        
        $batch->start_date = $request->start_date;

        $batch->save();

        $batch->programs()->attach($request->programs);


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
    public function show(Batch $batch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Batch $batch)
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
    public function update(Request $request, Batch $batch)
    {
        // Field Validation
        $request->validate([
            'title' => 'required|max:191|unique:batches,title,'.$batch->id,
            'clc_college'=>'required',
            'cc_college'=>'required',
            
            'start_date' => 'required|date',
            'programs' => 'required',
            'college_department'=>'required',
            
        ]);
        
        // Update Data
        $batch->title = $request->title;
        $batch->department_id = $request->college_department;
        $batch->clc_college=$request->clc_college;
        
        $batch->clc_college_add=$request->clc_college_add;
        $batch->clc_college_run=$request->clc_college_run;
        $batch->clc_college_reco=$request->clc_college_reco;
        $batch->clc_college_app=$request->clc_college_app;
        $batch->clc_college_var=$request->clc_college_veri;
        $batch->clc_college_img=$this->updateImage($request, 'attach', $this->path, 1024, 1536, $batch, 'clc_college_img');
         $batch->clc_logo_img=$this->updateImage($request, 'clc_image', $this->path, 213, 213, $batch, 'clc_logo_img');

        // Separate Course Completion Certificate header/settings
        $batch->cc_college = $request->cc_college;
        $batch->cc_college_add = $request->cc_college_add;
        $batch->cc_college_run = $request->cc_college_run;
        $batch->cc_college_reco = $request->cc_college_reco;
        $batch->cc_college_app = $request->cc_college_app;
        $batch->cc_college_var = $request->cc_college_veri;
        $batch->cc_watermark_text = $request->cc_watermark_text;
        $batch->cc_logo_img = $this->updateImage($request, 'cc_image', $this->path, 213, 213, $batch, 'cc_logo_img');
        $batch->cc_college_email = $request->cc_college_email;
        $batch->cc_college_phone = $request->cc_college_phone;
        
        $batch->college_email = $request->college_email;
        $batch->college_phone = $request->college_phone;
       
        $batch->start_date = $request->start_date;

        $batch->status = $request->status;
        $batch->save();

        $batch->programs()->sync($request->programs);


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
    public function destroy(Batch $batch)
    {
        // Delete Data
        $batch->programs()->detach();
        $batch->delete();
        
       $notification = array(
                'message' => __('msg_deleted_successfully'),
                'alert-type' => __('msg_success')
            );
    
      return redirect()->back()->with($notification);
      
    }
}
