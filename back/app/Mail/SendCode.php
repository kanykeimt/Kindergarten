<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendCode extends Mailable
{
    use Queueable, SerializesModels;

    public $code;

    public function __construct(int $code)
    {
        $this->code = $code;
    }


    public function build()
    {
        return $this->view('emails.sendCode')
            ->with([
                'code' => $this->code,
            ]);
    }
}
