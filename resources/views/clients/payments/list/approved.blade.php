@extends('clients.master')

@section('page-title')
    <?php txt("Approved List"); ?>
@endsection

@section('title')
    <?php txt("Approved List"); ?>
@endsection

@section('middle-content')
@php //dd($payList); @endphp
<?php $GenInfoStatus =  GenInfoAlertUser(Auth::user()->id);  

?>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="panel tab-border ">
            
            <div class="panel-body">
                <div class="tab-content"> <!-----tab starts ---->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>                  
                                    <tr  >
                                    <th style="width: 10px">#</th>
                                    <th style="width: 100px">Year</th>
                                    <th style="width: 200px">Month</th>
                                    <th style="width: 200px">Amount</th>
                                    <th style="width: 200px">Pay Date</th>
                                
                                    </tr>
                                </thead>
                                <?php $i=0; ?>
                                @foreach($payList as $pay)
                                <tbody>
                                    <tr>
                                
                                    <td>{{ ++$i  }}</td>
                                    <td>{{  $pay->year  }}</td>
                                    <td>{{  $pay->month  }}</td>
                                    <td>{{  $pay->amount  }}</td>
                                    <td>{{  $pay->pay_date  }}</td>
                                    
                                    <td>
                                    <div class="btn-group">
                                       
                                        <button type="button" class="btn btn-primary btn-xs m-b-10 paymentDeatailsShowAjaxButton"  
                                                        data-toggle="modal" data-original-title="test" data-target="#paymentDeatailsShow" data-id="{{ $pay->id }}" 
                                                        data-viewtype ="pending"> 
                                                        Review Deatails       
                                        </button>

                                    </div>
                                    </td>
                                    </tr>
                                
                            
                                </tbody>
                                @endforeach
                            </table>
                            {{ $payList->links() }} 
                        </div>
                
                     
                </div><!---- tab ends --->
            </div>
        </div>
    </div>
    
</div>


<script>
//redirect to specific tab
    $(document).ready(function () {
    $('#tabMenu a[href="#{{ old('tab') }}"]').tab('show')
    });
</script>		


{{-- pending gen info show modal--}}
      <div class="modal fade" id="paymentDeatailsShow" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title f-w-600" id="exampleModalLabel">Client Details</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
               </div>
               <div class="modal-body-paymentDeatailsShow">                  
                    
               </div>
            </div>
         </div>
      </div>


@endsection



@section('js')
   @include('common.includes.commonJSModalPlusDataTable')
 
   {{--gen info show--}}
	<script type="text/javascript"> 
		$(document).ready(function() {
			$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
			// function starts
			$(".paymentDeatailsShowAjaxButton").click(function(){

                 
				var payment_id = $(this).data('id');
				var viewtype = $(this).data('viewtype');


				//alert("first value " + ownerId + "And second value is " + propertyId );
				$.ajax({
					method: "GET", // post does not work 
					url: "{{ url('payment/details/ajax') }}",
					data: {payment_id: payment_id, viewtype: viewtype},

					success:function(response){	
						$('.modal-body-paymentDeatailsShow').html(response); 			
						// $("div#CityResShow").html(result);
						$('#paymentDeatailsShow').modal('show'); 
						
					}
				});	

			});
		// function ends
		});
 
    </script>	
    


@endsection