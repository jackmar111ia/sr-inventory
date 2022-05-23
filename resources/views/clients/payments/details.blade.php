 
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="panel tab-border ">
                
                <div class="panel-body">
                <b>Name:</b> {{ $payInfo->client->name }}<br>
                <b>Apartment Id:</b>  {{ $payInfo->apartment_id }}<br>
                <b>Year:</b>   {{ $payInfo->year }}<br>
                <b>Month:</b>    {{ $payInfo->month }}<br>
                <b>Amount:</b>    {{ $payInfo->amount }}<br>
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
                <br>
                <b>Update Notes:</b> {{  $payInfo->note_approved_user }}
                <!----- UPDATE USER INFO SHOW --->
                <br>
                @if($payInfo->approval_status != "pending")
                    @php
                    $role = $payInfo->approve_update_user;
                    $updateUid = $payInfo->approved_by;
                    $approveUser = roleWiseUserInfo($role,$updateUid); 
                   
                    @endphp

                        @if($viewtype == "admin")
                            @if($role == 1)
                            <br><b>Updated User Type:</b> @php small_label("secondary","Admin"); @endphp
                            <br><b>Updated User:</b> {{ $approveUser->name }}
                            @else
                            <b>Updated User Type:</b> @php small_label("primary","Moderator"); @endphp
                            <br><b>Updated User:</b> {{ $approveUser->name }}
                            @endif
                         
                        @endif
                @endif


                </div>
            </div>
        </div>
        
    </div>
