@extends('layouts.app')
@section('page-title')
Log-IN
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Customer Login') }}  | <a href="{{ route('register')}}">Are  you a new customer? Register</a></div>

                <div class="card-body">

                
                    <!---------------------------after registration success/fail message---->
                        <?php  
                        $ucreate = Session::get('ucreate');
                        $uname = Session::get('uname');
                        $uemail = Session::get('uemail');
                        $emailstatus = Session::get('emailstatus');
                        
                        $type = Session::get('type'); 
                        $msgType = Session::get('msgType'); 

                         

                        if($ucreate!='')
                        { 
                            if($ucreate=="success")
                            {
                                $class="success";
                                $msg="Registration is successful!";

                                if($emailstatus=="sent")
                                $msg.=" An authentication email has been sent to the registered 
                                email address $uemail with an activation link. 
                                Please click the link to activate your account।
                                ";
                                else
                                $msg.="<font color='red'>
                                Registration is successfull!But activation link sent failed. Please contact to administrator. 
                                </font>";
                            } 
                            else
                            { $class="danger";
                                $msg="Sorry! Registration is not successful! please try again।";
                            }
                        ?>
                            <div class="alert alert-<?php echo $class; ?>">

                          
                            {{ $msg }}  

                            </div>

                        
                        
                        <?php
                        }
                        ?>

                    <!---------------------------after registration success/fail message---->

                    <?php $type = Session::get('type'); ?>
                    <!-- /.login-logo -->
                    <?php if(!empty($type)) {?>
                        <div class="alert alert-{{  Session::get('type') }}">
                        {{ Session::get('activemessage')  }} 

                            @if($msgType == "successfully_activated")
                                    You have successfully activated the account। <br>
                                    welcome to <?php echo appname(); ?>! Please wait for admin approval for accessing your account!
                               
                            @endif
                            @if($msgType == "password_creation_success")
                                    You have successfully created your account password। Please Login with your email and password!
                               
                            @endif

                            @if($msgType == "account_not_activated")
                                    You have not activated your account yet. You must have received an email. Please click 
                                    the link sent in email, to activate your acount and set your password. <br>
                                   
                               
                            @endif
                            
                            @if($msgType == "account_activation_and_password_set_success")
                                    You have successfully created the account. Please log in using your credential.
                               
                            @endif

                            
                        </div>
                    <?php } ?>


                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"  value="{{ old('email') }}"  required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
