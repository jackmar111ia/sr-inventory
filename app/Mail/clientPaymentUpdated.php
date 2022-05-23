<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Models\user\Payment;


class clientPaymentUpdated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Payment $payObj)
    {
        $this->payment = $payObj;
       // dd($this->payment->amount);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->view('view.name'); // default
       // dd($this->payment->amount);
        return $this->subject("Client payment updated")->view('clients.email.clientPaymentUpdated')
        ->with([
            'paymentObj' => $this->payment,
            //'phone' => $this->payment->client->phone,
           // 'amount' => $this->payment->amount,
          //  'note_approved_user' => $this->payment->note_approved_user,

        ]);
    }
}
