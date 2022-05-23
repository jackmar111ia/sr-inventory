<?php

namespace App\Mail;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class clientNotificationEmailVerify extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
         //dd("From email file",$this->user);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //dd($this->user->name,$this->user->phone,$this->user->email,$this->user->email_verification_token); 
        //return $this->view('view.name'); // default
        return $this->subject("Account email verification.")->view('clients.email.clientNotificationEmailVerify')
        ->with([
            'name' => $this->user->name,
            'phone' => $this->user->phone,
            'email' => $this->user->email,
            'token' => $this->user->email_verification_token,
        ]);
    }
}
