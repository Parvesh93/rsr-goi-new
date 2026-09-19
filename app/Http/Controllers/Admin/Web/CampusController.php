<?php

namespace App\Http\Controllers\Admin\Web;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Web\Campus;
use App\Traits\FileUploader;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CampusController extends Controller
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
        $this->title   = trans_choice('module_campus', 1);
        $this->route   = 'admin.campus';
        $this->view    = 'admin.web.campus';
        $this->path    = 'campus';
        $this->access  = 'campus';


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

        $data['rows'] = Campus::where('language_id', Language::version()->id)
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
        $campus = new Campus();
        $campus->language_id = Language::version()->id;
        $campus->title = $request->title;
       
        $campus->faculty = $request->faculty;
        $campus->semesters = $request->semesters;
        $campus->credits = $request->credits;
        $campus->courses = $request->courses;
        $campus->duration = $request->duration;
        $campus->slug = Str::slug($request->title, '-');
       
      
        $campus->fee = $request->fee;
        $campus->description = $request->description;
        $campus->attach = $this->uploadImage($request, 'attach', $this->path, 800, 600);
        $campus->save();


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
    public function edit(Campus $campus)
    {
        
        $data['title']  = $this->title;
        $data['route']  = $this->route;
        $data['view']   = $this->view;
        $data['access'] = $this->access;

        $data['row'] =  $campus;

        return view($this->view.'.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Campus $campus)
    {
          //Field Validation
          $request->validate([
            'title' => 'required|unique:courses,title,'.$campus->id,
            'fee' => 'nullable|numeric',
            'attach' => 'nullable|image',
            
        ]);

        //Data Update
        $campus->title = $request->title;
        $campus->slug = Str::slug($request->title, '-');
       
        $campus->faculty = $request->faculty;
        $campus->semesters = $request->semesters;
        $campus->credits = $request->credits;
        $campus->courses = $request->courses;
        $campus->duration = $request->duration;
       
        
        $campus->fee = $request->fee;
        $campus->description = $request->description;
        $campus->attach = $this->updateImage($request, 'attach', $this->path, 800, 600, $campus, 'attach');
        $campus->status = $request->status;
        $campus->update();


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
    public function destroy(Campus $campus)
    {
        
         //Delete Attach
         $this->deleteMedia($this->path, $campus);

         //Delete Data
         $campus->delete();
 
         // Toastr::success(__('msg_deleted_successfully'), __('msg_success'));
         $notification = array(
            'message' => __('msg_deleted_successfully'),
            'alert-type' => __('msg_success')
        );

        return redirect()->back()->with($notification);
    }
}
