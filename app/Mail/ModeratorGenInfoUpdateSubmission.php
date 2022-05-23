<?php

namespace App\Mail;
use App\Moderator;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ModeratorGenInfoUpdateSubmission extends Mailable
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
        return $this->subject("General info update request from moderator")->view('moderator.email.generalInfoUpdateSubmission')
        ->with([
            'name' => $this->user->name,
            'email' => $this->user->email,
        ]);
    }
}
