<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Moderator;
use App\Models\user\otpTrack;
use Session;
use Carbon\Carbon;
use Auth;

class ModeratorPhoneActivationController extends Controller
{
      //*******************************OTP Verification Related functions********************************************

   public function registrationOtpVerify(){
     // dd("here");
   
    return view('auth.moderator.otpValidate');
    } 

    public function registrationOtpReRequest(){

      
        $userPhone  = Session::get('nonValidatedPhone');
        //dd("here $userPhone");
        /*  //if someone hits the link from browser 
        //and he does not bhave elong nonValidated session phone number
        // then  check wether he is logged or not, if logged the redirect to home 
        //otherwise redirect to login page
        */
        if(empty($userPhone)){

        if(Auth::guard('moderator')->check() == 1) // if user is logged in
        return redirect()->route('moderator.dashboard');

        else{
            $type = "danger";
            $msg = "Wrong attempt!";
            session()->flash('type',$type);
            session()->flash('activemessage',$msg);
            session()->flash('additionalMsg',"no");
            return redirect()->route('moderator.login');
        }
        
        }
        else // 
        {
            $user = Moderator::where('phone',$userPhone)
            ->where('otp_verify_status',0)
            ->first();
            if(!empty($user)){
                $sent_status = registrationOtpSendToUser($user,"re_request");
                // session value set 
                if($sent_status == "sent"){

                    $nonvalidatedPhone  = Session::get('nonValidatedPhone');
                    Session::put('webucreate', 'retry');
                    Session::put('webuphone', $nonvalidatedPhone);
                    return redirect()->route('moderator.registration.otp.verify'); 
                    
                }
                else{
                    $type = "notice";
                    $msg = "Sorry, there is some problem to send OTP.";
                    session()->flash('type',$type);
                    session()->flash('activemessage',$msg);
                    session()->flash('additionalMsg',"no");
                    return redirect()->route('moderator.login');
                }
            
            
            }  
            else
                return redirect()->route('moderator.login');
            
            
        }

    }

    
    public function registrationOtpSubmit(Request $request){
        $msgType = ''; $msg ='';

        $phone = Session::get('webuphone');
        $otp =  $request->otp;

        if($otp == "null")
        {
            $type = "warning"; 
            $msg = "Sorry! OTP does not exist!";
            $route = "moderator.registration.otp.verify";
            
        }
        
        // check time for valid otp
        $user = Moderator::where('phone',$phone)
                ->where('otp',$otp)
                ->where('otp_verify_status',0)
                ->first();

                // dd("$phone,$otp");  

                if(empty($user)) 
                {
                    $user2 = Moderator::where('phone',$phone)
                    ->where('otp_verify_status',1)
                    ->first();
                    
                    if(!empty($user2)) 
                    { 
                        if(Auth::guard('moderator')->check() == 1) // if user is logged in
                        return redirect()->route('moderator.dashboard');
                        else 
                        {
                            $type = "notice"; 
                            $msgType = "already_activated";
                            $route="moderator.login";
                            
                        }
                    
                    }
                    else
                    {
                        $type = "danger"; 
                        $msg = "Sorry! This is an invalid OTP. Please try again!";
                        $route = "moderator.registration.otp.verify";
                    
                    
                    }
                    
                    
                }
                else
                {
                    $id = $user->id;
                    
                    $UserObj = Moderator::find($id);
                    $UserObj->otp_verify_status = 1;
                    $UserObj->otp = '';
                    $UserObj->otp_verified_at = Carbon::now();
                    $UserObj->save();
                
                    if ($UserObj->save())
                    {  
                        // update otp track
                        $otpObj = otpTrack::where('phone', $phone)
                                ->where('otp',$otp)
                                ->where('msgType','moderator_registration')
                                ->first();
                        $otpObj->otpStatus = 'expired';
                        $otpObj->updated_at = Carbon::now();
                        $otpObj->save();

                        // destroy user resiter session variable
                        $this->sessionDestroyAfterUserRegistration();

                        
                        $type = "success"; 
                        $msgType = "successfully_activated";
                        $route = "moderator.login";
                        
                   
                    
                    }
                    else
                    {
                        $type = "error"; 
                        $msg = "Account activation problem found, Please try again!";
                        $route = "user.registration.otp.verify";
                    }
                    
                    
                }
            
                session()->flash('type',$type);
                session()->flash('activemessage',$msg);
                session()->flash('msgType',$msgType);
                return redirect()->route("$route");
                
                //return view('verifications.activate');

    }
    
    public function registrationOtpReVerify(){
        // session value set 
        $nonvalidatedPhone  = Session::get('nonValidatedPhone');
        Session::put('webucreate', 'retry');
        Session::put('webuphone', $nonvalidatedPhone);
        
        return redirect()->route('user.registration.otp.verify'); 
    }

    private function sessionDestroyAfterUserRegistration(){
            
        Session::forget('webucreate');
        Session::forget('webuphone');
        Session::forget('webuname');
        Session::forget('uotpstatus');
        Session::forget('nonValidatedPhone');
        
        return "";
    }


    
     

}
