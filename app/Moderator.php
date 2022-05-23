<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

 
use Session;
use Carbon\Carbon;
use App\Models\user\otpTrack;
use App\Http\Controllers\Traits\smsAndPhoneTrait;

class Moderator extends Authenticatable
{
    use Notifiable,smsAndPhoneTrait;
    
    protected $guard = 'moderator';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','nid','role','notiType','email_verification_token','activity_status','present_address','permanent_address',
    ];
   
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

     //************************User defined functions*************************
     public function moderatorInfo($id)
     {  
        //return   $this::find($id);
        return  $this::find($id);
     }

     public function GenInfoAlert($mid)
     {
         if($mid != 0){
            $q = $this::Find($mid);
            return $q->edit_status;
        }
        
     }


     // OTP send to moderator  mobile 
    public function registrationOtpSendToUser($user,$callType){

        if($callType == "fresh")
            $OTP = $user->otp;
        else{
            // generate otp and after message sent update OTP in user table
            $OTP = randomUniqueId();
        }
  
        $dataSms['status'] = "otpAfterRegiForModeratorPhoneVerification";
        $dataSms['user'] = $user;
        $dataSms['otp'] = $OTP;
        $dataSms['phone_no_exist'] = "same";
        $smsReturnData = $this->smsResponse($dataSms);
        $sent_status = $smsReturnData['sent_status'];

        // store message send info to local database
        $otpObj = new otpTrack();
        $otpObj->phone = $user->phone;
  
        $otpObj->messageId = $smsReturnData['msgID'];
        $otpObj->msgTxt = $smsReturnData['msgTxt'];
        $otpObj->msgSendStatus = $smsReturnData['msgStatus'];
  
        $otpObj->otp = $OTP;
        $otpObj->otpStatus = 'active';
        $otpObj->msgType = 'moderator_registration';
        $otpObj->created_at = Carbon::now();
        $otpObj->save();
  
        $otpTrackId = $otpObj->id;
  
        if($callType == "re_request"){
            // update users table to current otp
            $userObj = Moderator::Find($user->id);
            $userObj->otp = $OTP;
            $userObj->save();
  
            // update all otp for that user to expire otp_tracks table to current otp
            $otpObjUpdate = otpTrack::where('phone', $user->phone)
            ->where('id','!=',$otpTrackId)
            ->where('msgType','moderator_registration')
            ->update([
                'otpStatus' =>'expired', 
                'updated_at' =>Carbon::now()
                
            ]);
  
          
  
        }
  
        return $sent_status;
   
    }





}
