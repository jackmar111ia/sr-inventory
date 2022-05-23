<?php
 
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;  // for sendFailedLoginResponse() function
use Auth;
use Session;

class ModeratorLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:moderator')->except('logout');
    }
    

    public function ShowLoginForm()
    {
        return view('auth.moderator-login');
    }

    public function login(Request $request)
    {
      // validate the form data
        $this->validate($request, [
            'email' =>    'required|email',
            'password' => 'required|min:6'
        ]);
        
      $credential = ['email' => $request->email, 'password' => $request->password];
      //dd($credential);
      // attempt to user the log in
      // Auth::attempt($credential, $remembre);
      
      if(Auth::guard('moderator')->attempt($credential, $request->remember))
      {  // if successfull then redirect their intended dashboard

          $user = Auth::guard('moderator')->user();

          if($user->email_verified == 1 ){
              // check for notification type . if phone then  check phone is verified or not
              $otpveriftStatus = $this->checkPhoneVerification($user);

              if($otpveriftStatus == "not_ok"){ // need to validate moderator Notification email by OTP
                // chck mobile otp verification
                  Auth::guard('moderator')->logout();  // logout moderator
                 // session value set 
                     if($user->otp != ''){
                      $sent_status = "sent";  
                      Session::put('webucreate', "success"); // user existed
                      Session::put('webuphone', $user->phone);
                      Session::put('webuname', $user->name);
                      Session::put('uotpstatus', $sent_status);
                    }
                    else
                    {   // otp Not sent during 
                      $sent_status = "not_sent";  

                    }
                
                return redirect()->route('moderator.registration.otp.verify'); 
              }else{

                if($user->activity_status == "approval_pending"){
                  Auth::guard('moderator')->logout();  // logout moderator
                  session()->flash('type',"warning");
                  session()->flash('activemessage',"Your have successfully activated the account.But admin did not approve your account yet. 
                  Please wait for admin approval."); 
                  return redirect()->route('moderator.login');
                }
                elseif($user->activity_status == "block" ){ 
                  // user is blocked
                  Auth::guard('moderator')->logout();  // logout moderator
                  session()->flash('type',"danger");
                  session()->flash('activemessage',"Your account is currently blocked.Please contact to admin."); 
                  return redirect()->route('moderator.login');
                }
                else{
                  //return response()->json([‘success’ => $success], $this-> successStatus);
                  return redirect()->intended(route('moderator.dashboard'));
                }

              }
             
          }else{ 
            // email not verified so  logout existing user  
            Auth::guard('moderator')->logout(); 
            // And redirect to the email authenticated link page with message
            return redirect()->route('moderator.email.activation.check',$user->email);
           //return response()->json([‘error’=>’Please Verify Email’], 401);
          
          }

      
      }
     
     
      // if unsuccessfull then redirect back to the login page with the fomar data
      return $this->sendFailedLoginResponse($request); 

      return redirect()->back()->withInput($request->only('email', 'remember'));
    }


   
    protected function sendFailedLoginResponse(Request $request)
    {
      throw ValidationException::withMessages([
        $this->username() => [trans('auth.failed')],
      ]);
    } 
    public function username()
    {
        return 'email';
    }

    public function logout()
    {
        Auth::guard('moderator')->logout();
        return redirect('/');
    }

    public function checkPhoneVerification($user){
      $notiType = $user->notiType;

      if($notiType == "phone"){
        if($user->otp_verify_status == 0){
          // verify phone with OTP
          //dd("here");
         
          $status = 'not_ok';
        }else{
          $status = "ok";
        }
      }else{
        $status = "ok";
      }
      return $status;
    }


}
