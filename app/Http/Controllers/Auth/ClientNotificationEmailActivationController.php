<?php 
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Mail;
use App\User; 
use App\Mail\VerifyRegisterdModerator;

use Session;
use DB;
use Auth;
use Carbon\Carbon;
date_default_timezone_set('Asia/Dhaka');

class ClientNotificationEmailActivationController extends Controller
{
    public function activationCheck($email)
    {   
        if(Auth::guard('web')->check() == 0)
        { 
            $user = User::where('email',$email)->first();
        
            if(!empty($user)) 
            {
                $emailVerifyStatus=$user->email_verified;
                if($emailVerifyStatus == 0) 
                {
                $status="not_active";
                }
                else 
                {
                $status="active";
                }
                
                return view('auth.client-notification-email-alerts',[ 'status'=>$status, 'user'=>$user, 'emailstatus'=>'' ]);

            }
            else
            {   
                session()->flash('type',"warning");
                session()->flash('activemessage',"Bad attempt!"); 
                return redirect()->route('login');
            }
        
        
        }
        else
        return redirect()->route('home');
    }

    public function resendactivationlink(Request $request)
    {
       
        //activation/check/jackmar111ia@gmail.com 
        if(Auth::guard('web')->check() == 0)
        {
            $id = $request->id;

            $user = User::where('id', $id)->where('email_verified',0)->first();
            
            if(!empty($user))
            {   
                $emailVerify = notificatioEmailVerificationCheck($user->phone);
                //dd($emailVerify);
                if($emailVerify == "no"){
                    $type = "danger";
                    $msgType = "account_created_phone_validated_but_noti_email_verify_pending";
                    session()->flash('email',$user->email);
                    session()->flash('type',$type);
                    session()->flash('msgType',$msgType);
                    return redirect()->route('login');
                }
                
            }
            else // user not found
            return redirect()->route('login');
                
            return view('auth.client-notification-email-alerts',['status'=>'not_active','user'=>$user,'emailstatus' => $sent_status]);
           
            
        }
        else
        return redirect()->route('moderator');
    }


    public function accountactivate($email,$token)
    {
      
       
        if($token == "null")
        {  // dd("Token null");
         $type = "warning"; 
         $msg = "Invalid Token!";
         $route = "login";
        
        }
 
        $user = User::where('email',$email)
                 ->where('email_verification_token',$token)
                 ->where('email_verified',0)
                 ->first();
       
        if(empty($user)) 
        {
           
         $user2 = User::where('email',$email)
         ->where('email_verified',1)
         ->first();
         
            if(!empty($user2)) 
            { 
               
                if(Auth::guard('web')->check() == 1)
                return redirect()->route('home');
                else 
                {
                    // check password is set or not
                    if($user2->password == ""){
                        // send to reset password page
                        Session::put('customer_email', $user2->email);
                        $msg = "successfully_activated";
                        $type = "success"; 
                        $route = "register";
                       
                    }else{
                        // send to reset password page
                        $type = "warning"; 
                        $msg = "You have already activated your account. Please login! ";
                        $route = "login";
                    }
                }
            }
            else
            {
                $type = "warning"; 
                $msg = "Invalid token!";
                $route = "login";
            }
     
        }
        else
        {
           
            $id = $user->id;
            $UpdateOwner = User::find($id);
            $UpdateOwner->email_verified = 1;
            $UpdateOwner->email_verification_token = '';
            $UpdateOwner->email_verified_at = Carbon::now();
            $UpdateOwner->save();
        
            if ($UpdateOwner->save())
            {  
                Session::put('customer_email', $UpdateOwner->email);
                $msg = "successfully_activated";
                $type = "success"; 
                $route = "register";
              
            }
            else
            {
                $type = "error"; 
                $msg = "Account activation problem found , Please try again!";
               $route = "client.email.activation.check";
            }
            
         
        }
 
        session()->flash('type',$type);
        session()->flash('activemessage',$msg);
        return redirect()->route("$route");
        
     //return view('verifications.activate');
 
    }

   
  
}
