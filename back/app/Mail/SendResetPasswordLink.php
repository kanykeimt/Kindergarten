<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendResetPasswordLink extends Mailable
{
    use Queueable, SerializesModels;
    private string $email;
    /**
     * Create a new message instance.
     */
    public function __construct(string $email)
    {
        $this->email = $email;
    }

   public function build(){
       $email = $this->email;
       return $this->from('kanysh150@gmail.com', 'Change password!')
           ->view('emails.sendResetPasswordLink', compact('email'));
   }


}
