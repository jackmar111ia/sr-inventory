@extends('layouts.app')

@section('page-title')
{{ __('User Registration | OTP Validate') }}
@endsection

@section('content')

<!---------------------------after registration success/fail message---->
<?php  
       
       $ucreate = Session::get('webucreate');
       $uname = Session::get('webuname');
       $phone = Session::get('webuphone');
       $otpStatus = Session::get('uotpstatus');
      
       if($ucreate!='')
       { 
           if($ucreate == "success")
           {
               $class="success";
               $msg="Dear $uname, Registration is successful!
               Welcome to ".appname().". ";

               if($otpStatus=="sent")
               $msg.="An one time password (OTP) has been sent to the registered 
               phone number $phone. 
               Please check your phone and submit the OTP to acctivate your account.
               ";
               else
               $msg.="<font color='red'>
               But there is some problem to send the otp. Please try the link again for retrieving OTP.
               </font>";
           } 
           else if($ucreate == "retry"){
               $class="success";
               $msg="Check your registered phone number and enter the OTP to activate your account.";
           }
           else
           { $class="danger";
               $msg="Sorry! Registration is not successful! please try again।";
           }
           ?>
            
       
   <?php } ?>

<!---------------------------after registration success/fail message---->

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                    <div class="card-header">{{ __('User registration') }} |  OTP validate</div>
                    <div class="form-group row" style="padding:10px">
                        <div class="col-md-12">
                            <article class="image-box hotel listing-style1">
                            @if($ucreate!='')
                            

                                <div class="alert alert-<?php echo $class; ?>">
                                    {{ $msg }}  
                                </div>

                                <?php $type = Session::get('type'); ?>
                                <!-- /.login-logo -->
                                <?php if(!empty($type)) {?>
                                    <div class="alert alert-{{  Session::get('type') }}">
                                    {{ Session::get('activemessage')  }} 
                                    </div>
                                <?php } ?>




                                <div class="details" style=" padding:5px">
                                    
                                    <div class="row justify-content-center">
                                            <div class="col-md-10">
                                                
                                                    
                                                    <form method="POST" action="{{ route('user.registration.otp.submit') }}">
                                                        @csrf
                                                        <div class="form-group row">
                                                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Enter OTP') }}</label>

                                                            <div class="col-md-6">
                                                                <input id="otp" type="text" class="form-control @error('otp') is-invalid @enderror" name="otp" required autocomplete="off">
                                                                <input type="hidden" name="phone" value="<?php echo $phone; ?>">
                                                                @error('otp')
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

                                                        



                                                        <div class="form-group row mb-0">
                                                            <div class="col-md-8 offset-md-4">
                                                                <button type="submit" class="btn btn-primary">
                                                                    {{ __('Submit OTP') }} 
                                                                </button>

                                                            
                                                            </div>
                                                        </div>
                                                    </form>
                                               
                                            </div>
                                    </div>
                                </div>
                            @else
                            <div class="alert alert-danger">
                                Wrong access!
                            </div>
                            @endif
                            </article>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>

    
 

@endsection
