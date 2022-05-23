@php 
 //dd($userData);
 //dd($payInfo);
 $months =  monthList();
$years =  yearList();
@endphp 
@include('common.iframe.css')
<?php /* 
 user id  = {{ $userData->id }} <br>
 User Name  = {{ $userData->name }} 

*/ ?>
 
<div class="col-sm-12">
    <div class="card card-topline-green">
        
        <div class="card-body " >
            <div class="table-scrollable">
                
                @if(session('success'))
                    <div class="alert alert-success">
                    {{ session('success') }}
                    </div> 
                @endif

                <form method="POST" action="{{ route('iframe.pending..payments.update.save') }}">
                    @csrf

                    
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Notification Type') }}</label>

                        <div class="col-md-6">
                            @if($payInfo->client->notiType  == "email")
                                @php small_label("danger","Email");  @endphp
                            
                            @else
                                @php  small_label("success","Phone");  @endphp
                            
                            @endif 
                        </div>
                    </div>

                                        
                        

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                        <div class="col-md-6">
                            <?php  inputfield("","text","name","form-control",'name',$payInfo->client->name,'',"Your name",'','',"","readonly,'','','',$errors");   ?>
                            @php isError($errors,'name') @endphp
                        </div>
                    </div>

                    
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                        <div class="col-md-6">
                            <?php  inputfield("","text","name","form-control",'name',$payInfo->client->phone,'',"Your name",'','',"","readonly,'','','',$errors");   ?>
                            @php isError($errors,'name') @endphp
                        </div>
                    </div>



                    
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                        <div class="col-md-6">
                            <?php  inputfield("","text","name","form-control",'name',$payInfo->client->email,'',"Your name",'','',"","readonly,'','','',$errors");   ?>
                            @php isError($errors,'name') @endphp
                        </div>
                    </div>


                    
                    <div class="form-group row">
                        <label for="nid" class="col-md-4 col-form-label text-md-right">{{ __('Apartment') }}</label>

                        <div class="col-md-6">
                            <?php  inputfield("","text","nid","form-control",'nid',$payInfo->client->apartment_id,'',"Your NID",'','',"","readonly,'','','',$errors");   ?>
                            @php isError($errors,'nid') @endphp
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="nid" class="col-md-4 col-form-label text-md-right">{{ __('Amount') }}</label>

                        <div class="col-md-6">
                            <?php  inputfield("","readonly","amount","form-control",'amount',$payInfo->amount,'',"Ex: 30000",'','',"","readonly,'','','',$errors");   ?>
                            @php isError($errors,'amount') @endphp
                        </div>
                    </div>

                    
                    <div class="form-group row">
                        <label for="nid" class="col-md-4 col-form-label text-md-right">{{ __('Pay Date') }}</label>

                        <div class="col-md-6">
                            <?php  inputfield("","readonly","amount","form-control",'amount',$payInfo->pay_date,'',"Ex: 30000",'','',"","readonly,'','','',$errors");   ?>
                            @php isError($errors,'amount') @endphp
                        </div>
                    </div>

                    



                    <div class="form-group row">
                        <label for="present_address" class="col-md-4 col-form-label text-md-right">{{ __('Year/Month') }}</label>

                        <div class="col-md-6">
                            <div class="row g-0" >
                                
                
                                <div class="col-6 col-md-6"> 
                                <?php  inputfield("","readonly","amount","form-control",'amount',$payInfo->year,'',"Ex: 30000",'','',"","readonly,'','','',$errors");   ?>                                    @php isError($errors,'year_name') @endphp
                                </div>
                                
                                <div class="col-6 col-md-6">  
                                <?php  inputfield("","readonly","amount","form-control",'amount',$payInfo->month,'',"Ex: 30000",'','',"","readonly,'','','',$errors");   ?>                                    @php isError($errors,'month_name') @endphp
                                </div>

                                <div class="col-3 col-md-3"> </div>
                            </div>
                    
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nid" class="col-md-4 col-form-label text-md-right">{{ __('User Note') }}</label>

                        <div class="col-md-6">
                            <textarea  class="form-control" disabled>{{ $payInfo->note_user }}</textarea>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="permanent_address" class="col-md-4 col-form-label text-md-right">{{ __('Update user note [if any]') }}</label>

                        <div class="col-md-6">
                            <?php textareaBox("","note_approved_user",'','','Please write if you have any additional message','','','','',''); ?>
                            
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="permanent_address" class="col-md-4 col-form-label text-md-right"> </label>

                        <div class="col-md-6">
                            <input type="radio" value="Approved" name="updateType" required> Approve
                            <input type="radio" value="Declined" name="updateType"> Decline
                        </div>
                    </div>

                    
                        
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-success" onclick="return confirmToUpdatePaymentStatus()">
                                {{ __('Submit Payment') }}
                            </button>
                            <input type="hidden" name="updatedUserRole" value="{{ $userData->role }}">
                            <input type="hidden" name="updatedUserId" value="{{ $userData->id }}">
                            <input type="hidden" name="pay_id" value="{{ $payInfo->id }}">
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>

    
 
    
    @include('common.iframe.js')

@include('clients.payments.modalForDetails')
<script  type="text/javascript">  
    function confirmToUpdatePaymentStatus()
    {
        var agree=confirm("Do you really want to proceed?");
        if(agree)
        return true;
        else
        return false;
    }
</script> 