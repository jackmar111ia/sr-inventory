 
    <div class="row">
        <div class="col-lg-12">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Sorry !</strong> There were some problems with your input.
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


            {!! Form::open(['url' => 'admin/category/add/save','method'=>'post',  'role'=>'form', 'name'=>'addform']) !!}
            
                <div class="row g-0">
                    <div class="col-sm-2 col-md-2" style="text-align:right"><b><?php txt("Category Name");  ?></b></div>

                    <div class="col-6 col-md-6">  
                        <?php inputfield("","text","category","form-control",'category','','',"Enter category Name",'','',"",''); ?>
                        
                    </div>

                    <div class="col-6 col-md-4">
                
                        
                    
                    </div>
                </div>
               <br>
                <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Save') }}
                                </button>
                                <input type="hidden" name="editId" value="0">
                            </div>
                        </div>

            
            {!! Form::close() !!}
        </div>
    </div>


    <script type="text/javascript">
      $(document).ready(function() {
        $('.summernote').summernote();
      });
    </script>

  
 