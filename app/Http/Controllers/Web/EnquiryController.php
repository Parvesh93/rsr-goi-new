<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Mail\enquirymail;
use App\Models\MailSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EnquiryController extends Controller
{

    public function Enquiry(Request $request)
    {
        // dd($request->all());


        $request->validate([
            'full_name' => 'required',
            'address' => 'required',
            'course' => 'required',
            'contact'=>'required',
            'state' => 'required',
            'place' => 'required'
        ]);

        
        $mail = MailSetting::where('status', '1')->first();

        $data['name'] = $request->full_name;
        $data['address'] = $request->address;
        $data['contact'] = $request->contact;
        $data['course'] = $request->course;
        $data['state'] = $request->state;
        $data['place'] = $request->place;

        $data['subject'] = __('enquiry');
        $data['from'] = $mail->sender_email;
        $data['sender'] = $mail->sender_name;


        // $toEmail = "singhmrityunjay511@gmail.com";
        $toEmail = $mail->sender_email;

        //    $message="Send email to user";
        //    $subject="Enquiry Information...";

        Mail::to($toEmail)->send(new enquirymail($data));

       $notification = array(
                'message' => 'Send Successfully..!',
                'alert-type' => __('msg_success')
            );
    
        return redirect()->back()->with($notification);

        

    }
}
