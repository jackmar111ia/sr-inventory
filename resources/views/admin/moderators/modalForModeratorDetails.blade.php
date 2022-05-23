{{-- pending gen info show modal--}}
      <div class="modal fade" id="moderatorDeatailsShow" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title f-w-600" id="exampleModalLabel">Moderator Details</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
               </div>
               <div class="modal-body-moderatorDeatailsShow">                  
                    
               </div>
            </div>
         </div>
      </div>

    {{--gen info show--}}
	<script type="text/javascript"> 
		$(document).ready(function() {
			$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
			// function starts
			$(".moderatorDeatailsShowAjaxButton").click(function(){

                 
				var moderator_id = $(this).data('id');
				var viewtype = $(this).data('viewtype');


				// alert("first value " + moderator_id );
				$.ajax({
					method: "GET", // post does not work 
					url: "{{ url('moderator/details/ajax') }}",
					data: {moderator_id: moderator_id, viewtype: viewtype},

					success:function(response){	
						$('.modal-body-moderatorDeatailsShow').html(response); 			
						// $("div#CityResShow").html(result);
						$('#moderatorDeatailsShow').modal('show'); 
						
					}
				});	

			});
		// function ends
		});
 
    </script>	
    

