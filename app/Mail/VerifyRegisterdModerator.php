<?php

namespace App\Mail;
use App\Moderator;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
 
class VerifyRegisterdModerator extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Moderator $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
         //return $this->view('view.name'); // default
         return $this->subject("Activate your ".appname()." moderator account")->view('moderator.email.registerVerify')
         ->with([
             'name' => $this->user->name,
             'token' => $this->user->email_verification_token,
             'email' => $this->user->email,
         ]);
    }
}
