<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\StudentEnroll;
use Illuminate\Http\Request;
use App\Models\FeesCategory;
use App\Models\Student;
use App\Models\Fee;
use App\Models\StudentFees;
use App\Traits\FileUploader;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\PrintSetting;
use App\Models\Transaction;
use Auth;
use Carbon\Carbon;

class FeesController extends Controller
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
        $this->title = trans_choice('module_fees_report', 1);
        $this->route = 'student.fees';
        $this->view = 'student.fees';
        $this->path = 'fees';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $data['title']     = $this->title;
        $data['route']     = $this->route;
        $data['view']      = $this->view;
        $data['path']      = $this->path;


        $data['user'] = $user = Student::where('id', Auth::guard('student')->user()->id)->firstOrFail();

        $data['sessions'] = StudentEnroll::where('student_id', $user->id)->groupBy('session_id')->get();
        $data['semesters'] = StudentEnroll::where('student_id', $user->id)->groupBy('semester_id')->get();
        $data['categories'] = FeesCategory::where('status', '1')->orderBy('title', 'asc')->get();


        if(!empty($request->session) || $request->session != null){
            $data['selected_session'] = $session = $request->session;
        }
        else{
            $data['selected_session'] = $session = '0';
        }

        if(!empty($request->semester) || $request->semester != null){
            $data['selected_semester'] = $semester = $request->semester;
        }
        else{
            $data['selected_semester'] = $semester = '0';
        }

        if(!empty($request->category) || $request->category != null){
            $data['selected_category'] = $category = $request->category;
        }
        else{
            $data['selected_category'] = '0';
        }


        // Filter Fees
        $fees = Fee::with('studentEnroll')->whereHas('studentEnroll', function ($query) use ($user, $session, $semester){
                $query->where('student_id', $user->id);
            if($session != 0){
                $query->where('session_id', $session);
            }
            if($semester != 0){
                $query->where('semester_id', $semester);
            }
        });
        if(!empty($request->category)){
            $fees->where('category_id', $category);
        }
        $data['rows'] = $fees->where('status', '<=', '1')->orderBy('assign_date', 'desc')->get();

        
        return view($this->view.'.index', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pay($id)
    {
        //
        $data['title']     = $this->title;
        $data['route']     = $this->route;
        $data['view']      = $this->view;
        $data['path']      = $this->path;

        $user = Auth::guard('student')->user()->id;

        // Filter Fees
        $fees = Fee::where('id', $id)->with('studentEnroll')->whereHas('studentEnroll', function ($query) use ($user){
            $query->where('student_id', $user);
        });
        $data['row'] = $fees->where('status', '<', '1')->firstOrFail();

        return view($this->view.'.pay', $data);
    }
    
    
    
     public function quickReceived()
    {
        //
        $data['title'] = trans_choice('module_fees_upload', 1);
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;
        // $data['access'] = $this->access;


        $data['categories'] = FeesCategory::where('status', '1')->orderBy('title', 'asc')->get();

        // Filter Student
        $students = StudentEnroll::where('status', '1');
        $students->with('student')->whereHas('student', function ($query){
            $query->where('status', '1');
            $query->orderBy('student_id', 'asc');
        });

        $data['students'] = $students->orderBy('student_id', 'asc')->get();


        return view($this->view.'.quick-received', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function quickReceivedStore(Request $request)
    {
        // Field Validation
        $request->validate([
            'student' => 'required',
            'category' => 'required',
            'attach' => 'required|file|mimes:jpg,jpeg,png,pdf,doc,docx,zip,rar,csv,xls,xlsx,ppt,pptx|max:20480',
            'fee_amount' => 'required|numeric',
            'discount_amount' => 'required|numeric',
            'fine_amount' => 'required|numeric',
            'paid_amount' => 'required|numeric',
            'payment_method' => 'required',
            'due_date' => 'required|date',
            'pay_date' => 'required|date|before_or_equal:today',
        ]);





// dd($request->all());
            
            try{
            DB::beginTransaction();
       
            // Insert Data
            $students_fees = new StudentFees();
            $students_fees->student_enroll_id = $request->student;
            
            $students_fees->category_id = $request->category;
            $students_fees->fee_amount = $request->fee_amount;
            $students_fees->discount_amount = $request->discount_amount;
            $students_fees->fine_amount = $request->fine_amount;
            $students_fees->paid_amount = $request->paid_amount;
            $students_fees->assign_date = Carbon::today();
            $students_fees->due_date = $request->due_date;
            $students_fees->pay_date = $request->pay_date;
            $students_fees->payment_method = $request->payment_method;
            $students_fees->attach=$this->uploadMedia($request, 'attach', 'reciept');
            $students_fees->note = $request->note;
            $students_fees->status = '1';
            
            // $fee->updated_by = Auth::guard('web')->user()->id;
            $students_fees->save();


            // Transaction
            // $transaction = new Transaction;
            // $transaction->transaction_id = Str::random(16);
            // $transaction->amount = $request->paid_amount;
            // $transaction->type = '1';
            // $transaction->created_by = Auth::guard('web')->user()->id;
            // $fee->studentEnroll->student->transactions()->save($transaction);
            DB::commit();


            
            // toastr('Created Successfully!','success');
            $notification = array(
                'message' => __('msg_created_successfully'),
                'alert-type' => __('msg_success')
            );
    
            return redirect()->back()->with($notification);

            // return redirect()->back();
        }
        catch(\Exception $e){

           
            // toastr('Created Failed!','error');
            $notification = array(
                'message' => __('msg_created_error'),
                'alert-type' => __('msg_error')
            );
    
            return redirect()->back()->with($notification);

            // return redirect()->back();
        }
    }
    
    
   
}
