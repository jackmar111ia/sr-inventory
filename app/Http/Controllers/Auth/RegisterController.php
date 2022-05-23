<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Models\admin\Apartment;
use App\Models\user\otpTrack;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
//manually added
// added from vendor\laravel\framework\src\Illuminate\Foundation\Auth\RegisterUsers
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

use GuzzleHttp\Client;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Http\Controllers\Traits\smsAndPhoneTrait;

use App\Rules\user\auth\checkApartmentAvilability;



class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers,smsAndPhoneTrait;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/login'; 

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            //'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
           // 'phone' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
   

    
    protected function create(array $data)
    {
        $email = $data['email'];
        //dd($email);
        if($email != ''){
            $user = User::where('email',$email)->first();
            if($user->password == "") {
                //dd("password empty",$email);
                $user->password = Hash::make($data['password']);
                $user->ustatus = 'active';
                $user->lastlogin = '';
                $user->save();
                $NewUserID = $user->id;
                Session::forget('customer_email');
                session()->flash('type',"success");
                session()->flash('msgType',"account_activation_and_password_set_success");
               return redirect()->route('login'); 
            }
            return redirect()->route('login'); 
            
        }
        dd("Session email not set");
       
     
    }

    /*
     // method override from  vendor\laravel\framework\src\Illuminate\Foundation\Auth\RegisterUsers
     //register(Request $request) , guard(),registered(Request $request, $user)
   
    */
   
    public function register(Request $request)
    {
       
        $this->ValidationCheck($request);  
       // $this->validator($request->all())->validate(); // this validate is blocked
       
        event(new Registered($user = $this->create($request->all())));
       
        //$this->guard()->login($user); // after registration, user will log in 
     
        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
                     
    }
    protected function guard()
    {
        return Auth::guard();
    }
    protected function registered(Request $request, $user)
    {
        //
    }


     // user defined validation function
    
     private function ValidationCheck($request)
     {
        
        $passwordMin = 6;
       
             $rules=[
               
                //'email'  => "nullable|string|email|max:$emailLength|unique:users",
                //'phone' => "required|numeric|min:$phoneMinLength|unique:users",
                'password' => "required|string|min:$passwordMin|confirmed|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/",
               
             ];
             $custom_error_msg=[
                 /*
                'phone.required'=> "Phone number is required!",
                'phone.min'=> alertMessage("Phone number's miniumum length")." ".$phoneMinLength,
             
                'phone.unique'=>  alertMessage("Phone has already been taken"),
                'phone.numeric'=>  alertMessage("The phone must be a number understand"),
                
                'name.required'  => alertMessage("Name field is required"),
                'name.string'  => alertMessage("Name should be string"),
                'name.max'=>  alertMessage("Name's max length")." ".$nameLength,

                'email.required'  => alertMessage("Email field is required"),
                'email.string'  => alertMessage("Email should be string"),
                'email.email'  => alertMessage("Invalid email format"),
                'email.max'=>  alertMessage("Email's max length")." ".$emailLength,
                'email.unique'=>  alertMessage("Email has already been taken"),
                */
                'password.required'  => alertMessage("Password field is required"),
                'password.string'  => alertMessage("Password should be string"),
                'password.min'  => alertMessage("The password must be at least")." ".$passwordMin." ".alertMessage("characters"),
                'password.confirmed'  => alertMessage("The password confirmation does not match"),
                'password.regex' => "Within the 6 characters password should contain at least 3 of a-z or A-Z and number and special character.",
            
               
             ];
     
        
         $this->validate($request,$rules,$custom_error_msg);
       
       
 
     }

     private function registrationOtpSendToUser($user,$callType){

        if($callType == "fresh")
            $OTP = $user->otp;
        else{
            // generate otp and after message sent update OTP in user table
            $OTP = randomUniqueId();
        }

        $dataSms['status'] = "otpAfterRegi";
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
        $otpObj->msgType = 'user_registration';
        $otpObj->created_at = Carbon::now();
        $otpObj->save();

        $otpTrackId = $otpObj->id;

        if($callType == "re_request"){
            // update users table to current otp
            $userObj = User::Find($user->id);
            $userObj->otp = $OTP;
            $userObj->save();

            // update all otp for that user to expire otp_tracks table to current otp
            $otpObjUpdate = otpTrack::where('phone', $user->phone)
            ->where('id','!=',$otpTrackId)
            ->where('msgType','user_registration')
            ->update([
                'otpStatus' =>'expired', 
                'updated_at' =>Carbon::now()
                
            ]);

          

        }

        return $sent_status;
   
     }
     //*******************************OTP Verification Related functions********************************************

     public function registrationOtpVerify(){
        return view('auth.otpValidate');
        } 

     public function registrationOtpReRequest(){

        $userPhone  = Session::get('nonValidatedPhone');
        /*  //if someone hits the link from browser 
        //and he does not bhave elong nonValidated session phone number
        // then  check wether he is logged or not, if logged the redirect to home 
        //otherwise redirect to login page
        */
        if(empty($userPhone)){
  
           if(Auth::guard('web')->check() == 1) // if user is logged in
           return redirect()->route('home');
  
           else{
              $type = "danger";
              $msg = "Wrong attempt!";
              session()->flash('type',$type);
              session()->flash('activemessage',$msg);
              session()->flash('additionalMsg',"no");
              return redirect()->route('login');
           }
          
        }
        else // 
        {
            $user = User::where('phone',$userPhone)
            ->where('otp_verify_status',0)
            ->first();
            if(!empty($user)){
                $sent_status = $this->registrationOtpSendToUser($user,"re_request");
                // session value set 
                if($sent_status == "sent"){

                    $nonvalidatedPhone  = Session::get('nonValidatedPhone');
                    Session::put('webucreate', 'retry');
                    Session::put('webuphone', $nonvalidatedPhone);
                    return redirect()->route('user.registration.otp.verify'); 
                    
                }
                else{
                    $type = "notice";
                    $msg = "Sorry, there is some problem to send OTP.";
                    session()->flash('type',$type);
                    session()->flash('activemessage',$msg);
                    session()->flash('additionalMsg',"no");
                    return redirect()->route('login');
                }
              
               
            }  
            else
                return redirect()->route('login');
            
             
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
            $route = "user.registration.otp.verify";
            
        }
        
        // check time for valid otp
        $user = User::where('phone',$phone)
                ->where('otp',$otp)
                ->where('otp_verify_status',0)
                ->first();

                // dd("$phone,$otp");  

                if(empty($user)) 
                {
                    $user2 = User::where('phone',$phone)
                    ->where('otp_verify_status',1)
                    ->first();
                    
                    if(!empty($user2)) 
                    { 
                        if(Auth::guard('web')->check() == 1) // if user is logged in
                        return redirect()->route('home');
                        else 
                        {
                            $type = "notice"; 
                            $msgType = "already_activated";
                            $route="login";
                            
                        }
                    
                    }
                    else
                    {
                        $type = "danger"; 
                        $msg = "Sorry! This is an invalid OTP. Please try again!";
                        $route = "user.registration.otp.verify";
                    
                    
                    }
                    
                    
                }
                else
                {
                    $id = $user->id;
                    
                    $UserObj = User::find($id);
                    $UserObj->otp_verify_status = 1;
                    $UserObj->otp = '';
                    $UserObj->otp_verified_at = Carbon::now();
                    $UserObj->save();
                
                    if ($UserObj->save())
                    {  
                        // update otp track
                        $otpObj = otpTrack::where('phone', $phone)
                                ->where('otp',$otp)
                                ->where('msgType','user_registration')
                                ->first();
                        $otpObj->otpStatus = 'expired';
                        $otpObj->updated_at = Carbon::now();
                        $otpObj->save();

                        // destroy user resiter session variable
                        $this->sessionDestroyAfterUserRegistration();

                        // now check notification type, if emil then check for email verification
                        $emailVerify = notificatioEmailVerificationCheck($phone);
                        if($emailVerify == "no"){

                            $type = "danger";
                            $msgType = "account_created_phone_validated_but_noti_email_verify_pending";
                            session()->flash('email',$UserObj->email);
                            session()->flash('type',$type);
                            session()->flash('msgType',$msgType);
                            return redirect()->route('login');

                        }
                       else{
                           
                            $type = "success"; 
                            $msgType = "successfully_activated";
                            $route = "login";
                        
                       }
                       
                    
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
