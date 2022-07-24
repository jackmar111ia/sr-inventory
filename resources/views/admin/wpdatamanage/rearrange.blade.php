@extends('admin.master')


@section('page-title')
<?php txt("Seleted Products"); ?>
@endsection

@section('title')
<?php txt("Seleted Products"); ?> 
@endsection

@section('middle-content')
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet">

   
<div class="card card-topline-green">
    <div class="panel-body">
        <div class="tab-content">
            <table class="table table-bordered pagin-table" id="table1" name="table1">
                <tbody id="sortable"  >
                    <tr style="font-size:12px;  background:#999; color:#fff">
                        <th>Sl No</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>SKU</th>
                        <th>Regular Price</th>
                        <th>Canada Price</th>
                        <th>Ontario Price</th>
                        <th>Operation</th>
                    </tr>
                    <form action="{{route('check')}}">
                        @php($i=1)
                        @foreach ($all as $q1)
                        
                        <tr id="item-{{$q1->id}}">
                            <td>{{$i}}</td>
                            <td> <img src="{{asset($q1->resize_image)}}" width="70" target="_blank" style="align:top" >
                                
                                <div id="selectedDataResult<?php echo $i; ?>"></div>

                                <input type="checkbox" id="myCheck<?php echo $i; ?>" onclick="shortList<?php echo $i;?>()"  <?php if($q1->added_as_inhouse == "yes") echo "checked";?>> Select
                                <input type="hidden" id="id<?php echo $i; ?>" value="{{$q1->id}}">
                                <p id="text" style="display:none">SELECTED!</p>
                            
                                <script>
                                    function shortList<?php echo $i;?>() {
                                        var checkBox = document.getElementById("myCheck<?php echo $i; ?>");
                                        var text = document.getElementById("text");
                                        if (checkBox.checked == true){
                                            text.style.display = "block";
                                            //alert("Hello worl");
                                            $.ajax({
                                                method: "GET",
                                                url: "{{ url('admin/wp-data/add-as-inhouse') }}",
                                                data: "id="+$("#id<?php echo $i; ?>").val()+"&status=yes",
                                                success:function(result){				
                                                    $("div#selectedDataResult<?php echo $i;?>").html(result);
                                                }
                                            });	

                                        } else {
                                            text.style.display = "none";
                                            //alert("Hello worlsdsdsd");
                                            $.ajax({
                                                method: "GET",
                                                url: "{{ url('admin/wp-data/add-as-inhouse') }}",
                                                data: "id="+$("#id<?php echo $i; ?>").val()+"&status=no",
                                                success:function(result){				
                                                    $("div#selectedDataResult<?php echo $i;?>").html(result);
                                                }
                                            });	
                                        }
                                    }
                                </script>

                            </td>
                            <td> {{$q1->title}}

                                <br><?php echo $q1->hubspot_p_description_local; ?>
                            </td>
                            <td>{{$q1->sku}}</td>
                            <td>${{$q1->regular_price}}</td>
                            @if($q1->type == "variable")
                                <td colspan="2"><?php echo $q1->variable_product_price; ?></td>
                            @else
                                <td>$<?php echo $q1->canada_price; ?></td>
                                <td>$<?php echo $q1->ontario_price; ?></td>
                            @endif
                          

                            <td>  

                                <b>View Type</b> 
                                <select id="view_type<?php echo $i;?>" class="form-control">
                                    @foreach($view_type as $v)
                                    <option <?php if($v->value == $q1->view_type) echo "selected";  ?> value="{{$v->value}}">{{$v->view_type}}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" id="id<?php echo $i;?>" value="<?php echo $q1->id;?>">

                                <div id="view_type_res<?php echo $i;?>"></div>
                                <br>
                                <a  target="_blank" class="btn btn-success" href="{{route('admin.wpdata.manage.single.edit',['id'=>$q1->id])}}">Edit</a>
                                <br>
                                <script>
                                    
                                    $(document).ready(function() {
                                        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
                                        // function starts
                                        $("#view_type<?php echo $i;?>").click(function(){
                                                // alert('hey i am here');
                                            $.ajax({
                                                method: "GET",
                                                url: "{{ url('admin/wp-data/ajax/ViewTypeUpdate') }}",
                                                data: "view_type="+$("#view_type<?php echo $i;?>").val()+"&id="+$("#id<?php echo $i;?>").val(),
                                                success:function(result){				
                                                    $("div#view_type_res<?php echo $i;?>").html(result);
                                                }
                                            });	

                                        });
                                        // function ends
   
                                    });

                                </script>

                            </td>
                        </tr>
                        @php($i++)
                        @endforeach                
                    </form>
                </tbody>
            </table>
            <script>
                $('tbody').sortable(
                {
                    axis: 'y',
                    update: function (event, ui) {
                        var data = $(this).sortable('serialize');
                        //alert ("hello");
                        $.ajax({
                            data: data,
                            type: 'GET',
                            // url: '/check'
                            url: "{{route('check')}}"
                        });
                    }
                }
                );
            </script>

            
          

        </div>
    </div>
    
</div>

 
					 
@endsection



@section('js')
 
  
@endsection