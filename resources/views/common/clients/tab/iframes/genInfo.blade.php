@php   //dd($userData)
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

                                <a  href="{{ route('clients.geninfo.update.approve',['id'=>$singleUser->id,'role'=>$userData->role,'uid'=>$userData->id]) }}"   class="btn btn-success btn-xs m-b-10" onclick="return confirmModeratorInfoUpdate()"> Approve </a> 
                                <a  href="{{ route('clients.geninfo.update.reject',['id'=>$singleUser->id,'role'=>$userData->role,'uid'=>$userData->id]) }}"   class="btn btn-danger btn-xs m-b-10" onclick="return confirmModeratorInfoDecline()"> Reject </a> 


                                   <?php /*
                                    <a  href="{{ route('block.active.client',['clientId'=>$singleUser->id,'updatedUser'=>$user->id,'updatedUserRole'=>$user->role]) }}"  onclick="return confirmBlockClient()" class="btn btn-danger btn-xs m-b-10"> Block</a>  
                                    */ ?>
                                    <button type="button" class="btn btn-primary btn-xs m-b-10 clientDeatailsShowAjaxButton"  
                                    data-toggle="modal" data-original-title="test" data-target="#clientDeatailsShow" data-id="{{ $singleUser->id }}" 
                                    data-viewtype ="new_updates"> 
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
        function confirmModeratorInfoUpdate()
        {
            var agree=confirm("Do you really want to approve this update?");
            if(agree)
            return true;
            else
            return false;
        }
    </script>   
 
 
 <script  type="text/javascript">  
        function confirmModeratorInfoDecline()
        {
            var agree=confirm("Do you really want to reject this update?");
            if(agree)
            return true;
            else
            return false;
        }
    </script>   
    @include('common.iframe.js')
    @include('common.modals.modalForClientDetails')