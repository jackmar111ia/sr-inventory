@extends('layouts.app')

@section('page-title')
{{ __('Moderator Registration') }}
@endsection

@section('content')

<!---- datepicker element --->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/SyntaxHighlighter/3.0.83/styles/shCoreDefault.min.css" />
<link rel="stylesheet" href="{{ asset('common') }}/datepicker/dist/css/default/zebra_datepicker.min.css" type="text/css">
<!---- datepicker element --->


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Moderator Registration') }} | <a href="{{ route('moderator.login')}}">Login</a> </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('moderator.register.save') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus>

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
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Ex: abc@xyz.com"  autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <small  class="form-text text-muted">Please use an active email. Because you need to verify the email after a successful registration.</small>
                            </div>
                        </div>
                         
                        <div class="form-group row">
                            <label for="notiType" class="col-md-4 col-form-label text-md-right">{{ __('Notification Type') }}</label>

                            <div class="col-md-6" style="margin-top:5px">
                                <input id="notiTypeEmail" type="radio" class=" @error('notiType') is-invalid @enderror" name="notiType" value="email" <?php if(old('notiType') == "email") { ?>checked<?php } ?> required> Email
                                <input id="notiTypePhone" type="radio" class=" @error('notiType') is-invalid @enderror" name="notiType" value="phone" <?php if(old('notiType') == "phone") { ?>checked<?php } ?> required> Phone
                                @error('notiType')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <br>
                                <div id="notitypeResult">
                                @if(!empty(old('notiType')))
                                    @if(old('notiType') == "phone")
                                        <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">
                                             @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror 
                                    @else
                                  <font color='green'>Your registered email address will be used for notification.</font>
                                    <input  type="hidden"  name="phone" value="">
                                    @endif
                                @endif

                                </div>
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

                        <div class="form-group row">
                            <label for="present_address" class="col-md-4 col-form-label text-md-right">{{ __('Present address') }}</label>

                            <div class="col-md-6">
                                <textarea id="present_address"   class="form-control @error('present_address') is-invalid @enderror" name="present_address"    autocomplete="present_address"><?php echo old('present_address');?></textarea>
                                @error('present_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="permanent_address" class="col-md-4 col-form-label text-md-right">{{ __('Permanent address') }}</label>

                            <div class="col-md-6">
                                <textarea id="permanent_address"   class="form-control @error('permanent_address') is-invalid @enderror" name="permanent_address"   required autocomplete="permanent_address"><?php echo old('permanent_address');?></textarea>
                                @error('permanent_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password"  value="12345678" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

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
                                <input id="password-confirm" value="12345678" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
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
                url: "{{ url('moderator/notitypeEmail') }}",
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
                url: "{{ url('moderator/notiTypePhone') }}",
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
