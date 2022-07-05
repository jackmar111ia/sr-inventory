@extends('admin.master')

@section('meta-description')
some text
@endsection

@section('page-title')
    {{ __('Edit Product') }}
@endsection


@section('title')
    {{ __('Edit Product') }} 
    
    <?php /* <a href="{{ route('softwareSetup.country.list') }}" class="btn btn-info"> <i class='fas fa-list'></i> Country List</a> */ ?>
@endsection

@section('middle-content')
 
<div class="card card-topline-green">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-6">
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
                
                @if(session('success'))
                    <div class="alert alert-success">
                    {{ session('success') }}
                    </div> 
                @endif

                {!! Form::open(['url' => 'admin/product/update','method'=>'post', 'enctype'=> 'multipart/form-data', 'role'=>'form', 'name'=>'editform']) !!}
                @csrf
                    <div class="form-group" >
                        <b>Select Category</b> 
                        <select name="category_id" class="form-control" >
                            <option value="" selected>Select category......</option>
                                @foreach($categories as $q1)
                                    @if((old('category_id') == $q1->id) OR ($EditableRow->category_id == $q1->id))
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
                        @php  //dd($EditableRow->producy_type_id); @endphp
                        <select name="product_type_id" class="form-control" >
                            <option value="" selected>Select Type......</option>
                                @foreach($producttypes as $q1)
                                    @if ((old('product_type_id') == $q1->id) OR ($EditableRow->product_type_id == $q1->id))
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
                        inputfield("Product Name","text","product_name","form-control",'product_name',$EditableRow->product_name,'',"Enter product name",'','',"",''); ?>
                        @php isError($errors,'product_name') @endphp
                    </div>       
                        
                        
                    <div class="form-group">
                        <?php textareaEditor("Description","description",'summernote','','','',2,3,$EditableRow->description,'',''); ?>
                        @php isError($errors,'description') @endphp
                    </div>

                    
                    <div class="form-group">
                        <label>Picture Update</label><br>
                        <img src="{{ asset($EditableRow->pic_large) }}" style="max-width:150px" class="img-responsive">
                        <input  type="file"   name="picture"  class = "form-control" >
                        
                    </div>


                    <div class="form-group">
                        <?php textareaEditor("SKU","sku",'summernote','','','',2,3,$EditableRow->sku,'',''); ?>
                        @php isError($errors,'sku') @endphp
                    </div>
                    <div class="form-group">
                        <?php textareaEditor("Certification","certification",'summernote','','','',2,3,$EditableRow->certification,'',''); ?>
                        @php isError($errors,'certification') @endphp
                    </div>
                   
                    <div class="form-group">
                        <?php textareaEditor("Case Qty","case_qty",'summernote','','','',2,3,$EditableRow->case_qty,'',''); ?>
                       
                        @php isError($errors,'case_qty') @endphp
                    </div>

                    <div class="form-group">
                        <?php  inputfield("Regular Price","text","regular_price","form-control",'regular_price',$EditableRow->regular_price,'',"0",'','',"","'','','','',$errors");   ?>
                        @php isError($errors,'regular_price') @endphp
                    </div>

                    <div class="form-group">
                        <?php  inputfield("Canada Price","text","canada_price","form-control",'canada_price',$EditableRow->canada_price,'',"0",'','',"","'','','','',$errors");   ?>
                        @php isError($errors,'canada_price') @endphp
                    </div>

                    <div class="form-group">
                        <?php  inputfield("Ontario Price","text","ontario_price","form-control",'ontario_price',$EditableRow->ontario_price,'',"0",'','',"","'','','','',$errors");   ?>
                        @php isError($errors,'ontario_price') @endphp
                    </div>

                    <div class="form-group">
                        <?php  inputfield("WP price","text","wb_price","form-control",'wb_price',$EditableRow->wb_price,'',"0",'','',"","'','','','',$errors");   ?>
                        @php isError($errors,'wb_price') @endphp
                    </div>
                    <?php /*
                    <div class="form-group">
                        <?php  PublicationStatus('Publication Status','addform',0,'pstatus'); ?>
                    </div>
                      */?>

                    <div class="form-group">
                        <?php textareaEditor("Supplier SKU","supplier_sku",'summernote','','','',2,3,$EditableRow->supplier_sku,'',''); ?>
                       
                        @php isError($errors,'supplier_sku') @endphp
                    </div>

                    <div class="form-group">
                        <?php textareaEditor("Supplier Description","supplier_description",'summernote','','','',2,3,$EditableRow->supplier_description,'',''); ?>
                       
                        @php isError($errors,'supplier_description') @endphp
                    </div>

                    <div class="form-group">
                        <?php  inputfield("Avialable Qty","text","aviable_qty","form-control",'aviable_qty',$EditableRow->aviable_qty,'',"0",'','',"","'','','','',$errors");   ?>
                        @php isError($errors,'aviable_qty') @endphp
                    </div>
                    
                    <div class="form-group">
                        <?php  inputfield("Sold Qty","text","sold_qty","form-control",'sold_qty',$EditableRow->sold_qty,'',"0",'','',"","'','','','',$errors");   ?>
                        @php isError($errors,'sold_qty') @endphp
                    </div>

                   

                    

                 
                    <div class="form-group">
                        <?php submitBtn('','success',"Submit",'');?>
                        <input type="hidden" value="{{$EditableRow->id}}" name="EditableProductId" >
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
    
    

@endsection