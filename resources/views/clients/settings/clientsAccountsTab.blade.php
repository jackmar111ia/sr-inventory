@extends('clients.master')

@section('page-title')
    <?php txt("Account Settings"); ?>
@endsection

@section('title')
    <?php txt("Account Settings"); ?>
@endsection

@section('middle-content')
<?php $GenInfoStatus =  GenInfoAlertUser(Auth::user()->id);

$clientId = Auth::user()->id;
$clientInfo = clientInfo($clientId);


?> 
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="panel tab-border ">
            <header class="panel-heading panel-heading-gray custom-tab ">
                <ul class="nav nav-tabs" id="tabMenu">
                     
                   

                    <li class="nav-item"><a href="#PasswordChange" data-toggle="tab" class="active"> <?php txt("Change Password"); ?> </a>
                    </li>

                    <li class="nav-item"><a href="#AccountsInfo" data-toggle="tab" > <?php txt("Account Info"); ?> </a>
                    </li>

                    <?php /*
                    <li class="nav-item"><a href="#updateViewGeneralInfo" data-toggle="tab"> <?php txt("General Info Update"); ?> </a>
                    </li>
                    */ ?>

                   
                </ul>
            </header>
            <div class="panel-body">
                <div class="tab-content">

                    <div class="tab-pane active" id="PasswordChange">
                        @include('clients.settings.includes.changePassword')
                    </div>



                    <div class="tab-pane" id="AccountsInfo">
                    @include('clients.settings.includes.accountsInfo') 
                        <?php clear();?>
                    </div>


                    
                    <div class="tab-pane" id="updateViewGeneralInfo">
                        <div class="alert label-warning alert-dismissible" >
                            <strong> <i class="fa fa-info-circle" aria-hidden="true"></i> </strong> 
                           <?php  txt("You can update information as many times as you want, but till before sending it for publishment to admin. Once you have sent the information, update will remain locked untill admin approves it.");?> 
                            <?php clear(); ?>
                          
                        </div> <?php //echo $GenInfoStatus; ?>
                         

                        @if($GenInfoStatus == "saved") 
                       
                            @include('clients.settings.includes.genInfoDraftView')
                        @endif

                        @if($GenInfoStatus == "locked")
                              @include('clients.settings.includes.genInfoSentView')  
                         @endif


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