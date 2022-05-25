@extends('admin.master')


@section('page-title')
<?php txt("Category Management"); ?>
@endsection

@section('title')
<?php txt("Category Management"); ?> 
@endsection

@section('middle-content')
 
   
<div class="card card-topline-green">
   
     
            <header class="panel-heading panel-heading-gray custom-tab ">
                <ul class="nav nav-tabs" id="tabMenu">
                    
                    <li class="nav-item" class='error'><a href="#Add" data-toggle="tab" class="active"><i class="fa fa-plus"></i> <?php txt("Add Category"); ?></a>
                    </li>
                    <li class="nav-item"><a href="#List" data-toggle="tab">   <i class="fa fa-list"></i> <?php txt("List"); ?> </a>
                    </li>

                   
                   

                </ul>
            </header>
            <div class="panel-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="Add">
                        @include('admin.category.includes.add')
                         
                    </div>
 

                    <div class="tab-pane" id="List">
                    @include('admin.category.includes.list')  
                    </div>
 
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