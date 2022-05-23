@extends('admin.master')

@section('page-title')
    <?php txt("Non retrieved Data"); ?>
@endsection

@section('title')
    <?php txt("Non retrieved Data"); ?>
@endsection

@section('middle-content')
 
      
<div class="col-sm-12">
        <div class="card card-topline-green">
             
            <div class="card-body ">
                 
                <div class="alert alert-warning" role="alert">
                    Non retrived data <span class="badge bg-danger">{{$q}}</span><br>
                   
                </div>

                
                <form method="post" action="{{route('admin.wpdata.manage.nonretrieved.data.refetch.multiple')}}">
                    @csrf
                    <div class="panel-body">
                        <div style="background:#F0F2E0; padding:10px; " >
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 "  style="float:left"  >
                            <input type="text" id="myInput" onkeyup="myFunction()"  class="form-control"  placeholder="Search by title/ or an keyword from description" title="Type in a name" style="border:solid 1px #000">
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 "  style="float:left"    >
                                <input type="submit" value="Fetch Selected Data" onclick="return OnclickFetchConfirm()" class="btn btn-success">
                            </div>
                        <?php clear(); ?>  
                        </div>
                        <div class="table-responsive">
                            
                            <table  id="myTable"  class="table table-bordered table-striped">
                                <thead class="text-center">
                                    <tr>
                                    <th><?php txt("SL");?>
                                     <button href="#" type="button" class="btn btn-secondary btn-xs m-b-10"><input type="checkbox" onclick="toggle(this);"   /><?php txt("Check all?");?></button>
                                    </th>
                                    <th><?php txt("Title");?></th>
                                    <th><?php txt("permalink");?></th>
                                   
                                </tr>
                                </thead>
                                <tbody> 
                                    <?php  $i = 1;?> 
                                    @foreach($q2 as $q1)
                                    <?php  $ch_status = checkNonRetrievedExistencyInLocalFetchTable($q1->wp_id); ?> 
                                     <tr>
                                        <td>{{ $i }}   
                                            <input  type="checkbox" name="wp_id[]"  value="<?php echo $q1->wp_id; ?>" >  
                  
                                          
                                        </td>
                                        
                                        <td valign="top">
                                            <a href="{{$q1->permalink}}" target="_blank">{{$q1->title}}</a>  
                                        </td>  
                                        <td> 
                                            
                                             @if($ch_status == 0)
                                            <a href="{{route('admin.wpdata.manage.nonretrieved.data.refetch',['wp_id'=> $q1->wp_id,'fetch_type' => 'single'])}}" class="btn btn-success">Retrieve Single</a> 
                                            @else
                                            <a href="#" class="btn btn-danger">Retrieved</a> 
                                            @endif
                                            </td>   
                                         
                                        
                                    </tr>  
                                  
                                    <?php $i = $i+1; ?>                            
                                    @endforeach     
                                                                      
                                </tbody>
                            </table>
                        </div>
                                
                    </div>
                </form>

               


                 
            </div>
        </div>
    </div>
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
    <script>
        function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
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


@endsection


