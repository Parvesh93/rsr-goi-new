<?php

namespace App\Http\Controllers\Admin\Web;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Web\Academic;
use App\Traits\FileUploader;
use Illuminate\Http\Request;
use Illuminate\Support\Str;



class AcademicController extends Controller
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
        $this->title   = trans_choice('module_academic', 1);
        $this->route   = 'admin.academic';
        $this->view    = 'admin.web.academic';
        $this->path    = 'academic';
        $this->access  = 'academic';


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

        $data['rows'] = Academic::where('language_id', Language::version()->id)
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
        $academic = new Academic();
        $academic->language_id = Language::version()->id;
        $academic->title = $request->title;
        
        $academic->faculty = $request->faculty;
        $academic->semesters = $request->semesters;
        $academic->credits = $request->credits;
        $academic->courses = $request->courses;
        $academic->duration = $request->duration;
        $academic->slug = Str::slug($request->title, '-');
       
       
        $academic->fee = $request->fee;
        $academic->description = $request->description;
        $academic->attach = $this->uploadImage($request, 'attach', $this->path, 800, 600);
        $academic->save();


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
    public function edit(Academic $academic)
    {
        $data['title']  = $this->title;
        $data['route']  = $this->route;
        $data['view']   = $this->view;
        $data['access'] = $this->access;

        $data['row'] =  $academic;

        return view($this->view.'.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Academic $academic)
    {
          //Field Validation
          $request->validate([
            'title' => 'required|unique:courses,title,'.$academic->id,
            'fee' => 'nullable|numeric',
            'attach' => 'nullable|image',
            
        ]);

        //Data Update
        $academic->title = $request->title;
        
        $academic->faculty = $request->faculty;
        $academic->semesters = $request->semesters;
        $academic->credits = $request->credits;
        $academic->courses = $request->courses;
        $academic->duration = $request->duration;
        $academic->slug = Str::slug($request->title, '-');
       
   
        $academic->fee = $request->fee;
        $academic->description = $request->description;
        $academic->attach = $this->updateImage($request, 'attach', $this->path, 800, 600, $academic, 'attach');
        $academic->status = $request->status;
        $academic->update();


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
    public function destroy(Academic $academic)
    {
        
          //Delete Attach
          $this->deleteMedia($this->path, $academic);

          //Delete Data
          $academic->delete();
  
          // Toastr::success(__('msg_deleted_successfully'), __('msg_success'));
          $notification = array(
            'message' => __('msg_deleted_successfully'),
            'alert-type' => __('msg_success')
        );

        return redirect()->back()->with($notification);
    }

}
