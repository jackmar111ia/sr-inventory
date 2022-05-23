<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
 
use Carbon\Carbon;


use Auth;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout','userLogout');
    }

    public function username()
    {
        return 'email';
    }



    public function userLogout()
    {
        Auth::guard('web')->logout();
        return redirect('/');
    }

    public function login(Request $request)
    {
        //dd($request->all());
        $user = User::where('email',$request->email)->first();

        if($user->email_verified == 1){
            
            if($user->password == "")
            {
                Session::put('customer_email', $user->email);
                session()->flash('type',"warning");
                session()->flash('activemessage',"successfully_activated");
                return redirect()->route("register");
        
            } 
           
        }else{
           
            Session::put('customer_email', $user->email);
            session()->flash('type',"warning");
            session()->flash('msgType',"account_not_activated");
            return redirect()->route("login");

        }
        // Check is password is set or not

        $this->validateLogin($request);
       
        
        
        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            //dd("After validation attempt login",$request->all());
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    protected function validateLogin(Request $request)
    {
      
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);  
    }

    protected function sendLoginResponse(Request $request)
    {
       
        
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        $user = User::where('email',$request->email)->first();

        if($user->email_verified == 1){
            
            if($user->password == "")
            {
                Session::put('customer_email', $user->email);
                session()->flash('type',"warning");
                session()->flash('activemessage',"successfully_activated");
                return redirect()->route("register");
        
            }else{
                return $this->authenticated($request, $this->guard()->user())
                ?: redirect()->intended($this->redirectPath());
            }
     
           
        }else{
           
            Session::put('customer_email', $user->email);
            session()->flash('type',"warning");
            session()->flash('msgType',"account_not_activated");
            return redirect()->route("login");

        }
       

    }




    // ajax works

    public function clientNotiTypeEmail(){
        $notitype = $_REQUEST['notitype'];
        return view('auth.ajax.clientAjaxResult',['option'=> 'email']);
    }
    public function clientNotiTypePhone(){
        $notitype = $_REQUEST['notitype'];
        return view('auth.ajax.clientAjaxResult',['option'=> 'phone']);
    }

    public function unameCheck(){
        $username = $_REQUEST['username'];
        echo $username; echo "<i  class='fa fa-pencil' aria-hidden='true'></i> Available";
    }

   

}
