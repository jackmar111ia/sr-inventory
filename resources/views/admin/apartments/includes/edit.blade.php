@extends('admin.master')


@section('page-title')
<?php txt("Apartment Management"); ?>
@endsection

@section('title')
<?php txt("Apartment Management"); ?> 
@endsection

@section('middle-content')
 
   
<div class="card card-topline-green">
    
            <div class="panel-body">
                <div class="tab-content">
                    
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


            {!! Form::open(['url' => 'admin/apartment/edit','method'=>'post',  'role'=>'form', 'name'=>'editform']) !!}
            
                <div class="row g-0">
                    <div class="col-sm-2 col-md-2" style="text-align:right"><b><?php txt("Service Name");  ?></b></div>

                    <div class="col-6 col-md-6">  
                        <?php inputfield("","text","apartment_name","form-control",'apartment_name',$apartmentInfo->apartment_name,'',"Enter apartment Name",'','',"",''); ?>
                        
                    </div>

                    <div class="col-6 col-md-4">
                
                        
                    
                    </div>
                </div>
               <br>
                @if($apartmentInfo->client_apartment->name == '')
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-success">
                            {{ __('Update') }}
                        </button>
                        <input type="hidden" name="editId" value="{{ $apartmentInfo->id }}">
                    </div>
                </div>
                @else
                <font color='red'>Update CLosed</font>
                @endif

            
            {!! Form::close() !!}
        </div>
    </div>


    <script type="text/javascript">
      $(document).ready(function() {
        $('.summernote').summernote();
      });
    </script>

  
 
 
                </div>
            </div>
    
</div>


 

					 
@endsection



@section('js')
 
  
@endsection