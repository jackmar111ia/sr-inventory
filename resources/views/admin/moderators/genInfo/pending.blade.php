@extends('admin.master')

@section('page-title')
    <?php txt("Moderators update list"); ?>
@endsection

@section('title')
    <?php txt("Moderators update request list"); ?>
@endsection

@section('middle-content')
 
      
<div class="col-sm-12">
        <div class="card card-topline-green">
             
            <div class="card-body ">
                <div class="table-scrollable">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <td>Status</td>
                                <td>NotiType</td>
                               
                                <td>Operation</td>
                            </tr>
                        </thead>
                        <?php $i = 1; ?>
                        @foreach($mList as $singleUser)
                        <tbody>
                            
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $singleUser->name }}</td>
                                <td>{{ $singleUser->email }}</td>
                                <td>{{ $singleUser->phone }}</td>
                                <td>
                                    @if($singleUser->activity_status == "block")
                                    <span class="badge badge-danger">Blocked</span>
                                    
                                    @else
                                    <span class="badge badge-success">Active</span>
                                    @endif

                                </td>
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
                               
                                <a  href="{{ route('moderators.geninfo.update.approve',['id'=>$singleUser->id]) }}"   class="btn btn-success btn-xs m-b-10" onclick="return confirmModeratorInfoUpdate()"> Approve </a> 
                                <a  href="{{ route('moderators.geninfo.update.decline',['id'=>$singleUser->id]) }}"   class="btn btn-danger btn-xs m-b-10" onclick="return confirmModeratorInfoDecline()"> Reject </a> 

                                    <button type="button" class="btn btn-primary btn-xs m-b-10 moderatorDeatailsShowAjaxButton"  
                                    data-toggle="modal" data-original-title="test" data-target="#moderatorDeatailsShow" data-id="{{ $singleUser->id }}" 
                                    data-viewtype ="new_updates"> 
                                     Current & Updated Details       
                                    </button>

                                </div>
                                 
                                </td>

                                
                                    
                            </tr>
                                
                        </tbody>
                        @endforeach
                    </table>
                    {{ $mList->links() }} 
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


@endsection
  <!-- start js include path -->
 @include('common.includes.modaljs')
@include('admin.moderators.modalForModeratorDetails')
