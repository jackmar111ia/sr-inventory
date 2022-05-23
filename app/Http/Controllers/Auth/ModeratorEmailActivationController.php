<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Mail;
use App\Moderator; 
use App\Mail\VerifyRegisterdModerator;


use DB;
use Auth;
use Carbon\Carbon;
date_default_timezone_set('Asia/Dhaka');

class ModeratorEmailActivationController extends Controller
{
    public function activationCheck($email)
    {   
        if(Auth::guard('moderator')->check() == 0)
        { 
            $user = Moderator::where('email',$email)->first();
        
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
            
                
                return view('auth.activation-alerts',[ 'status'=>$status, 'user'=>$user, 'emailstatus'=>'' ]);

            }
            else
            {   
                session()->flash('type',"warning");
                session()->flash('activemessage',"Bad attempt!"); 
                return redirect()->route('moderator.login');
            }
        
        
        }
        else
        return redirect()->route('home');
    }

    public function resendactivationlink(Request $request)
    {
        //activation/check/jackmar111ia@gmail.com 
        if(Auth::guard('moderator')->check() == 0)
        {
            $id = $request->id;

            $user = Moderator::where('id', $id)->where('email_verified',0)->first();

            if(!empty($user))
            {   

                Mail::to($user->email)->send(new VerifyRegisterdModerator($user));
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

            }
            else // user not found
            return redirect()->route('moderator.login');
                
            return view('auth.activation-alerts',['status'=>'not_active','user'=>$user,'emailstatus' => $sent_status]);
           
            
        }
        else
        return redirect()->route('moderator');
    }


    public function accountactivate($email,$token)
    {
        if($token == "null")
        {
         $type = "warning"; 
         $msg = "Invalid Token!";
         $route = "moderator.login";
        
        }
 
        $user = Moderator::where('email',$email)
                 ->where('email_verification_token',$token)
                 ->where('email_verified',0)
                 ->first();
       
        if(empty($user)) 
        {
         $user2 = Moderator::where('email',$email)
         ->where('email_verified',1)
         ->first();
         
             if(!empty($user2)) 
             { 
             if(Auth::guard('moderator')->check() == 1)
             return redirect()->route('moderator');
             else 
             {
                 $type = "warning"; 
                 $msg = "You have already activated your account. Please log in! ";
                 $route="moderator.login";
                 
             }
            
             }
             else
             {
                 $type = "warning"; 
                 $msg = "Invalid token!";
                 $route = "moderator.login";
             
              
             }
            
         
        }
        else
        {
         $id = $user->id;
         
        $UpdateOwner = Moderator::find($id);
        $UpdateOwner->email_verified = 1;
        $UpdateOwner->email_verification_token = '';
        $UpdateOwner->email_verified_at = Carbon::now();
        $UpdateOwner->save();
        
            if ($UpdateOwner->save())
            {  
                $type="success"; 
                $msg = " You have successfully activated the account। 
                welcome to ".appname()."! Please  login to access your manager account!";
                $route = "moderator.login";
            }
            else
            {
                $type = "error"; 
                $msg = "Account activation problem found , Please try again!";
               $route = "moderator.email.activation.check";
            }
            
         
        }
 
        session()->flash('type',$type);
        session()->flash('activemessage',$msg);
        return redirect()->route("$route");
        
     //return view('verifications.activate');
 
    }

  
}
