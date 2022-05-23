@php  
//dd($userData);
$months =  monthList();
$years =  yearList();

@endphp 

<div class="col-sm-12">
    <div class="card card-topline-green">
        
        <div class="card-body " >
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

     

<script src="{{ asset('public/common/ajaxjquery') }}/jquery.min1.9.1.js"> </script>

<script>
 
 $(document).ready(function() {
     $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
     // function starts
     $("#yearWisePayments").click(function(){
              //alert('hey i am here');
         $.ajax({
             method: "GET",
             url: "{{ url('yearwise/payments') }}",
             data: "year="+$("#year_name").val(),
             success:function(result){				
                 $("div#yearWisePaymentsList").html(result);
             }
         });	

     });
     // function ends

 });

 

</script>




@include('common.iframe.css')
@include('common.iframe.js')
 