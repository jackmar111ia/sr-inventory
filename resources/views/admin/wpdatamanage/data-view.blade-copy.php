@extends('admin.master')


@section('page-title')
<?php txt("Data Management"); ?>
@endsection

@section('title')
<?php txt("Data Management"); ?> 
@endsection

@section('middle-content')
 
   
<div class="card card-topline-green">
   
     
            <header class="panel-heading panel-heading-gray custom-tab ">
                <ul class="nav nav-tabs" id="tabMenu">
                     <li class="nav-item" class='error'><a href="#allProduct" data-toggle="tab" class="active">  <i class="fa fa-list"></i>  <?php txt("Simple Product"); ?></a>
                    </li>

                    <li class="nav-item" class='error'><a href="#simpleProduct" data-toggle="tab"  >  <i class="fa fa-list"></i>  <?php txt("Simple Product"); ?></a>
                    </li>
                    <li class="nav-item"><a href="#variableProduct" data-toggle="tab">   <i class="fa fa-list"></i> <?php txt("Variable Product"); ?> </a>
                    </li>

                   
                   

                </ul>
            </header>
            <div class="panel-body">
                <div class="tab-content">

                
                    <div class="tab-pane active" id="allProduct">
                        @include('admin.wpdatamanage.includes.data.all')
                         
                    </div>

                    <div class="tab-pane" id="simpleProduct">
                        @include('admin.wpdatamanage.includes.data.simple')
                         
                    </div>
 

                    <div class="tab-pane" id="variableProduct">
                    @include('admin.wpdatamanage.includes.data.variable')  
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