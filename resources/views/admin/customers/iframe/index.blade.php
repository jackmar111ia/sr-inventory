@extends('admin.master')

@section('page-title')
    <?php txt("Fetch SR customers"); ?>
@endsection

@section('title')
    <?php txt("Fetch SR customers"); ?>
@endsection

@section('middle-content')
 
      
<div class="col-sm-12">
        <div class="card card-topline-green">
             
            <div class="card-body ">
                 
                <div class="alert alert-warning" role="alert">
                    Exisisting local Data Qty <span class="badge bg-danger">{{$q}}</span><br>
                    After you fetch the new data from wp database , your previous setup will not be lost.
                    <br>You will have an option to add newly fetched data with old ones.
                </div>
                <?php /*
                <iframe src="{{url('php_files/customers/index.php')}}">Your browser isn't compatible</iframe>
                */ ?>
                
                <a href="{{route('admin.customer.management.fetch.preview')}}" onclick="return OnclickFetchConfirm()" class="btn btn-success">  Customers Preview from SR </a>
                 
                <script  type="text/javascript">  
                    function OnclickFetchConfirm()
                    {
                        var agree=confirm("Do you really want to proceed?");
                        if(agree)
                        return true;
                        else
                        return false;
                    }
                </script> 
                
            </div>
        </div>
    </div>
         

    

@endsection


