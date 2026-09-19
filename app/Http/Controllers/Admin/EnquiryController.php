<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EnquiryReference;
use App\Models\EnquirySource;
use Illuminate\Http\Request;
use App\Models\Program;
use App\Models\Enquiry;
use App\Models\StudentEnquiry;
use Carbon\Carbon;
use App\Models\User;
use Toastr;
use Auth;

class EnquiryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Module Data
        $this->title = trans_choice('module_enquiry', 1);
        $this->route = 'admin.enquiry';
        $this->view = 'admin.enquiry';
        $this->path = 'enquiry';
        $this->access = 'enquiry';


        $this->middleware('permission:'.$this->access.'-view|'.$this->access.'-create|'.$this->access.'-edit|'.$this->access.'-delete', ['only' => ['index','show','status']]);
        $this->middleware('permission:'.$this->access.'-create', ['only' => ['create','store','status']]);
        $this->middleware('permission:'.$this->access.'-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:'.$this->access.'-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;
        $data['access'] = $this->access;


        if (!empty($request->person) || $request->person != null) {
            
            
            // dd('s1');
                $data['selected_person'] = $person = $request->person;
            } else {
                // dd('s2');
                $data['selected_person'] = $person = '0';
                
                
            }
            
        $data['persons'] = StudentEnquiry::whereNotNull('refrence_persion')
                               ->where('refrence_persion', '!=', '')
                              ->distinct()
                              ->pluck('refrence_persion');

        // if(!empty($request->source) || $request->source != null){
        //     $data['selected_source'] = $source = $request->source;
        // }
        // else{
        //     $data['selected_source'] = $source = '0';
        // }

        if(!empty($request->program) || $request->program != null){
            $data['selected_program'] = $program = $request->program;
        }
        else{
            $data['selected_program'] = $program = '0';
        }



    //   dd($program);
        if(!empty($request->start_date) || $request->start_date != null){
            $data['selected_start_date'] = $start_date = $request->start_date;
        }
        else{
            $data['selected_start_date'] = $start_date = date('Y-m-d', strtotime(Carbon::now()->subYear()));
        }

        if(!empty($request->end_date) || $request->end_date != null){
            $data['selected_end_date'] = $end_date = $request->end_date;
        }
        else{
            $data['selected_end_date'] = $end_date = date('Y-m-d', strtotime(Carbon::today()));
        }


    //   $rows = StudentEnquiry::where('course', $program)->get();
    //   dd($rows);

        // Search Filter
        $data['references'] = EnquiryReference::where('status', '1')
                            ->orderBy('title', 'asc')->get();
        $data['sources'] = EnquirySource::where('status', '1')
                            ->orderBy('title', 'asc')->get();
        $data['programs'] = Program::where('status', '1')
                            ->orderBy('title', 'asc')->get();

        $rows = StudentEnquiry::whereDate('enquiry_date', '>=', $start_date)
                    ->whereDate('enquiry_date', '<=', $end_date);
                    
                    if(!empty($request->program)){
                        
                        // dd($program);
                        
                        $rows->where('course', $program);
                        // dd($rows);
                    }
                    
                    if(!empty($request->person) || $request->person != '0'){
                        
                        // dd($request->person);
                        
                        $rows->where('refrence_persion', $person);
                    }
                    
                    
                    
                    
                    
                    
            // dd($rows) ;       
                    
                    
                        
        $data['rows'] = $rows->orderBy('id', 'desc')->get();

        return view($this->view .'.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;

        $data['references'] = EnquiryReference::where('status', '1')
                            ->orderBy('title', 'asc')->get();
        $data['sources'] = EnquirySource::where('status', '1')
                            ->orderBy('title', 'asc')->get();
        $data['programs'] = Program::where('status', '1')
                            ->orderBy('title', 'asc')->get();
        $data['users'] = User::where('status', '1')
                            ->orderBy('staff_id', 'asc')->get();

        return view($this->view.'.create', $data);
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
            'program' => 'required',
            'name' => 'required',
            'email' => 'nullable|email',
            'date' => 'required|date|before_or_equal:today',
            'follow_up_date' => 'nullable|date|after_or_equal:today',
        ]);


        //Insert Data
        $enquiry = new Enquiry;
        $enquiry->reference_id = $request->reference;
        $enquiry->source_id = $request->source;
        $enquiry->program_id = $request->program;
        $enquiry->name = $request->name;
        $enquiry->father_name = $request->father_name;
        $enquiry->phone = $request->phone;
        $enquiry->email = $request->email;
        $enquiry->address = $request->address;
        $enquiry->purpose = $request->purpose;
        $enquiry->note = $request->note;
        $enquiry->date = $request->date;
        $enquiry->follow_up_date = $request->follow_up_date;
        $enquiry->assigned = $request->assigned;
        $enquiry->number_of_students = 1;
        $enquiry->created_by = Auth::guard('web')->user()->id;
        $enquiry->save();


        Toastr::success(__('msg_created_successfully'), __('msg_success'));

        return redirect()->route($this->route.'.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function show(Enquiry $enquiry)
    {
        //
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;

        $data['row'] = $enquiry;

        return view($this->view.'.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function edit(Enquiry $enquiry)
    {
        //
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;

        $data['row'] = $enquiry;
        $data['references'] = EnquiryReference::where('status', '1')
                            ->orderBy('title', 'asc')->get();
        $data['sources'] = EnquirySource::where('status', '1')
                            ->orderBy('title', 'asc')->get();
        $data['programs'] = Program::where('status', '1')
                            ->orderBy('title', 'asc')->get();
        $data['users'] = User::where('status', '1')
                            ->orderBy('staff_id', 'asc')->get();

        return view($this->view.'.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Enquiry $enquiry)
    {
        // Field Validation
        $request->validate([
            'program' => 'required',
            'name' => 'required',
            'email' => 'nullable|email',
            'date' => 'required|date|before_or_equal:today',
            'follow_up_date' => 'nullable|date|after_or_equal:date',
        ]);


        //Update Data
        $enquiry->reference_id = $request->reference;
        $enquiry->source_id = $request->source;
        $enquiry->program_id = $request->program;
        $enquiry->name = $request->name;
        $enquiry->father_name = $request->father_name;
        $enquiry->phone = $request->phone;
        $enquiry->email = $request->email;
        $enquiry->address = $request->address;
        $enquiry->purpose = $request->purpose;
        $enquiry->note = $request->note;
        $enquiry->date = $request->date;
        $enquiry->follow_up_date = $request->follow_up_date;
        $enquiry->assigned = $request->assigned;
        $enquiry->number_of_students = 1;
        $enquiry->status = $request->status;
        $enquiry->updated_by = Auth::guard('web')->user()->id;
        $enquiry->save();


        Toastr::success(__('msg_updated_successfully'), __('msg_success'));

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $enquiry = StudentEnquiry::findOrFail($id);
        $enquiry->delete();

        Toastr::success(__('msg_deleted_successfully'), __('msg_success'));

        return redirect()->back();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function status(Request $request, $id)
    {
        $request->validate([
            'status' => 'required',
        ]);

        $enquiry = StudentEnquiry::findOrFail($id);
        $enquiry->status = $request->status;
        $enquiry->save();

        $notification = [
            'message' => __('msg_status_changed'),
            'alert-type' => __('msg_success'),
        ];

        return redirect()->back()->with($notification);
    }
    
    public function activeEnquiry(){
        
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;
        $data['access'] = $this->access;
        
       $today_date = Carbon::parse(Carbon::today())->format('Y-m-d');
        
        
        $data['references'] = EnquiryReference::where('status', '1')
                            ->orderBy('title', 'asc')->get();
        $data['sources'] = EnquirySource::where('status', '1')
                            ->orderBy('title', 'asc')->get();
        $data['programs'] = Program::where('status', '1')
                            ->orderBy('title', 'asc')->get();
                            
       $data['rows'] = StudentEnquiry::where('enquiry_date', $today_date)->where('status', '1')->get();    
       
       return view($this->view.'.active_enquiry', $data);
    }
}
