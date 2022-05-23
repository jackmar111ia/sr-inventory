@extends('moderator.master')

@section('page-title')
    <?php txt("Account Info Update"); ?>
@endsection

@section('title')
    <?php txt("Account Info Update"); ?>
@endsection

@section('middle-content')
<?php $GenInfoStatus =  GenInfoAlert(Auth::user()->id);  //echo $GenInfoStatus; ?>
@if(($GenInfoStatus == "open") OR ($GenInfoStatus == "saved"))
                           
                 
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="panel tab-border ">
                
                <div class="panel-body">
                    <form method="POST" action="{{ route('moderator.settings.accountinfo.update.save') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <?php  inputfield("","text","name","form-control",'name',$moderatorInfo->name,'',"Your name",'','',"","'','','',$errors");   ?>
                                @php isError($errors,'name') @endphp
                            </div>
                        </div>


                        
                        <?php /*  
                        <div class="form-group row">
                            <label for="notiType" class="col-md-4 col-form-label text-md-right">{{ __('Notification Type') }}</label>

                            <div class="col-md-6" style="margin-top:5px">
                                <input id="notiTypeEmail" type="radio" class=" @error('notiType') is-invalid @enderror" name="notiType" value="email" <?php if((old('notiType') == "email") OR ($moderatorInfo->notiType == "email")) { ?>checked<?php } ?> required> Email
                                <input id="notiTypePhone" type="radio" class=" @error('notiType') is-invalid @enderror" name="notiType" value="phone" <?php if((old('notiType') == "phone") OR ($moderatorInfo->notiType == "phone")) { ?>checked<?php } ?> required> Phone
                                @error('notiType')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <br>
                                <div id="notitypeResult">
                                
                                    @if((old('notiType') == "phone") OR ($moderatorInfo->notiType == "phone"))
                                        <?php  inputfield("","text","phone","form-control",'nid',$moderatorInfo->phone,'',"Your phone",'','',"","'','','',$errors");   ?>
                                        @php isError($errors,'phone') @endphp
                                    @else
                                    <font color='green'>Your registered email address will be used for notification.</font>
                                    <input  type="hidden"  name="phone" value="">
                                    @endif
                            

                                </div>
                            </div>
                        </div>
                        */?>
                        

                        <div class="form-group row">
                            <label for="nid" class="col-md-4 col-form-label text-md-right">{{ __('NID') }}</label>

                            <div class="col-md-6">
                                <?php  inputfield("","text","nid","form-control",'nid',$moderatorInfo->nid,'',"Your NID",'','',"","'','','',$errors");   ?>
                                @php isError($errors,'nid') @endphp
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="present_address" class="col-md-4 col-form-label text-md-right">{{ __('Present address') }}</label>

                            <div class="col-md-6">
                                <?php textareaBox("","present_address",'','','Enter present address','','',$moderatorInfo->present_address,'',''); ?>
                                @php isError($errors,'present_address') @endphp
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="permanent_address" class="col-md-4 col-form-label text-md-right">{{ __('Permanent address') }}</label>

                            <div class="col-md-6">
                                <?php textareaBox("","permanent_address",'','','Enter permanent address','','',$moderatorInfo->permanent_address,'',''); ?>
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
@php  redirectTab("moderator.settings.accounts.property","updateViewGeneralInfo");   @endphp

@endif

 

@endsection