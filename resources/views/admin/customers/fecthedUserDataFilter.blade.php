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
                        <button href="#" type="button" class="btn btn-secondary btn-xs m-b-10"><input type="checkbox" onclick="toggle(this);"   /><?php txt("Check all?");?></button>
                        </th>
                        <th><?php txt("Image");?></th>
                        <th><?php txt("Name");?></th>
                        <th>Email</th>
                        <th>Use Name</th>
                        <th>Phone</th>
                        <th>Account Status on SR</th>
                    </tr>
                    </thead>
                    <tbody> <?php $i = 1;?> 
                        @foreach($q as $q1)
                        <?php   $ch_status = checkUserExistency($q1->customer_id); ?> 
                       @if($ch_status == 0) 
                        <tr>
                            <td>{{ $i }} 
                                <input  type="checkbox" name="customer_id[]"  value="<?php echo $q1->customer_id; ?>" >  
                            </td>
                           
                            <td valign="top"><img src="<?php echo $q1->image; ?>" width="70" target="_new" style="align:top" ></td>  
                            <td>  <?php echo $q1->name; ?>
                           
                            </td>   
                            <td>
                                 <?php echo $q1->email; ?>
                           
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
                           

                        
                        </tr>  
                        @endif
                        <?php $i = $i+1; ?>                            
                        @endforeach                                            
                    </tbody>
                </table>
            </div>
                    
        </div>
    </form>

</div>


 
<script>
            function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[2];
                if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
                }       
            }
            }
        </script>

    <!--- for selecting multiple checkbox by one click ----->                
    <script language="JavaScript">
    function toggle(source) {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i] != source)
                checkboxes[i].checked = source.checked;
        }
    }
    </script>
    <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>-->

    <script type="text/javascript">
    $(document).ready(function () {
        $('#checkBtn').click(function() {
        checked = $("input[type=checkbox]:checked").length;

        if(!checked) {
            alert("<?php echo txt("You must check at least one checkbox");?>");
            return false;
        }

        });
    });

    </script>

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

 