<?php

namespace App\Http\Controllers\Admin\Web;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Web\Placement;
use App\Traits\FileUploader;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PlacementController extends Controller
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
        $this->title   = trans_choice('module_placement', 1);
        $this->route   = 'admin.placement';
        $this->view    = 'admin.web.placement';
        $this->path    = 'placement';
        $this->access  = 'placement';


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

        $data['rows'] = Placement::where('language_id', Language::version()->id)
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
        $placement = new Placement();
        $placement->language_id = Language::version()->id;
        $placement->title = $request->title;
        $placement->slug = Str::slug($request->title, '-');
        $placement->faculty = $request->faculty;
        $placement->semesters = $request->semesters;
        $placement->credits = $request->credits;
        $placement->courses = $request->courses;
        $placement->duration = $request->duration;
        
        
        $placement->fee = $request->fee;
        $placement->description = $request->description;
        $placement->attach = $this->uploadImage($request, 'attach', $this->path, 800, 600);
        $placement->save();


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
    public function edit(Placement $placement)
    {
        
        $data['title']  = $this->title;
        $data['route']  = $this->route;
        $data['view']   = $this->view;
        $data['access'] = $this->access;

        $data['row'] =  $placement;

        return view($this->view.'.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Placement $placement)
    {
        
         //Field Validation
         $request->validate([
            'title' => 'required|unique:courses,title,'.$placement->id,
            'fee' => 'nullable|numeric',
            'attach' => 'nullable|image',
           
        ]);

        //Data Update
        $placement->title = $request->title;
        $placement->slug = Str::slug($request->title, '-');
        $placement->faculty = $request->faculty;
        $placement->semesters = $request->semesters;
        $placement->credits = $request->credits;
        $placement->courses = $request->courses;
        $placement->duration = $request->duration;
        
        $placement->fee = $request->fee;
        $placement->description = $request->description;
        $placement->attach = $this->updateImage($request, 'attach', $this->path, 800, 600, $placement, 'attach');
        $placement->status = $request->status;
        $placement->update();


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
    public function destroy(Placement $placement)
    {
        
         //Delete Attach
         $this->deleteMedia($this->path, $placement);

         //Delete Data
         $placement->delete();
 
         // Toastr::success(__('msg_deleted_successfully'), __('msg_success'));
         $notification = array(
            'message' => __('msg_deleted_successfully'),
            'alert-type' => __('msg_success')
        );

        return redirect()->back()->with($notification);
    }
}
