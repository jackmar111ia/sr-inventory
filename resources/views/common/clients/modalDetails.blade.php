@if($viewtype != '') 
@if($viewtype == "new_updates")
 @php 
 $cInfoNew =  App\Models\user\ClientUpdate::where('status','approval_pending')->where('client_id', $clientInfo->id)->first(); 
 //dd($cInfoNew);
 @endphp
@endif
@endif

<div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="panel tab-border ">
                
                <div class="panel-body">
                <b>Name:</b> {{ $clientInfo->name }}<br>
                <b>Apartment Id:</b>  {{ $clientInfo->apartment_id }}<br>
                <b>Phone:</b>  {{ $clientInfo->country_code }} {{ $clientInfo->phone }}<br>
                <b>Email:</b>  {{ $clientInfo->email }}<br>
                <b>Present Address:</b>  {{ $clientInfo->present_address }}<br>
                <b>Permanent Address Id:</b>  {{ $clientInfo->permanent_address }}<br>
                <b>Date of Deed:</b>  {{ $clientInfo->date_of_deed }}<br>
                <b>NID:</b>  {{ $clientInfo->nid }}<br>
                <b>Notification Type:</b>
                    @if($clientInfo->notiType == "email")
                        @php small_label("danger","Email");  @endphp
                    
                    @else
                        @php  small_label("success","Phone");  @endphp
                       
                    @endif 
                <br>
                <b>Activation Status:</b>
                    @if($clientInfo->ustatus== "approval_pending")
                        @php small_label("danger","Approval Pending"); @endphp
                        
                    
                    @else
                        @php
                        small_label("success","Approved");
                        @endphp
                        <br> <b>Approbval Time:</b>    {{ $clientInfo->user_activation_time }}<br>
                        
                        @if($approveUser->role == 1)
                        <br><b>Approved By:</b> @php small_label("secondary","Admin"); @endphp
                        <br><b>Approval User:</b> {{ $approveUser->name }}
                        @else
                        <b>Approved By:</b> @php small_label("primary","Moderator"); @endphp
                        <br><b>Approval User:</b> {{ $approveUser->name }}
                        @endif

                    @endif
                  
                    
                <?php /*
                <b>Year:</b>   {{ $clientInfo->year }}<br>
                <b>Month:</b>    {{ $clientInfo->month }}<br>
                <b>Amount:</b>    {{ $clientInfo->amount }}<br>
                <b>Send Status:</b>
                    @if($clientInfo->send_status== "not_sent")
                        @php
                        small_label("danger","Not Sent");
                        @endphp
                    
                    @else
                        @php
                        small_label("success","Sent");
                        @endphp
                        <br> <b>Sent Time:</b>    {{ $clientInfo->sent_time }}<br>

                        <b>Approval Status:</b>
                        @if($clientInfo->approval_status == "pending")
                        
                        @php small_label("danger","Approval Pending"); @endphp
                    
                        @else
                            @php  small_label("success","Approved");  @endphp
                           
                        @endif


                    @endif
                <br>

               */ ?>

                @if($viewtype == "new_updates")         
                    
                    <h4 style="background:red; padding:2px; color:#fff">New Update </h4>
                    <b>Name:</b> {{ $cInfoNew->name }}   <br>
                    
                    <b>Date of deed:</b> {{ $cInfoNew->date_of_deed }}   <br>
                    
                    <b>Present Address:</b>  {{ $cInfoNew->present_address }}<br>
                    <b>Permanent Address Id:</b>  {{ $cInfoNew->permanent_address }}<br>
                
                    <b>NID:</b>  {{ $cInfoNew->nid }}<br>
                    <b>Note:</b>  {{ $cInfoNew->note }}<br>
                    <b>Sent Time:</b>  {{ $cInfoNew->sent_at }}<br>
                
                @endif

              
                </div>
            </div>
        </div>
        
    </div>
