{{ $all->links() }} 
    <div class="table-responsive">
        <form method="post" action="{{route('admin.wpdata.edit.save')}}">
        @csrf

            <input type="submit" value="Save Multiple Update" class="btn btn-success">
            
            <table class="table table-bordered table-striped">
                
                <tbody> 
                    <?php $i = 1;?>
                    @foreach($all as $q1)
                    <tbody>
                        <tr style="background:#999">
                            <td colspan = "4">

                                <div style="float:left">
                                    #SL: {{ $i }} | wp-id: {{$q1->wp_id}} | <a href="<?php echo $q1->permalink; ?>" style="color:blue" target="_blank">
                                    View Product on web</a> |   
                                    <a href="{{route('admin.wpdata.manage.reset',['id'=> $q1->id])}}" class="btn btn-success"> Undo Update </a> 
                                    <a href="{{route('admin.wpdata.manage.refetch.from.web',['wp_id'=> $q1->wp_id])}}" class="btn btn-danger"> Refetch </a> 

                                    

                                    <a  target="_new" class="btn btn-success" href="{{route('admin.wpdata.manage.single.edit',['id'=>$q1->id])}}">Single Edit</a>

                                </div>

                            </td>

                           
                           
                        </tr>
                    </tbody>

                    <tr>
                        <td valign="top">
                            <div id="selectedDataResult<?php echo $i; ?>">
                                <img src="{{asset($q1->resize_image)}}" width="100" target="_new" style="align:top" > 
                            </div>
                            
                            <?php clear(); ?>
                            <b> Type:</b> 
                            @if($q1->type == "variable") 
                            <span class="badge bg-primary">{{$q1->type}}</span>
                            @else
                            <span class="badge bg-danger">{{$q1->type}}</span>
                            @endif

                            <br>

                            <input type="checkbox" id="myCheck<?php echo $i; ?>" onclick="shortList<?php echo $i;?>()"  <?php if($q1->view_status == "yes") echo "checked";?>> Select
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
                                            url: "{{ url('admin/wp-data/ajax/ViewStatusUpdate') }}",
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
                                            url: "{{ url('admin/wp-data/ajax/ViewStatusUpdate') }}",
                                            data: "id="+$("#id<?php echo $i; ?>").val()+"&status=no",
                                            success:function(result){				
                                                $("div#selectedDataResult<?php echo $i;?>").html(result);
                                            }
                                        });	
                                    }
                                }
                            </script>

                        </td>  
                        <td>
                        
                            <b>Title</b>  
                            <?php textareaBox("","title[]",'','','Please write if you have any additional message','3','',$q1->title,'',''); ?>
                            <div style="width:400px">
                            <b>Short description</b> 
                            <?php textareaEditor("","des[]",'summernote','','','',2,3,$q1->short_des,'required',''); ?>
                            <input type="hidden" name="id[]" value="{{$q1->id}}">
                            </div>
                            <?php clear();?>
                        </td>    
                        
                        <td>
                            
                            <b>SKU</b> <br>
                                <?php  inputfield("","text","sku[]","form-control",'name',$q1->sku,'',"",'','',"","'','','','',$errors");   ?>
                            
                            <b>Regular Price</b> <br>
                            <?php  inputfield("","text","rp[]","form-control",'name',$q1->regular_price,'',"",'','',"","'','','','',$errors");   ?>

                            <b>Canada Price</b> <br>
                            <?php  inputfield("","text","cp[]","form-control",'name',$q1->canada_price,'',"",'','',"","'','','','',$errors");   ?>
                            <b>Ontario Price</b> <br>
                            <?php  inputfield("","text","op[]","form-control",'name',$q1->ontario_price,'',"",'','',"","'','','','',$errors");   ?>
                            <b>Variable Product Price</b> <br>
                            <?php textareaEditor("","vprice[]",'summernote','','','',2,3,$q1->variable_product_price,'',''); ?>
                        </td>
                    
                    </tr>  
                    <?php $i = $i+1; ?>                            
                    @endforeach                                            
                </tbody>
            </table>
        </form>
        {{ $all->links() }}

    </div>
                
     
    <script type="text/javascript">
      $(document).ready(function() {
        $('.summernote').summernote();
      }).on("summernote.enter", function(we, e) {
        $(this).summernote("pasteHTML", "<br><br>");
        e.preventDefault();
        });	 
    </script>
  


