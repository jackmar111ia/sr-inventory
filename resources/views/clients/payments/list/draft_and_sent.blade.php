@extends('clients.master')

@section('page-title')
    <?php txt("Draft & Sent"); ?>
@endsection

@section('title')
    <?php txt("Draft & Sent"); ?>
@endsection

@section('middle-content')
<?php $GenInfoStatus =  GenInfoAlertUser(Auth::user()->id);  

?>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="panel tab-border ">
            <header class="panel-heading panel-heading-gray custom-tab ">
                <ul class="nav nav-tabs" id="tabMenu">
                     
                   

                    <li class="nav-item"><a href="#draft" data-toggle="tab" class="active"> <?php txt("Draft"); ?> </a>
                    </li>

                    <li class="nav-item"><a href="#sent" data-toggle="tab" > <?php txt("Sent"); ?> </a>
                    </li>


                   
                </ul>
            </header>
            <div class="panel-body">
                <div class="tab-content">

                    <div class="tab-pane active" id="draft">
                    @include('clients.payments.list.includes.draft')
                    </div>



                    <div class="tab-pane" id="sent">
                        @include('clients.payments.list.includes.sent')
                        <?php clear();?>
                    </div>

                     
                </div>
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
   @include('common.includes.commonJSModalPlusDataTable')
   @include('clients.payments.modalForDetails')
  


@endsection