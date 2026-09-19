<?php

namespace App\Http\Controllers\Admin\Web;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Web\Admission;
use App\Traits\FileUploader;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdmissionController extends Controller
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
        $this->title   = trans_choice('module_admission', 1);
        $this->route   = 'admin.admission';
        $this->view    = 'admin.web.admission';
        $this->path    = 'admission';
        $this->access  = 'admission';


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
        
        $data['title']  = $this->title;
        $data['route']  = $this->route;
        $data['view']   = $this->view;
        $data['path']   = $this->path;
        $data['access'] = $this->access;

        $data['rows'] = Admission::where('language_id', Language::version()->id)
                        ->orderby('id', 'asc')
                        ->get();

        return view($this->view.'.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
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
        $admission = new Admission();
        $admission->language_id = Language::version()->id;
        $admission->title = $request->title;
        $admission->slug = Str::slug($request->title, '-');
       
        $admission->duration = $request->duration;
       
        $admission->fee = $request->fee;
        $admission->description = $request->description;
        $admission->attach = $this->uploadImage($request, 'attach', $this->path, 800, 600);
        $admission->save();


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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admission $admission)
    {
        $data['title']  = $this->title;
        $data['route']  = $this->route;
        $data['view']   = $this->view;
        $data['access'] = $this->access;

        $data['row'] =  $admission;

        return view($this->view.'.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Admission $admission)
    {
          //Field Validation
          $request->validate([
            'title' => 'required|unique:courses,title,'.$admission->id,
            'fee' => 'nullable|numeric',
            'attach' => 'nullable|image',
      
        ]);

        //Data Update
        $admission->title = $request->title;
        $admission->slug = Str::slug($request->title, '-');
       
        $admission->duration = $request->duration;
        
        $admission->fee = $request->fee;
        $admission->description = $request->description;
        $admission->attach = $this->updateImage($request, 'attach', $this->path, 800, 600, $admission, 'attach');
        $admission->status = $request->status;
        $admission->update();


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
    public function destroy(Admission $admission)
    {
        
          //Delete Attach
          $this->deleteMedia($this->path, $admission);

          //Delete Data
          $admission->delete();
  
          // Toastr::success(__('msg_deleted_successfully'), __('msg_success'));
          $notification = array(
            'message' => __('msg_deleted_successfully'),
            'alert-type' => __('msg_success')
        );

        return redirect()->back()->with($notification);
    }
}
