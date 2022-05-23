@extends('admin.master')


@section('page-title')
<?php txt("Fetched User Data Filter"); ?>

@endsection

@section('title')
<?php txt("Fetched User Data Filter"); ?> 
@endsection

@section('middle-content')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<style>
    body{
        font-size: 1em;
        }
        @media only screen and (max-width: 320px) {
        body { 
        font-size: 1em; 
        }

        
    }

    td {
         word-break: break-all;
        }
</style>
<div class="card card-topline-green">
    <form method="post" action="{{route('admin.customer.management.fetch.selection.save')}}">
    @csrf
        <div class="panel-body">
            <div style="background:#F0F2E0; padding:10px; " >
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 "  style="float:left"  >
                <input type="text" id="myInput" onkeyup="myFunction()"  class="form-control"  placeholder="Search by title/ or an keyword from description" title="Type in a name" style="border:solid 1px #000">
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 "  style="float:left"    >
                    <input type="submit" value="Fetch Selected Customer" onclick="return OnclickFetchConfirm()" class="btn btn-success">
                </div>
            <?php clear(); ?>  
            </div>
            <div class="table-responsive">
                
                <table  id="myTable"  class="table table-bordered table-striped">
                    <thead class="text-center">
                        <tr>
                        <th><?php txt("Sl");?>
                        
                        </th>
                        <th><?php txt("Image");?></th>
                        <th><?php txt("Name");?></th>
                        <th>Email</th>
                        <th>Use Name</th>
                        <th>Phone</th>
                        <th>Account Status on SR</th>
                        <th>Account Status</th>
                    </tr>
                    </thead>
                    <tbody> <?php $i = 1;?> 
                        @foreach($q as $q1)
                            @php $customerAccountExistenctCheck = customerAccountExistenctCheck($q1->customer_id);
                        @endphp
                         
                       
                        <tr>
                            <td>{{ $i }} 
                               
                            </td>
                           
                            <td valign="top"><img src="<?php echo $q1->image; ?>" width="70" target="_new" style="align:top" ></td>  
                            <td>  <?php echo $q1->name; ?>
                           
                            </td>   
                            <td>
                                <?php echo $q1->email; ?><br><br>
                                @if($q1->account_status_on_wordpress == "yes")
                                    <div id="createAccountAndSendEmailResult<?php echo $i;?>"> </div>
                                    <input type="hidden" id="customer_id<?php echo $i?>" value="{{$q1->customer_id}}">
                                    @if($customerAccountExistenctCheck == 0)
                                    <input type="button" id="createAccountAndSendEmail<?php echo $i?>" class="btn btn-primary" value="Send mail to create account">
                                    @else
                                    <input type="button" id="createAccountAndSendEmail<?php echo $i?>" class="btn btn-danger" value="Send mail alert">
                                    @endif
                                @endif
                           </td> 
                            <td>
                                <?php echo $q1->user_name; ?>
                            </td> 
                            <td>
                                <?php echo $q1->phone; ?>
                            </td> 
                            
                           
                            <td>
                                @if($q1->account_status_on_wordpress == "yes")
                                    @php
                                    small_label2("primary", "Approve");
                                    @endphp
                                @else
                                    @php 
                                    small_label2("danger", "Not Approve");
                                    @endphp
                                @endif
                                    

                            </td>
                            <td>
                                @if($customerAccountExistenctCheck == 1)
                                    @php
                                    $acc_status = customerAccountActivationStatus($q1->customer_id);
                                    if($acc_status == "active")
                                    small_label2("success", "Created");
                                    else
                                    small_label2("danger", "Pending");
                                    @endphp
                                @endif
                            </td> 
                        
                        </tr>  
                        
                     
                        
                        <script>
                            $(document).ready(function() {
                                $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
                                // function starts
                                
                                $("#createAccountAndSendEmail<?php echo $i;?>").click(function(){
                                    
                                    //alert('hey i am here');
                                    $.ajax({
                                        method: "GET",
                                        url: "{{ url('admin/user_account_create/send_email') }}",
                                        data: "customer_id="+$("#customer_id<?php echo $i;?>").val(),
                                        success:function(result){				
                                            $("div#createAccountAndSendEmailResult<?php echo $i;?>").html(result);
                                        }
                                    });	

                                });
                                // function ends
                        
                        

                            });

                        </script>
                        <?php $i = $i+1; ?> 
                        @endforeach                                            
                    </tbody>
                </table>
            </div>
                    
        </div>
    </form>

</div>


 

    <script  type="text/javascript">  
          function OnclickFetchConfirm()
          {
              var agree=confirm("Do you really want to proceed?");
              if(agree)
              return true;
              else
              return false;
          }
      </script> 
					 
@endsection

 