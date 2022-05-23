@php  //dd($user)
@endphp 
@include('common.iframe.css')

<?php /* 
user id  = {{ $user->role }} <br>
 user id  = {{ $user->id }} <br>
 User Name  = {{ $user->name }} 
 */ ?>
        
      
       
    <div class="col-sm-12">
        <div class="card card-topline-green">
            <div class="card-head">
                <header>User List</header>
                
            </div>
            <div class="card-body ">
                <div class="table-scrollable">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Username/Phone Number</th>
                                <td>Status</td>
                                <td>NotiType</td>
                               
                                <td>Operation</td>
                            </tr>
                        </thead>
                        <?php $i = 1; ?>
                        @foreach($clientList as $singleUser)
                        <tbody>
                            
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $singleUser->name }}</td>
                                <td>{{ $singleUser->email }}</td>
                                <td>{{ $singleUser->phone }}</td>
                                <td><span class="badge badge-danger">{{ $singleUser->ustatus }}</span></td>
                                <?php /*
                                <td>{{  $r0->chapter->ch_name  }}</td>
                                <td>{{  $r0->cat_name  }}</td>
                                <td>{{ $r0->view_order}}</td>
                                */ ?>
                               
                                <td> @if($singleUser->notiType == "email")
                                    <span class="badge badge-success">Email</span>
                                    
                                    @else
                                    <span class="badge badge-success">Phone</span>
                                    @endif
                                </td>
                              
                                <td>

                                <div class="btn-group"> 
                                    
                                    <a  href="{{ route('approved.pending.clients.from.pending.to.approve',['clientId'=>$singleUser->id,'updatedUser'=>$user->id,'updatedUserRole'=>$user->role]) }}"  onclick="return confirmApproveClient()" class="btn btn-success btn-xs m-b-10"> Approve </a>  
                                    <a  href="{{ route('decline.pending.clients.from.pending.to.decline',['clientId'=>$singleUser->id,'updatedUser'=>$user->id,'updatedUserRole'=>$user->role]) }}"  onclick="return confirmDeclineClient()" class="btn btn-danger btn-xs m-b-10"> Decline </a>  
                                    
                                    <button type="button" class="btn btn-primary btn-xs m-b-10 clientDeatailsShowAjaxButton"  
                                    data-toggle="modal" data-original-title="test" data-target="#clientDeatailsShow" data-id="{{ $singleUser->id }}" 
                                    data-viewtype ="pending"> 
                                     Details       
                                    </button>
                                </div>
                                 
                                </td>

                                
                                    
                            </tr>
                                
                        </tbody>
                        @endforeach
                    </table>
                    {{ $clientList->links() }} 
                </div>
            </div>
        </div>
    </div>
<script  type="text/javascript">  
    function confirmApproveClient()
    {
        var agree=confirm("Do you really want to approve the client?");
        if(agree)
        return true;
        else
        return false;
    }
    function confirmDeclineClient()
    {
        var agree=confirm("Do you really want to decline the client?");
        if(agree)
        return true;
        else
        return false;
    }
    
</script>  
    
    @include('common.iframe.js')
    @include('common.modals.modalForClientDetails')
  