<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class enquirymail extends Mailable
{
    use Queueable, SerializesModels;
   
     public $data;
    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        //
        $this->data=$data;
        // $this->subject=$subject;
    }

    /**
     * Get the message envelope.
     */
    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: $this->subject,
    //     );
    // }

    /**
     * Get the message content definition.
     */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'test.enquiry',
    //     );
    // }


     /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->data['from'], $this->data['sender'])->subject($this->data['subject'])->view('emails.enquiry');
    }

    
    
}
