@if($option == 'selectedDataView')
   
     
    
    <form method="post" action="{{route('admin.wpdata.edit.save')}}">
    @csrf
    <h4 style="background:#999; padding:5px; font-weight:bold:text-align:center">Data from sl {{$edit_from}} - {{$edit_to}} <input  style="float:right" type="submit" value="Save" class="btn btn-success"></h4>
        @foreach($q as $q1)
        <fieldset><legend style="background:red; color:#fff"><b>#sl -  {{$q1->id}} </b> </legend>
        <table class="table table-bordered table-striped">
           
           
            <tbody>  
                
                <tr>
                    <td v-align="top">
                        <b>Title</b> <br>
                        <?php textareaBox("","title[]",'','','Please write if you have any additional message','3','',$q1->title,'',''); ?>
                        <br><b>SKU</b> <br>
                        <?php  inputfield("","text","sku[]","form-control",'name',$q1->sku,'',"",'','',"","'','','','',$errors");   ?>

                        <br><b>Regular Price</b> <br>
                        <?php  inputfield("","text","rp[]","form-control",'name',$q1->regular_price,'',"",'','',"","'','','','',$errors");   ?>

                        <br><b>Canada Price</b> <br>
                        <?php  inputfield("","text","cp[]","form-control",'name',$q1->canada_price,'',"",'','',"","'','','','',$errors");   ?>
                        <br><b>Ontario Price</b> <br>
                        <?php  inputfield("","text","op[]","form-control",'name',$q1->ontario_price,'',"",'','',"","'','','','',$errors");   ?>
                        
                        @if($q1->type == "variable") 
                          
                            <br><b>Variable Product Price</b> <br>
                            <?php textareaEditor("","vprice[]",'summernote','','','',2,3,$q1->variable_product_price,'required',''); ?>
                        @else
                            <input type="hidden" name="vprice[]" value="">
                        @endif
                        
                        <input type="hidden" name="id[]" value="{{$q1->id}}">
                    </td>
                
                
                    <td> <img src="<?php echo $q1->image; ?>" width="100" target="_new" style="align:top" > <a href="<?php echo $q1->permalink; ?>" target="_blank">Visit product</a>
                        <br>
                        <div style="width:500px">
                            <?php textareaEditor("","des[]",'summernote','','','',2,3,$q1->short_des,'required',''); ?>
                        </div>
                    </td> 
                    
                </tr>  
                 
                                        
                                                    
            </tbody>
        </table>
       
        </fieldset>
        <br>
        </hr>

        @endforeach     

        <input type="hidden" name="from" value="{{$edit_from}}">
        <input type="hidden" name="to" value="{{$edit_to}}">
 
        </form>
    <script type="text/javascript">
      $(document).ready(function() {
        $('.summernote').summernote();
      });
    </script>
@endif
@if($option == 'uploadedImgaeShow')
<img src="{{asset($q2->resize_image)}}" width="100" target="_new" style="align:top" >
@endif
 