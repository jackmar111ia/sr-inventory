@if($viewtype != '') 
@if($viewtype == "new_updates")
 @php 
 $mInfoNew =  App\Models\moderator\ModeratorUpdate::where('status','approval_pending')->where('moderator_id', $mInfo->id)->first(); 
 //dd($mInfoNew);
 @endphp
@endif
@endif
<div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="panel tab-border ">
                
            <div class="panel-body">
                <b>Name:</b> {{ $mInfo->name }}   <br>
                
                <b>Phone:</b>  {{ $mInfo->country_code }} {{ $mInfo->phone }}<br>
                <b>Email:</b>  {{ $mInfo->email }}<br>
                <b>Present Address:</b>  {{ $mInfo->present_address }}<br>
                <b>Permanent Address Id:</b>  {{ $mInfo->permanent_address }}<br>
               
                <b>NID:</b>  {{ $mInfo->nid }}<br>
                <b>Joined at:</b>  {{ $mInfo->created_at }}<br>
               
                <b>Notification Type:</b>
                    @if($mInfo->notiType == "email")
                        @php small_label("danger","Email");  @endphp
                    
                    @else
                        @php  small_label("success","Phone");  @endphp
                       
                    @endif 
                <br> 
                <b>Activation Status:</b>
                    @if($mInfo->activity_status== "approval_pending")
                        @php small_label("danger","Approval Pending"); @endphp
                        
                    
                    @else
                        @php
                        small_label("success","Approved");
                        @endphp
                        <br> <b>Approbval Time:</b>    {{ $mInfo->approval_time }}<br>
                        
                        

                    @endif
                  
                  
                <?php /*
                <b>Year:</b>   {{ $mInfo->year }}<br>
                <b>Month:</b>    {{ $mInfo->month }}<br>
                <b>Amount:</b>    {{ $mInfo->amount }}<br>
                <b>Send Status:</b>
                    @if($mInfo->send_status== "not_sent")
                        @php
                        small_label("danger","Not Sent");
                        @endphp
                    
                    @else
                        @php
                        small_label("success","Sent");
                        @endphp
                        <br> <b>Sent Time:</b>    {{ $mInfo->sent_time }}<br>

                        <b>Approval Status:</b>
                        @if($mInfo->approval_status == "pending")
                        
                        @php small_label("danger","Approval Pending"); @endphp
                    
                        @else
                            @php  small_label("success","Approved");  @endphp
                           
                        @endif


                    @endif
                <br>

               */ ?>

                @if($viewtype == "new_updates")         
                    
                    <h4 style="background:red; padding:2px; color:#fff">New Update </h4>
                    <b>Name:</b> {{ $mInfoNew->name }}   <br>
                    
                        
                    
                    <b>Present Address:</b>  {{ $mInfoNew->present_address }}<br>
                    <b>Permanent Address Id:</b>  {{ $mInfoNew->permanent_address }}<br>
                
                    <b>NID:</b>  {{ $mInfoNew->nid }}<br>
                    <b>Note:</b>  {{ $mInfoNew->note }}<br>
                    <b>Sent Time:</b>  {{ $mInfoNew->sent_at }}<br>
                
                @endif

              
                </div>
            </div>

            
          

        </div>
        
    </div>
