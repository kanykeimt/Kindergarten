<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendWarningMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $message;
    public function __construct($message)
    {
        $this->message = $message;
    }

    public function build()
    {
        return $this->subject('Warning message') // Set the subject here
        ->view('emails.warning')
            ->with('content', $this->message);
    }
//    public function envelope(): Envelope
//    {
//        return new Envelope(
//            subject: 'Send Warning Message',
//        );
//    }
//    public function content(): Content
//    {
//        return new Content(
//            view: 'emails.warning',
//        );
//    }
//
//    /**
//     * Get the attachments for the message.
//     *
//     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
//     */
//    public function attachments(): array
//    {
//        return [];
//    }
}
