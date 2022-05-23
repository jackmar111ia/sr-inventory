    
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
                <th style="width: 200px">Status</th>
                <th style="width: 200px">Sent Date</th>
             
                </tr>
            </thead>
            <?php $i=0; ?>
            @foreach($payListSent as $pay)
            <tbody>
                <tr>
            
                <td>{{ ++$i  }}</td>
                <td>{{  $pay->year  }}</td>
                <td>{{  $pay->month  }}</td>
                <td>{{  $pay->amount  }}</td>
                <td>{{  $pay->pay_date  }}</td>
                <td> 
                        @php
                        small_label("warning","Sent");
                        @endphp
                        

                    
                </td>

                <td>{{  $pay->sent_time  }}</td>
                <td>
                <div class="btn-group">
       
                    <button type="button" class="btn btn-primary btn-xs m-b-10 paymentDeatailsShowAjaxButton"  
                        data-toggle="modal" data-original-title="test" data-target="#paymentDeatailsShow" data-id="{{ $pay->id }}" 
                        data-viewtype ="user"> 
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