@extends('admin.master')

@section('page-title')
    <?php txt("Fetch SR Products"); ?>
@endsection

@section('title')
    <?php txt("Fetch SR Products"); ?>
@endsection

@section('middle-content')
 
      
<div class="col-sm-12">
        <div class="card card-topline-green">
             
            <div class="card-body ">
                
                 @php 
                $currentUser = Auth::user();
                //echo $currentUser; 
                //dd($customer);
                @endphp

                <div class="alert alert-warning" role="alert">
                    Exisisting local Data Qty <span class="badge bg-danger">{{$q}}</span><br>
                    After you fetch the new data from wp database , your previous setup will not be lost.
                    <br>You will have an option to add newly fetched data with old ones.
                </div>
               
                <iframe src="{{url('php_files/index.php')}}">Your browser isn't compatible</iframe>
              
                <?php /*
                <a href="{{route('admin.wpdata.manage.fetched.filter')}}" onclick="return OnclickFetchConfirm()" class="btn btn-success"> Fetch Data From SR Site </a>
                   */ ?>
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


