@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8"  >
            <div class="card">
                <div class="card-header">{{ __('Login') }} | <a href="{{ route('register')}}">Are  you a new customer ? Register</a></div>

                    <div class="details" style=" padding:10px">
                        <?php
                            $type = Session::get('type'); 
                            $msgType = Session::get('msgType'); 
                            $email = Session::get('email'); 
                            $activemessage =  Session::get('activemessage'); 

                            $additionalMsg =''; //$activemessage = ''; 
                            ?>
                            <!-- /.login-logo -->
                            <?php if(!empty($type)) {?>
                            <div class="alert alert-<?php echo $type; ?>">
                                <?php echo $activemessage; ?>
                                @if($msgType == "block")
                                    Your account is temporarily blocked.<br>
                                    <a href = "{{ route('contact.admin')}}"> <b><u>Contact to administrator</u></b></a>

                                @elseif($msgType == "approval_pending")
                                Your have successfully activated the account.But admin did not approve your account yet. 
                                Please wait for admin approval.<br>
                                <a href = "{{ route('contact.admin')}}"> <b><u>Contact to administrator</u></b></a>

                                
                                @elseif($msgType == "account_created_phone_validated_but_noti_email_verify_pending")
                                
                                A validation email has been sent to the  
                                email address at {{  $email }} with a validation link. 
                                Please enter your email and click on the sent link to validate your email address so that you can get notification alert.
                               <br>
                                <b>If you have not received any validation email yet,
                                
                                 <a href='{{ url("activation/check/$email") }}'>please follow the link to get the link.</a>
                                </b>

                                @elseif($msgType == "account_created_but_account_not_validated")

                                    You have successfully registerd! But your account is not activated.<br>
                                    Please submit the OTP sent on your registered mobile number and activate the account.<br>
                                        @php 
                                            $phone = Session::get('nonValidatedPhone');
                                            $cnt = otpCount();
                                            $userOtpLimit = userRegiOtpLimit();
                                        @endphp
                                        <a href = "{{ route('user.registration.otp.reverify')}}" style=" color:red"> <b><u>If you have received the OTP, then Click the link to submit OTP</u></b></a>
                                        
                                        <br> 
                                        @if($cnt < $userOtpLimit)
                                            OR <br>
                                            If you have not received the OTP <a href = "{{ route('user.registration.otp.request')}}" class = "btn btn-danger">  Request for another OTP</a>
                                        @else
                                            @php 
                                            echo "<font color='#333'>You have already received $userOtpLimit OTP.</font>";
                                            @endphp
                                            <a href="{{ route('contact.admin') }}"><font color='#333'><b><u>Please contact to Administration.</u></b></font></a>
                                        @endif

                                @elseif($msgType == "already_activated")
                                    You have already activated your account. Please log in!
                                
                                @elseif($msgType == "successfully_activated")
                                    You have successfully activated the account। <br>
                                    welcome to <?php echo appname(); ?>! Please wait for admin approval for accessing your account!
                                    
                                @elseif($msgType == "no_account")
                                No account found with this phone number। <br>

                                @elseif($msgType == "password_changed")
                                You have successfully changed your password। <br>

                                @elseif($msgType == "no_otp")
                                No valid OTO। <br>
                                
                                @endif
                            
                            </div> 
                            
                        <?php } ?>


                  

                      
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                                
                            <div class="form-group row">
                                <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                                <div class="col-md-6">

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">+88</span>
                                        </div>
                                        <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" <?php /* value="{{ old('phone') }}" */ ?> value="01537379613" required autocomplete="off" autofocus>
                                            @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="12345678" required autocomplete="current-password">

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
                                        
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="terms_and_con" class="col-md-4 col-form-label text-md-right">&nbsp;</label>

                                <div class="col-md-6">
                                    <div class="checkbox">
                                        <label class="form-check-label" for="remember">
                                            
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>            
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
                                        <?php /* <a class="btn btn-link" href="{{ route('user.password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>*/ ?>
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
