@extends('admin.master')


@section('page-title')
<?php txt("Operation On multiple data"); ?>
@endsection

@section('title')
<?php txt("Operation On multiple data"); ?> 
@endsection

@section('middle-content')
 
   
<div class="card card-topline-green">
   
      
            <div class="panel-body">
                <div class="tab-content">
                    @include('admin.wpdatamanage.includes.data.all')
                </div>
            </div>
    
</div>


<script>
//redirect to specific tab
    $(document).ready(function () {
    $('#tabMenu a[href="#{{ old('tab') }}"]').tab('show')
    });
</script>		
 

					 
@endsection



@section('js')
 
  
@endsection