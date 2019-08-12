<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailUser extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
//        ->view('emails.test')
        return $this->from('thiagobfiorenza@gmail.com')
            ->markdown('emails.test-markdown')
            ->subject($this->request->subject)
            ->with([
                'subject' => $this->request->subject,
                'message' => $this->request->message,
            ]);
    }
}
