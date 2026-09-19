<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Mail\enquirymail;
use App\Models\MailSetting;
use App\Models\Program;
use App\Models\StudentEnquiry;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EnquiryController extends Controller
{
    public function Enquiry(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'contact' => 'required|string|max:50',
            'course' => 'required',
            'state' => 'required|string|max:255',
        ]);

        try {
            // Support both the newer form and the older RSRGOI form while deployment caches clear.
            $email = $request->input('email', $request->input('address'));
            $address = $request->input('address');
            if (!$request->filled('email') && $request->filled('place')) {
                $address = $request->input('place');
            }

            $program = is_numeric($request->course)
                ? Program::where('id', $request->course)->where('status', '1')->first()
                : Program::where('title', $request->course)->where('status', '1')->first();

            $studentEnquiry = new StudentEnquiry();
            $studentEnquiry->name = $request->full_name;
            $studentEnquiry->email = $email;
            $studentEnquiry->contact = $request->contact;
            $studentEnquiry->course = $program->id ?? null;
            $studentEnquiry->state = $request->state;
            $studentEnquiry->here_me = $request->here_me;
            $studentEnquiry->refrence_persion = $request->ref_persion;
            $studentEnquiry->enquiry_date = Carbon::today()->format('Y-m-d');
            $studentEnquiry->address = $address;
            $studentEnquiry->status = 1;
            $studentEnquiry->save();

            $mail = MailSetting::where('status', '1')->first();

            if ($mail && !empty($mail->sender_email)) {
                $data = [
                    'name' => $request->full_name,
                    'email' => $email,
                    'contact' => $request->contact,
                    'course' => $program->title ?? (string) $request->course,
                    'state' => $request->state,
                    'here_me' => $request->here_me,
                    'ref_persion' => $request->ref_persion,
                    'address' => $address,
                    'subject' => __('enquiry'),
                    'from' => $mail->sender_email,
                    'sender' => $mail->sender_name,
                ];

                Mail::to($mail->sender_email)->send(new enquirymail($data));
            }

            $notification = [
                'message' => 'Enquiry submitted successfully.',
                'alert-type' => __('msg_success'),
            ];

            return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            report($e);

            $notification = [
                'message' => __('msg_updated_error'),
                'alert-type' => __('msg_error'),
            ];

            return redirect()->back()->with($notification);
        }
    }
}
