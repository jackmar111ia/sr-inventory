@extends('admin.master')

@section('meta-description')
some text
@endsection

@section('page-title')
    {{ __('Create Product') }}
@endsection


@section('title')
    {{ __('Create Product') }} 
    
    <?php /* <a href="{{ route('softwareSetup.country.list') }}" class="btn btn-info"> <i class='fas fa-list'></i> Country List</a> */ ?>
@endsection

@section('middle-content')
 
<div class="card card-topline-green">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-6">
                <?php /*
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Sorry !</strong> There were some problems with your country input.
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
                @endif

                */ ?>
                @if(session('success'))
                    <div class="alert alert-success">
                    {{ session('success') }}
                    </div> 
                @endif

                {!! Form::open(['url' => 'admin/product/save','method'=>'post', 'enctype'=> 'multipart/form-data', 'role'=>'form', 'name'=>'addform']) !!}
                @csrf
                    <div class="form-group" >
                        <b>Select Category</b> 
                        <select name="category_id" class="form-control" >
                            <option value="" selected>Select category......</option>
                                @foreach($categories as $q1)
                                    @if (old('category_id') == $q1->id)
                                        <option value="{{ $q1->id }}" selected>{{ $q1->category }}</option>
                                    @else
                                        <option value="{{ $q1->id }}">{{ $q1->category }}</option>
                                    @endif
                            
                                @endforeach
                        </select>
                        @php isError($errors,'category_id') @endphp
                    </div>

                    <div class="form-group" >
                        <b>Select Product Type</b> 
                        <select name="product_type_id" class="form-control" >
                            <option value="" selected>Select Type......</option>
                                @foreach($producttypes as $q1)
                                    @if (old('product_type_id') == $q1->id)
                                        <option value="{{ $q1->id }}" selected>{{ $q1->product_type }}</option>
                                    @else
                                        <option value="{{ $q1->id }}">{{ $q1->product_type }}</option>
                                    @endif
                            
                                @endforeach
                        </select>
                        @php isError($errors,'product_type_id') @endphp
                       
                    </div>


                    
                    
                    <div class="form-group">
                        <?php //SelectOptionWithArray('Publised,Unpublished','1,0','Publication Status','addform',0,'pstatus');
                        inputfield("Product Name","text","product_name","form-control",'product_name','','',"Enter product name",'','',"",''); ?>
                        @php isError($errors,'product_name') @endphp
                    </div>       
                        
                        
                    <div class="form-group">
                        <?php textareaEditor("Description","description",'summernote','','','',2,3,'','',''); ?>
                        @php isError($errors,'description') @endphp
                    </div>

                    <div class="form-group">
                            <b>Image</b>
                            <input  type="file" class="form-control"  name="picture" >
                        
                    </div>

                    <div class="form-group">
                        <?php textareaEditor("SKU","sku",'summernote','','','',2,3,'','',''); ?>
                        @php isError($errors,'sku') @endphp
                    </div>
                    <div class="form-group">
                        <?php textareaEditor("Certification","certification",'summernote','','','',2,3,'','',''); ?>
                        @php isError($errors,'certification') @endphp
                    </div>
                   
                    <div class="form-group">
                        <?php textareaEditor("Case Qty","case_qty",'summernote','','','',2,3,'','',''); ?>
                       
                        @php isError($errors,'case_qty') @endphp
                    </div>

                    <div class="form-group">
                        <?php  inputfield("Regular Price","text","regular_price","form-control",'regular_price',0,'',"0",'','',"","'','','','',$errors");   ?>
                        @php isError($errors,'regular_price') @endphp
                    </div>

                    <div class="form-group">
                        <?php  inputfield("Canada Price","text","canada_price","form-control",'canada_price',0,'',"0",'','',"","'','','','',$errors");   ?>
                        @php isError($errors,'canada_price') @endphp
                    </div>

                    <div class="form-group">
                        <?php  inputfield("Ontario Price","text","ontario_price","form-control",'ontario_price',0,'',"0",'','',"","'','','','',$errors");   ?>
                        @php isError($errors,'ontario_price') @endphp
                    </div>

                    <div class="form-group">
                        <?php  inputfield("WP price","text","wb_price","form-control",'wb_price','','',"0",'','',"","'','','','',$errors");   ?>
                        @php isError($errors,'wb_price') @endphp
                    </div>
                    <?php /*
                    <div class="form-group">
                        <?php  PublicationStatus('Publication Status','addform',0,'pstatus'); ?>
                    </div>
                      */?>

                    <div class="form-group">
                        <?php textareaEditor("Supplier SKU","supplier_sku",'summernote','','','',2,3,'','',''); ?>
                       
                        @php isError($errors,'supplier_sku') @endphp
                    </div>

                    <div class="form-group">
                        <?php textareaEditor("Supplier Description","supplier_description",'summernote','','','',2,3,'','',''); ?>
                       
                        @php isError($errors,'supplier_description') @endphp
                    </div>

                    <div class="form-group">
                        <?php  inputfield("Inhouse Qty","text","inhouse_qty","form-control",'regular_price','','',"0",'','',"","'','','','',$errors");   ?>
                        @php isError($errors,'inhouse_qty') @endphp
                    </div>

                    <div class="form-group">
                        <?php  inputfield("Sold Qty","text","sold_qty","form-control",'regular_price','','',"0",'','',"","'','','','',$errors");   ?>
                        @php isError($errors,'sold_qty') @endphp
                    </div>

                    <div class="form-group">
                        <?php  inputfield("Avialable Qty","text","aviable_qty","form-control",'regular_price','','',"0",'','',"","'','','','',$errors");   ?>
                        @php isError($errors,'aviable_qty') @endphp
                    </div>

                    

                 
                    <div class="form-group">
                        <?php submitBtn('','success',"Submit",'');?>
                        <input type="hidden" value="0" name="EditableProductId" id="0">
                    </div>
                  
                
                {!! Form::close() !!}
            </div>
        </div>


    </div>  
</div>
   
    
    <script type="text/javascript">
      $(document).ready(function() {
        $('.summernote').summernote();
      }).on("summernote.enter", function(we, e) {
        $(this).summernote("pasteHTML", "<br><br>");
        e.preventDefault();
        });	 
    </script>
    
    <?php  /*
    <script>
        $(document).ready(function() {
            $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
            // function starts
            $("#product_type").click(function(){
                //alert('hey i am here');
                $.ajax({
                    method: "GET",
                    url: "{{ url('admin/products/setup/ajax/category') }}",
                    data: "product_type="+$("#product_type").val()+"&EditableProductId="+$("#EditableProductId").val(),
                    success:function(result){				
                        $("div#category_result").html(result);
                    }
                });	

            });
            // function ends
 
        });
    </script>

    */ ?>

@endsection