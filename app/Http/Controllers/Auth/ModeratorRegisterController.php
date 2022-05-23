<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
//use App\Providers\RouteServiceProvider;
use App\Moderator;
use App\Models\user\otpTrack;
use Carbon\Carbon;

use Mail;
use App\Mail\VerifyRegisterdModerator;


use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
//manually added
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


use GuzzleHttp\Client;
use Session;
  

class ModeratorRegisterController extends Controller
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

    use RegistersUsers;  // reuse the trait 

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
        protected $redirectTo = '/moderator/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:moderator');
    }

    public function ShowRegistrationForm()
    {
      return view('auth.moderator-register');
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:moderators'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Owner
     */
     
    
    protected function create(array $data)
    {
        //dd($request->all()); 
        // random unique 6 digit OTP generate
        $OTP = randomUniqueId();
        //dd($OTP);
     
        $user = new Moderator();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->email_verification_token = Str::random(40);
        $user->role = 3; // for moderator role is 3
        $user->email_verified = 0;
        $user->country_code = "+88";
       
        $user->notiType = $data['notiType'];

        if($data['notiType'] == "phone"){
            $user->phone = $data['phone'];
            $user->otp = $OTP;
            $user->otp_verify_status = 0;
        }
        $user->present_address = $data['present_address'];
        $user->permanent_address = $data['permanent_address'];
        $user->nid = $data['nid'];
        $user->password = Hash::make($data['password']);
        //$user->activity_status = 'approval_pending';
        $user->activity_status = 'approval_pending';
        $user->lastlogin = '';
        $user->save();
        
        $NewUserID = $user->id;

        if($NewUserID>0)  
        {
            $userCreate="success";
            //*******************for email****************
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
            //*******************for email****************

            //check moderator's notiType, if phone then send OTP
            if($user->notiType == "phone"){
            $sent_status = registrationOtpSendToUser($user,"fresh"); 
            }
           
        
        }
        else
        {
            $userCreate="error";
            $sent_status="not_sent";
        }
         

        //dd("$userCreate,$user->name,$user->email,$sent_status");
       
        // protected $redirectTo is using here, this is defined in this page up
         return redirect()->route('moderator.login')
        ->with([
            'ucreate' => $userCreate,
            'uname' => $user->name,
            'uemail' => $user->email,
            'emailstatus' => $sent_status,
            'session_msg' => 'on'
        ]); 
     
    }

     

    public function register(Request $request)
    {
         
        $this->ValidationCheck($request);  
       // $this->validator($request->all())->validate(); // this validate is blocked

        event(new Registered($user = $this->create($request->all())));
       
       // $this->guard('owner')->login($user); // after registration, user will log in 
     
        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
                     
    }


    protected function guard()
    {
        return Auth::guard('moderator');
    }
    protected function registered(Request $request, $user)
    {
        //
    }

    // user defined validation function
    
    private function ValidationCheck($request)
    {
       // dd( $request->EditableCountryId);
  
       $nameLength = 255;
       $emailLength = 255;
    
       $phoneLengthMin = 10;
       $phoneLengthMax = 11;
      
       $passwordMin = 8;

 
        $msgbox =[
           
            'nameRequired' => "Please enter your name.",
            'nameTypeRequiredString' => "Name should be string",
            'nameMaxLength' => "Name's length should not greater than $nameLength characters",
            
            'phoneLengthMin' => "Phone number's length should not less than  $phoneLengthMin characters",
            'phoneLengthMax' => "Phone number's length should not greater than $phoneLengthMax characters",

           
            'emailRequired' => "Please enter your email.",
            'emailRequiredTypeString' => "Email should be string",
            'emailFormat' => "Invalid email format.",
            'emailLength' => "Email's length should not greater than $emailLength characters",
            'emailUnique' => "Email already exist",

            'passwordRequired' => "Password is required",
            'passwordRequiredTypeString' => "Password type should be string",
            'passwordMin' => "Email's length should not less than $passwordMin characters",
            'passwordConfirmed' => "Password does not matches with confirmed password",
            
            'notiTypeRequired' => "Please select your notification type",
 
        ];
        
        
      
        $rules=[
             
            'name'  => "required|string|max:$nameLength",  
            'email'  => "required|string|email|max:$emailLength|unique:moderators",
            'password' => "required|string|min:$passwordMin|confirmed",
            'phone' => "nullable|min:$phoneLengthMin|max:$phoneLengthMax",
            'nid' => "required|numeric",
            'notiType' => "required",
            

        ];

        $custom_error_msg=[
            
           
            'name.required'  => $msgbox['nameRequired'], 
            'name.string'  => $msgbox['nameTypeRequiredString'], 
            'name.max'=>  $msgbox['nameMaxLength'], 

            'email.required'  => $msgbox['emailRequired'], 
            'email.string'  =>  $msgbox['emailRequiredTypeString'], 
            'email.email'  => $msgbox['emailFormat'],
            'email.max'=>  $msgbox['emailLength'],  
            'email.unique'=>   $msgbox['emailUnique'], 

            'password.required'  => $msgbox['passwordRequired'], 
            'password.string'  =>  $msgbox['passwordRequiredTypeString'], 
            'password.min'  => $msgbox['passwordMin'],  
            'password.confirmed'  => $msgbox['passwordConfirmed'], 
            
            'phone.min'=> $msgbox['phoneLengthMin'], 
            'phone.max'=> $msgbox['phoneLengthMax'], 

            'notiType.required'  => $msgbox['notiTypeRequired'], 
            
            
        ];
        
       
        $this->validate($request,$rules,$custom_error_msg);
      
      

    }

    
    // ajax works

    public function moderatorNotiTypeEmail(){
        $notitype = $_REQUEST['notitype'];
        return view('auth.ajax.moderatorAjaxResult',['option'=> 'email']);
    }
    public function moderatorNotiTypePhone(){
        $notitype = $_REQUEST['notitype'];
        return view('auth.ajax.moderatorAjaxResult',['option'=> 'phone']);
    }

    
     



}
