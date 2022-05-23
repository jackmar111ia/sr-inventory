@extends('clients.master')

@section('page-title')
    <?php txt("Account Info Update"); ?>
@endsection

@section('title')
    <?php txt("Account Info Update"); ?>
@endsection

@section('css')
@include('common.includes.datePickerCSS')
@endsection

@section('middle-content')

   

<?php $GenInfoStatus =  GenInfoAlertUser(Auth::user()->id);    ?>
@if(($GenInfoStatus == "open") OR ($GenInfoStatus == "saved"))
 <!--bootstrap -->
 <link href="{{ asset('backends') }}/assets/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
    <link href="{{ asset('backends') }}/assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css" rel="stylesheet" media="screen">
    <!-- Material Design Lite CSS -->                          
                 
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="panel tab-border ">
                
                <div class="panel-body">
                    <form method="POST" action="{{ route('client.settings.accountinfo.update.save') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <?php  inputfield("","text","name","form-control",'name',$clientInfo->name,'',"Your name",'','',"","'','','',$errors");   ?>
                                @php isError($errors,'name') @endphp
                            </div>
                        </div>


                        
                        <?php /*
                        <div class="form-group row">
                            <label for="notiType" class="col-md-4 col-form-label text-md-right">{{ __('Notification Type') }}</label>

                            <div class="col-md-6" style="margin-top:5px">
                                <input id="notiTypeEmail" type="radio" class=" @error('notiType') is-invalid @enderror" name="notiType" value="email" <?php if((old('notiType') == "email") OR ($clientInfo->notiType == "email")) { ?>checked<?php } ?> required> Email
                                <input id="notiTypePhone" type="radio" class=" @error('notiType') is-invalid @enderror" name="notiType" value="phone" <?php if((old('notiType') == "phone") OR ($clientInfo->notiType == "phone")) { ?>checked<?php } ?> required> Phone
                                @error('notiType')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <br>
                               
                                <div id="notitypeResult">
                                
                                    @if((old('notiType') == "email") OR ($clientInfo->notiType == "email"))
                                        <?php  inputfield("","text","email","form-control",'nid',$clientInfo->email,'',"Your notifiable email",'','',"","'','','',$errors");   ?>
                                        @php isError($errors,'phone') @endphp
                                    @else
                                    <font color='green'>Your registered phone number will be used for notification.</font>
                                  
                                    @endif
                            

                                </div>
                            </div>
                        </div>
                        */ ?>
                        
                        

                        <div class="form-group row">
                            <label for="nid" class="col-md-4 col-form-label text-md-right">{{ __('NID') }}</label>

                            <div class="col-md-6">
                                <?php  inputfield("","text","nid","form-control",'nid',$clientInfo->nid,'',"Your NID",'','',"","'','','',$errors");   ?>
                                @php isError($errors,'nid') @endphp
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Date of deed" class="col-md-4 col-form-label text-md-right">{{ __('Date of deed') }}</label>
                                    
                             
                                <div class="input-group date form_date col-4 col-md-4" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                    <?php inputfield("","text","date_of_deed","form-control",'date_of_deed',$clientInfo->date_of_deed,'startDate',"yyyy-mm-dd",'','',"required","'','',off");  //,"'',disabled,off"?>
                                    <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                </div>
                             
                        </div>
 

                        <div class="form-group row">
                            <label for="present_address" class="col-md-4 col-form-label text-md-right">{{ __('Present address') }}</label>

                            <div class="col-md-6">
                                <?php textareaBox("","present_address",'','','Enter present address','','',$clientInfo->present_address,'',''); ?>
                                @php isError($errors,'present_address') @endphp
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="permanent_address" class="col-md-4 col-form-label text-md-right">{{ __('Permanent address') }}</label>

                            <div class="col-md-6">
                                <?php textareaBox("","permanent_address",'','','Enter permanent address','','',$clientInfo->permanent_address,'',''); ?>
                                @php isError($errors,'permanent_address') @endphp
                            </div>
                        </div>

                        

                    

                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
@else
@php  redirectTab("client.settings.accounts","updateViewGeneralInfo");   @endphp

@endif

 


<script>
 
    $(document).ready(function() {
        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
        // function starts
        $("#notiTypeEmail").click(function(){
                // alert('hey i am here');
            $.ajax({
                method: "GET",
                url: "{{ url('client/info-update/notitypeEmail') }}",
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
                url: "{{ url('client/info-update/notitypePhone') }}",
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

 



@endsection
@section('js')
@include('common.includes.datePickerJs')
@endsection