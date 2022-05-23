@if($optype == "yearwise")
 
    @php  
    $months =  monthList(); 
   // dd($client_id);
    @endphp

    <div class="table-bordered">
        <table class="table">
            <tbody>
                <tr>
                <?php foreach($months as $singlemonth){  ?>
                    <td> {{ $singlemonth->month }}</td>
                <?php } ?>
                </tr>
                <tr>
                <?php $i = 0; foreach($months as $singlemonth){ 
                    //SELECT SUM(amount) FROM `payments` WHERE `year` = 2020 AND MONTH = 'January'
                    $month = $singlemonth->month;
                    ?>
                    @php 
                    $amount = App\Models\user\Payment::where('year',$year)->where('month',$month)->where('approval_status','Approved')->where('client_id',$client_id)->sum('amount');
                    @endphp
                    <td> 
                        @if($amount > 0)
                        <button type="button" class="btn btn-success" id="ShowPaymentsDetails<?php echo $i; ?>">
                        {{ $amount }}
                        </button> 
                        <input type="hidden" id="year<?php echo $i; ?>" value="{{ $year }}">
                        <input type="hidden" id="month<?php echo $i; ?>" value="{{ $month }}">
                        <input type="hidden" id="client_id<?php echo $i; ?>" value="{{ $client_id }}">
                        @endif
                    </td>

                    
                <script>
                
                $(document).ready(function() {
                    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
                    // function starts
                    $("#ShowPaymentsDetails<?php echo $i; ?>").click(function(){
                            // alert('hey i am here');
                        $.ajax({
                            method: "GET",
                            url: "{{ url('yearwise/monthwise/payments') }}",
                            data: "year="+$("#year<?php echo $i; ?>").val()+"&month="+$("#month<?php echo $i; ?>").val()+"&client_id="+$("#client_id<?php echo $i; ?>").val(),
                            success:function(result){				
                                $("div#ShowPaymentsDetailsResult").html(result);
                            }
                        });	

                    });
                    // function ends

                });

                

                </script>



                <?php $i = $i + 1; } ?>
                </tr>

            </tbody>
            
        </table>
                    
    </div>
    <div id="ShowPaymentsDetailsResult"> </div>
 
@endif

@if($optype == "yearMonthWise")
    @php 
        $monthsSheet = App\Models\user\Payment::with('client')->where('year',$year)->where('month',$month)->where('approval_status','Approved')->where('client_id',$client_id)->get();
        //dd($monthsSheet);
        $clientInfo =  App\User::where('id',$client_id)->first();
       // dd($clientInfo);
    @endphp
    <h5 style="background:red; padding:5px; color:#fff">Client: {{ $clientInfo->name }} |   <b>Year:</b>  @php small_label("success",$year); @endphp <b>Month:</b> @php small_label("success",$month); @endphp  </h5> 
   
     _______________________________________________________________<br>
    @foreach($monthsSheet as $payInfo)
        <?php /*
        <b>Name:</b> {{ $payInfo->client->name }}<br>
                    <b>Apartment Id:</b>  {{ $payInfo->apartment_id }}<br>
                    <b>Year:</b>   {{ $payInfo->year }}<br>
                    <b>Month:</b>    {{ $payInfo->month }}<br>
        */ ?>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="panel tab-border ">
                    
                    <div class="panel-body"> 
                   
                    
                    <b>Phone:</b>   {{ $payInfo->client->country_code }}  {{ $payInfo->client->phone }}<br>
                    <b>Apartment:</b>    {{ $payInfo->client->apartment_id }} <br> 
                    <b>Amount:</b>    {{ $payInfo->amount }}<br>
                    <b>Pay date:</b>    {{ $payInfo->pay_date }} <br>
                  
                    <b>Client Note:</b>    {{ $payInfo->note_user }}<br>
                    <b>Send Status:</b>
                        @if($payInfo->send_status== "not_sent")
                            @php
                            small_label("danger","Not Sent");
                            @endphp
                        
                        @else
                            @php
                            small_label("success","Sent");
                            @endphp
                            <br> <b>Sent Time:</b>    {{ $payInfo->sent_time }}<br>

                            <b>Approval Status:</b>
                            @if($payInfo->approval_status == "pending")
                            
                            @php small_label("warning","Approval Pending"); @endphp
                        
                            @elseif($payInfo->approval_status == "Approved")
                                @php  small_label("success","Approved");  @endphp
                            @else
                            @php  small_label("danger","Declined");  @endphp
                            @endif


                        @endif
                    
                    <br> <b>Approval/Decline Time:</b>    {{ $payInfo->approved_time }}<br>

                    <b>Update Notes:</b> {{  $payInfo->note_approved_user }}
                    <!----- UPDATE USER INFO SHOW --->
                    <br>
                    @if($payInfo->approval_status != "pending")
                        @php
                        $role = $payInfo->approve_update_user;
                        $updateUid = $payInfo->approved_by;
                        $approveUser = roleWiseUserInfo($role,$updateUid); 
                    
                        @endphp

                           
                                @if($role == 1)
                                <br><b>Updated User Type:</b> @php small_label("secondary","Admin"); @endphp
                                <br><b>Updated User:</b> {{ $approveUser->name }}
                                @else
                                <b>Updated User Type:</b> @php small_label("primary","Moderator"); @endphp
                                <br><b>Updated User:</b> {{ $approveUser->name }}
                                @endif
                            
                          
                    @endif


                    </div>
                </div>
            </div>
            
        </div>
    @endforeach
   


@endif

