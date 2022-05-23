<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;  // for sendFailedLoginResponse() function
use Auth;
class AdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }
    public function ShowLoginForm()
    {
        return view('auth.admin-login');
    }
    public function login(Request $request)
    {   
        // validate the form data
       $this->validate($request, [
           'email' =>    'required|email',
           'password' => 'required|min:6'
       ]);
       $credential = ['email' => $request->email, 'password' => $request->password];
       // attempt the user to log in
        if(Auth::guard('admin')->attempt($credential, $request->remeber))
        { 
            // if successful then redirect the user to their intended dashboad
            return redirect()->intended(route('admin.dashboard'));
        }
        //if unsucessful then redirect back to the log in with the form data
            return $this->sendFailedLoginResponse($request); 
            return redirect()->back()->withInput($request->only('email','remember'));

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
        Auth::guard('admin')->logout();
        return redirect('/');
    }



}
