@extends('admin.master')

@section('page-title')
    <?php txt("All Fetched Data"); ?>
@endsection

@section('title')
    <?php txt("All Fetched data"); ?>
@endsection

@section('middle-content')
 
      
<div class="col-sm-12">
        <div class="card card-topline-green">
             
            <div class="card-body ">
                <form name="" action="" method="post">
                    <b>Data From</b> 
                    <select name ="edit_from" id="edit_from">
                        <?php for($i=1; $i<=400; $i++){ ?>
                            <option <?php if($i == $from) echo "selected";?> value="<?php echo $i;?>"><?php echo $i; ?></option>
                        <?php } ?>
                    </select>

                    
                    <b>Data To</b> 
                    <select name ="edit_to" id="edit_to">
                        <?php for($i=1; $i<=400; $i++){ ?>
                        <option <?php if($i == $to) echo "selected";?>  value="<?php echo $i;?>"><?php echo $i; ?></option>
                        <?php } ?>
                    </select>

                    <button type="button" class="btn btn-success" id="viewData">Click </button>
                </form>

                <div id="selectedDataResult">
                    <div class="table-responsive">
                        @if($q != "no_data")
                        <table class="table table-bordered table-striped">
                            <thead class="text-center">
                                <tr>
                                <th><?php txt("Sl");?></th>
                                <th><?php txt("Image");?></th>
                                <th><?php txt("Title");?> 

                                </th>
                                <th>Regular Price</th>
                                <th>Canada Price</th>
                            </tr>
                            </thead>
                            <tbody> <?php $i = 1;?>
                                @foreach($q as $q1)
                                <tr>
                                    <td>{{ $q1->id }}</td>
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
                        @endif
                    </div>
                </div>
 
                
            </div>
        </div>
    </div>
        
    <script type="text/javascript">
      $(document).ready(function() {
        $('.summernote').summernote();
      });
   </script>
           
    <script>
        $(document).ready(function() {
            $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
            // function starts
            $("#viewData").click(function(){
                 //alert('hey i am here');
                $.ajax({
                    method: "GET",
                    url: "{{ url('admin/wp-data/ajax/view-selected-rows') }}",
                    data: "edit_from="+$("#edit_from").val()+"&edit_to="+$("#edit_to").val(),
                    success:function(result){				
                        $("div#selectedDataResult").html(result);
                    }
                });	

            });
            // function ends
 
        });
    </script>


    <script  type="text/javascript">  
        function confirmModeratorBlock()
        {
            var agree=confirm("Do you really want to block this moderator?");
            if(agree)
            return true;
            else
            return false;
        }
    </script>   



@endsection
 

