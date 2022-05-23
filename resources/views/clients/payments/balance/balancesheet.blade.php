@extends('clients.master')

@section('page-title')
    <?php txt("Balance Sheet"); ?>
@endsection

@section('title')
    <?php txt("Balance Sheet"); ?>
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
                    <div class="form-group row">
                        <label for="present_address" class="col-md-4 col-form-label text-md-right">{{ __('Select') }}</label>

                        <div class="col-md-6">
                            <div class="row g-0" >
                                
                
                                <div class="col-6 col-md-6"> 
                                <?php   selectoption("",'year_name',"form-control select2",'','year_name',$years,'year','year',"Year",''); ?>
                                @php isError($errors,'year_name') @endphp
                                </div>
                                
                                <div class="col-6 col-md-6">  
                                    <button type="submit" id="yearWisePayments" class="btn btn-success">
                                        {{ __('View Payments') }}
                                    </button>
                                </div>

                                <div class="col-3 col-md-3"> </div>
                            </div>
                    
                        </div>
                        

                    </div>

                    <div id="yearWisePaymentsList">
                        
                    </div>


                        
                        
    
                     
                </div>
                
            </div>
        </div>
        
    </div>



<script>
 
 $(document).ready(function() {
     $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
     // function starts
     $("#yearWisePayments").click(function(){
             // alert('hey i am here');
         $.ajax({
             method: "GET",
             url: "{{ url('client/yearwise/payments') }}",
             data: "year="+$("#year_name").val(),
             success:function(result){				
                 $("div#yearWisePaymentsList").html(result);
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