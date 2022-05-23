@extends('clients.master')

@section('page-title')
    <?php txt("Payment Edit"); ?>
@endsection

@section('title')
    <?php txt("Payment Edit"); ?>
@endsection

@section('css')
@include('common.includes.datePickerCSS')
@endsection

@section('middle-content')

   
@php
        $months =  monthList();
       
        $years =  yearList();
@endphp


 <!--bootstrap -->
 <link href="{{ asset('backends') }}/assets/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
    <link href="{{ asset('backends') }}/assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css" rel="stylesheet" media="screen">
    <!-- Material Design Lite CSS -->                          
                 
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="panel tab-border ">
                
                <div class="panel-body">

                    @if(session('success'))
                        <div class="alert alert-success">
                        {{ session('success') }}
                        </div> 
                    @endif

                    <form method="POST" action="{{ route('client.payments.edit.save') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <?php  inputfield("","text","name","form-control",'name',$clientInfo->name,'',"Your name",'','',"","readonly,'','','',$errors");   ?>
                                @php isError($errors,'name') @endphp
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="nid" class="col-md-4 col-form-label text-md-right">{{ __('Apartment') }}</label>

                            <div class="col-md-6">
                                <?php  inputfield("","text","nid","form-control",'nid',$clientInfo->apartment_id,'',"Your NID",'','',"","readonly,'','','',$errors");   ?>
                                @php isError($errors,'nid') @endphp
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nid" class="col-md-4 col-form-label text-md-right">{{ __('Amount') }}</label>

                            <div class="col-md-6">
                                <?php  inputfield("","text","amount","form-control",'amount',$payInfo->amount,'',"Ex: 30000",'','',"","'','','',$errors");   ?>
                                @php isError($errors,'amount') @endphp
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="Date of deed" class="col-md-4 col-form-label text-md-right">{{ __('Pay date') }}</label>

                             
                                <div class="input-group date form_date col-4 col-md-4" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                    <?php inputfield("","text","pay_date","form-control",'pay_date',$payInfo->pay_date,'pay_date',"yyyy-mm-dd",'','',"required","'','',off");  //,"'',disabled,off"?>
                                    <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                </div>
                                <br>
                                @php isError($errors,'pay_date') @endphp
                             
                        </div>

                        

 

                        <div class="form-group row">
                            <label for="present_address" class="col-md-4 col-form-label text-md-right">{{ __('Select') }}</label>

                            <div class="col-md-6">
                                <div class="row g-0" >
                                    
                    
                                    <div class="col-6 col-md-6"> 
                                    <?php   selectoption("",'year_name',"form-control select2",$payInfo->year,'year_name',$years,'year','year',"Year",''); ?>
                                    @php isError($errors,'year_name') @endphp
                                    </div>
                                    
                                    <div class="col-6 col-md-6">  
                                    <?php   selectoption("",'month_name',"form-control select2",$payInfo->month,'month_name',$months,'month','month',"Month",''); ?>
                                    @php isError($errors,'month_name') @endphp
                                    </div>

                                    <div class="col-3 col-md-3"> </div>
                                </div>
                        
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="permanent_address" class="col-md-4 col-form-label text-md-right">{{ __('Note [if any]') }}</label>

                            <div class="col-md-6">
                                <?php textareaBox("","note_user",'','','Please write if you have any additional message','','',$payInfo->note_user,'',''); ?>
                               
                            </div>
                        </div>

                        

                    

                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Submit Payment') }}
                                </button>
                                <input type="hidden" name="opType" value="edit">
                                <input type="hidden" name="editId" value="{{$payInfo->id}}">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>




@endsection
@section('js')
@include('common.includes.datePickerJs')
@endsection