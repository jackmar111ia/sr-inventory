<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Mail;
use App\Mail\clientNotificationEmailVerify;
use Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'phone','email','password',
    ]; 
    //protected $guarded = ['email'];
     
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
       
    ];

    
    // user defined function 
    public function CheckUserOtpVerification($phone){
        
        $query = User::where('phone', $phone)->first();
        if($query->otp_verify_status == 0)
        $status = 'not_verify';
        else
        $status = 'verify';
       return $status;
    }
     
    public function CheckUserStatus($phone){

        $query = User::where('phone', $phone)->where('otp_verify_status',1)->first();
        
       return $query->ustatus;
    }


    public function clientInfo($id)
    {  
       //return   $this::find($id);
       return  $this::find($id);
    }

    public function GenInfoAlertUser($mid)
    {
        if($mid != 0){
           $q = $this::Find($mid);
           return $q->edit_status;
       }
       
    }

    public function notificatioEmailVerificationCheck($user){
         
        //dd($user->email_verified);
        if($user->email_verified == 0)
        {
            // go to email verification process

            Mail::to($user->email)->send(new clientNotificationEmailVerify($user));
            if( count(Mail::failures()) > 0 ) {
                /*
                foreach(Mail::failures as $email_address) {
                    echo "$email_address <br />";
                }
                */
                $sent_status="not_sent";
            
            } else {
                // echo "Mail sent successfully!";
                $sent_status="sent";
            }
            //*******************for email****************
          
            return $sent_status;
            
        }else{
           // go to other process; // notification type is phone so no need to email verify
           return "account_verified";
        }
    }
    

}
