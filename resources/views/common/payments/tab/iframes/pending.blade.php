@php 
//dd($userData->role)

@endphp 
@include('common.iframe.css')
<?php /* 
 user id  = {{ $userData->id }} <br>
 User Name  = {{ $userData->name }} 

 
*/ ?>
 
       
    <div class="col-sm-12">
        <div class="card card-topline-green">
           
            <div class="card-body ">
                <div class="table-scrollable">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Amount</th>
                                <th>Approval Status</th>
                                <th>Pay date</th>
                                
                            </tr>
                        </thead>
                        <?php $i = 1; ?>
                        @foreach($payInfo as $sinlgePay)
                        <tbody>
                            
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $sinlgePay->client->name }}</td>
                               
                                <td>{{ $sinlgePay->client->phone }}</td>
                                <td>{{ $sinlgePay->amount }}</td>
                                <td><span class="badge badge-success">{{ $sinlgePay->approval_status }}</span></td>
                                
                                <td>{{ $sinlgePay->pay_date }}</td>
                                 
                                <td>

                                <div class="btn-group">
                                    
                                    <a  href="{{ route('iframe.pending..payments.update',['id'=> $sinlgePay->id , 'uid'=> $userData->id, 'urole' => $userData->role]) }}"   class="btn btn-success btn-xs m-b-10"> Update</a>

                                   <button type="button" class="btn btn-primary btn-xs m-b-10 paymentDeatailsShowAjaxButton"  
                                    data-toggle="modal" data-original-title="test" data-target="#paymentDeatailsShow" data-id="{{ $sinlgePay->id }}" 
                                    data-viewtype ="admin"> 
                                    Review Deatails       
                                </button>

                                </div>
                                 
                                </td>

                                
                                    
                            </tr>
                                
                        </tbody>
                        @endforeach
                    </table>
                    {{ $payInfo->links() }} 
                </div>
            </div>
        </div>
    </div>
         
    
    @include('common.iframe.js')

@include('clients.payments.modalForDetails')
  