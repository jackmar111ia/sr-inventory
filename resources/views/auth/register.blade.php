@extends('layouts.app')

@section('page-title')
{{ __('Client Registration') }}
@endsection

@section('content')

<!---- datepicker element --->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/SyntaxHighlighter/3.0.83/styles/shCoreDefault.min.css" />
<link rel="stylesheet" href="{{ asset('common') }}/datepicker/dist/css/default/zebra_datepicker.min.css" type="text/css">
<!---- datepicker element --->
    @php
        $email = Session::get('customer_email');
        if($email == ''){
            header("Location: " . URL::to('/login'), true, 302);
        exit();
        } 
        //return redirect()->route('login');

        
        $userInfo = userInfo($email);
        //dd($userInfo);
    @endphp

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Customer Registration') }} | <a href="{{ route('login')}}">Login</a> </div>
 
                <div class="card-body">

                    <?php $type = Session::get('type'); $activemessage = Session::get('activemessage'); ?>
                    <!-- /.login-logo -->
                    <?php if(!empty($type)) {?>
                        <div class="alert alert-{{  Session::get('type') }}">
                        

                            @if($activemessage == "successfully_activated")
                                    You have successfully validated your email। <br>
                                    Now please complete the registration with new password and your existing SR account info !
                               
                            @endif
                            
                        </div>
                    <?php } ?>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"   value="{{$userInfo->name}}"  readonly required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"  value="{{$userInfo->email}}" readonly  placeholder="Ex: abc@xyz.com"  autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                 
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('User Name') }}</label>

                            <div class="col-md-6">
                                <input    class="form-control @error('user_name') is-invalid @enderror" name="user_name"  value="{{$userInfo->user_name}}"  readonly    autocomplete="user_name">
 
                            </div>
                        </div>
                         
                         


                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-md-12">

                                    <div class="input-group mb-3">
                                         
                                        <input id="phone" readonly type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"  value="{{$userInfo->phone}}" required autocomplete="phone"  >
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror 
                                    </div>

                                    </div>
                                    <div class="col-md-4">
                                        <?php /* <input value="Check" type="button" id="unamecheck" class="btn btn-success"> */?>
                                    </div>
                                </div>
                               
                            </div>  
                        </div>


                       

                        <?php /*
                        <div class="form-group row">
                            <label for="date_of_deed" class="col-md-4 col-form-label text-md-right">{{ __('Date of Deed') }}</label>

                            <div class="col-md-6">
                                <input id="datepicker" type="text"  data-zdp_readonly_element="false" class="form-control @error('date_of_deed') is-invalid @enderror" name="date_of_deed" value="{{ old('date_of_deed') }}" required autocomplete="date_of_deed">
                                
                                @error('date_of_deed')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nid" class="col-md-4 col-form-label text-md-right">{{ __('NID') }}</label>

                            <div class="col-md-6">
                                <input id="nid" type="text" class="form-control @error('nid') is-invalid @enderror" name="nid" value="{{ old('nid') }}" required autocomplete="nid">

                                @error('nid')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        */?>

                       

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password"  value="" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm"  class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" value="" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('public/common/ajaxjquery') }}/jquery.min1.9.1.js"> </script>
 


<script>
 
    $(document).ready(function() {
        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
        // function starts
        $("#notiTypeEmail").click(function(){
                // alert('hey i am here');
            $.ajax({
                method: "GET",
                url: "{{ url('client/notitypeEmail') }}",
               // data: "cityid="+$("#cityid").val()+"&selectedCityId="+$("#selectedCityId").val(),
                data: "notitype="+$("#notiTypeEmail").val(),
                success:function(result){				
                    $("div#notitypeResult").html(result);
                }
            });	

        });
        // function ends

         // function starts
         $("#notiTypePhone").click(function(){
                // alert('hey i am here');
            $.ajax({
                method: "GET",
                url: "{{ url('client/notiTypePhone') }}",
               // data: "cityid="+$("#cityid").val()+"&selectedCityId="+$("#selectedCityId").val(),
                data: "notitype="+$("#notiTypePhone").val(),
                success:function(result){				
                    $("div#notitypeResult").html(result);
                }
            });	

        });
        // function ends


    });
 
</script>



<script>
 
    $(document).ready(function() {
        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
        // function starts
        $("#phone").click(function(){
                // alert('hey i am here');
            $.ajax({
                method: "GET",
                url: "{{ url('client/unamecheck') }}",
                data: "username="+$("#phone").val(),
                success:function(result){				
                    $("div#usernameResult").html(result);
                }
            });	

        });
        // function ends

    });

    
 
</script>


        
 
    <!---- datepicker element --->
    <script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/zebra_pin@2.0.0/dist/zebra_pin.min.js"></script>
    <script src="{{ asset('common') }}/datepicker/dist/zebra_datepicker.min.js"></script>
    <script src="{{ asset('common') }}/datepicker/examples.js"></script>
    <!---- datepicker element --->
@endsection
