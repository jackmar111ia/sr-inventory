@extends('admin.master')

@section('page-title')
    <?php txt("Ontario List Management"); ?>
@endsection

@section('title')
    <?php txt("Ontario List Management"); ?>
@endsection

@section('middle-content')
 
    
<div class="col-sm-12">
        <div class="card card-topline-green">
             
            <div class="card-body ">
            <form method="post" action="{{route('admin.report.head.list.save')}}">
            @csrf
                 
            
                <button href="#" type="submit" style="float:left" onclick="return confirmSubmit()" class="btn btn-success " id="checkBtn" onclick = "return DraftImageSend()" ><?php txt("Save");?></button>
                <div class="table-responsive">         
                    <table class="table table-bordered table-striped">
                        <thead class="text-center">
                            <tr>
                            <th><?php txt("Sl");?>
                            <br>
                            <div class="btn-group">
                                <button href="#" type="button" class="btn btn-secondary btn-xs m-b-10"><input type="checkbox" onclick="toggle(this);"   /><?php txt("Check all?");?></button>
                                <input type="hidden" value="ontario" name="type">
                            </div>
                            </th>
                            <th><?php txt("Image");?></th>
                            <th><?php txt("Title");?> 

                            </th>
                            <th>Regular Price</th>
                            <th>Canada Price</th>
                            <th>Ontario Price</th>

                            

                        </tr>
                        </thead>
                        <tbody> <?php $i = 1;?>
                            @foreach($q as $q1)
                            <tr> 
                                <td>{{ $i }}  <input  class="sent_ids" <?php if($q1->ontario_view == "yes") echo "checked";?> name="id[]" type="checkbox"  value="<?php echo $q1->id; ?>"></td>
                                <td valign="top"><img src="<?php echo $q1->image; ?>" width="100" target="_new" style="align:top" ></td>  
                                <td><a href="<?php echo $q1->permalink; ?>">{{ $q1->title }}</a>
                                <br><div style="width:400px">
                                <?php echo $q1->short_des; ?>
                                </div>
                                <?php clear();?>
                                </td>    
                                <td>{{ $q1->type }}</td> 
                                    @if($q1->type == "simple")
                                        <td>{{ $q1->regular_price }}</td> 
                                        <td>{{ $q1->canada_price }}</td> 
                                        <td>{{ $q1->ontario_price }}</td> 
                                        @else
                                        <td colspan="3"><font color='red'>{{ $q1->variable_product_price }}</font></td> 
                                    @endif

                                
                                
                            </tr>  
                            <?php $i = $i+1; ?>                            
                            @endforeach                                            
                        </tbody>
                    </table>
                </div>
            </form>
                
            </div>
        </div>
    </div>
         

    <script  type="text/javascript">  
        function confirmSubmit()
        {
            var agree=confirm("Do you really want to submit?");
            if(agree)
            return true;
            else
            return false;
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




@endsection
 

