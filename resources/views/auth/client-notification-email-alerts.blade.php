 
@extends('layouts.app')

<?php $callingPageName = "owner_activation_check";  ?>

@section('page-title')
{{ __('lang.Email Activation Check') }}
@endsection

@section('title')
{{ __('lang.Email Activation Check') }}
@endsection

@section('content')
 <?php //dd("$status,$"); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Client account activation verification</div>
                    <div class="card-body">
                        @if($status=="not_active")
                            @if($emailstatus!='')

                                @if($emailstatus=='sent')
                                    <div class="alert alert-success">
                                        An activation email has been sent to your email {{ $user->email }}.
                                        Please follow the link and activate your <?php echo appname(); ?> owner account! 
                                </div>
                                @else
                                    <div class="alert alert-danger">
                                        Sorry! Link send problem . Please try again!
                                    </div>
                                @endif

                            @endif


                            <div class="alert alert-warning">
                            Please check your verification e-mail before continuing. Click the link to get for another one, if you have not received any activation link yet.
                            </div>             

                            {!! Form::open(['url' => 'activation-link/resend','mothod'=>'post', 'role'=>'form']) !!}
                                @csrf
                            <button type="submit" class="btn btn-success">{{ __('click here to request another') }}</button>.
                            <input type="hidden" readonly value="<?php echo $user->id; ?>" name="id">
                            {!! Form::close() !!}
                        @endif
                    </div>
            </div>
        </div>
    </div>
</div>

@endsection
