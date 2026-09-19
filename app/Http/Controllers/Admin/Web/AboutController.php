<?php

namespace App\Http\Controllers\Admin\Web;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Web\About;
use App\Traits\FileUploader;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class AboutController extends Controller
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
        $this->title   = trans_choice('module_about', 1);
        $this->route   = 'admin.about';
        $this->view    = 'admin.web.about';
        $this->path    = 'about';
        $this->access  = 'about';


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
        // dd('d');
        $data['title']  = $this->title;
        $data['route']  = $this->route;
        $data['view']   = $this->view;
        $data['path']   = $this->path;
        $data['access'] = $this->access;

        $data['rows'] = About::where('language_id', Language::version()->id)
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

            // dd($request->attach);
    
            //Data Insert
            $about = new About();
            $about->language_id = Language::version()->id;
            $about->title = $request->title;
          
            $about->faculty = $request->faculty;
            $about->semesters = $request->semesters;
            $about->credits = $request->credits;
            $about->courses = $request->courses;
            $about->duration = $request->duration;
            $about->slug = Str::slug($request->title, '-');
           
       
            $about->fee = $request->fee;
            $about->description = $request->description;
            $about->attach = $this->uploadImage($request, 'attach', $this->path, 800, 550);
            $about->save();
    
    
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
    public function edit(About $about)
    {
        $data['title']  = $this->title;
        $data['route']  = $this->route;
        $data['view']   = $this->view;
        $data['access'] = $this->access;

        $data['row'] =  $about;

        return view($this->view.'.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, About $about)
    {
        
            //Field Validation
            $request->validate([
                'title' => 'required|unique:courses,title,'.$about->id,
                'fee' => 'nullable|numeric',
                'attach' => 'nullable|image',
                
            ]);
    
            //Data Update
            $about->title = $request->title;
            
            $about->faculty = $request->faculty;
            $about->semesters = $request->semesters;
            $about->credits = $request->credits;
            $about->courses = $request->courses;
            $about->duration = $request->duration;
            $about->slug = Str::slug($request->title, '-');
          
            $about->fee = $request->fee;
            $about->description = $request->description;
            if($request->hasFile('attach')){
                $about->attach = $this->uploadImage($request, 'attach', $this->path, 800, 550);
            }
            $about->save();
    
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
    public function destroy(About $about)
    {
          //Delete Attach
          $this->deleteMedia($this->path, $about);

          //Delete Data
          $about->delete();
  
          // Toastr::success(__('msg_deleted_successfully'), __('msg_success'));
          
          $notification = array(
            'message' => __('msg_deleted_successfully'),
            'alert-type' => __('msg_success')
        );

        return redirect()->back()->with($notification);
  
          
    }
}
