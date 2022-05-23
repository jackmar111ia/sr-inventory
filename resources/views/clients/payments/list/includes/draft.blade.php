    
     @if(session('success'))
                        <div class="alert alert-success">
                        {{ session('success') }}
                        </div> 
                    @endif
    <div class="card-body">
        <table class="table table-bordered">
            <thead>                  
                <tr  >
                <th style="width: 10px">#</th>
                <th style="width: 100px">Year</th>
                <th style="width: 200px">Month</th>
                <th style="width: 200px">Amount</th>
                <th style="width: 200px">Pay Date</th>
                <th style="width: 200px"> Status</th>
                <th style="width: 200px">Update Status</th>
             
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

                <td>  @php  small_label("warning","Draft"); @endphp </td>

                <td>

                    @if($pay->approval_status == "Declined")
                        @php    small_label("danger","Declined"); @endphp
                    
                    
                    @endif
                </td>
                
                <td>
                <div class="btn-group">
                    <a  href="{{route('client.draft.payment.send.for.publishment',['id'=>$pay->id])}}"   class="btn btn-primary btn-xs m-b-10"  onclick="return confirmForSendToAdmin<?php echo $i;?>()"> Send to Admin </a>  
                    <a  href="{{route('client.payments.edit',['id'=>$pay->id])}}"   class="btn btn-success btn-xs m-b-10"> Edit</a>  
                    @if(($pay->send_status == "not_sent") AND ($pay->approval_status == "pending") )
                    <a  href="{{route('client.payments.delete',['id'=>$pay->id])}}"   class="btn btn-danger btn-xs m-b-10"> Delete</a>  
                    @endif
                    <button type="button" class="btn btn-primary btn-xs m-b-10 paymentDeatailsShowAjaxButton"  
                        data-toggle="modal" data-original-title="test" data-target="#paymentDeatailsShow" data-id="{{ $pay->id }}" 
                        data-viewtype ="user"> 
                        Review Deatails       
                    </button>

                </div>


                </td>
                </tr>
            
        
            </tbody>
            <script  type="text/javascript">  
                function confirmForSendToAdmin<?php echo $i;?>()
                {
                    var agree=confirm("Do you really want to send for publishment ?");
                    if(agree)
                    return true;
                    else
                    return false;
                }
            </script> 

            <?php $i = $i+1; ?>
            @endforeach
        </table>
        {{ $payList->links() }} 
    </div>


   



