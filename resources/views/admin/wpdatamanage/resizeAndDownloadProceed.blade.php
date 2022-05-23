@extends('admin.master')

@section('page-title')
    <?php txt("Download & resize product Images"); ?>
@endsection

@section('title')
    <?php txt("Download & resize product Images"); ?>
@endsection

@section('middle-content')
 
      
<div class="col-sm-12">
        <div class="card card-topline-green">
             
            <div class="card-body ">
                 
                @php 
                 //echo $product['short_description'];
                 //dd($product);
                $currentUser = Auth::user();
                //echo $currentUser; 
                @endphp
                
                    <div class="alert alert-warning" role="alert">
                    Downloaded & Resized Image Qty <span class="badge bg-success">{{$donloaded}}</span><br>
                    Images are waiting to resize and download  <span class="badge bg-danger">{{$pending}}</span><br>
                    </div>
                @if($pending > 0)
                    <form name="f1" method="post" action="{{route('admin.wpdata.manage.download.resize.action')}}">
                    @csrf  
                     
                    <b>Select Qty</b>
                    <select name="qty"  class="form-control" style="width:200px">
                        <?php for($i=0; $i<=$pending; $i++){?>
                        <option value="{{$i}}">{{$i}}</option>
                        <?php } ?>
                    </select>
                    <br>
                   
                     
                        <input type="submit"  onclick="return OnclickFetchConfirm()" class="btn btn-success" value="Download & Resize {{$pending}} Data">
                    </form>
                @endif

                            
                
            </div>
        </div>
    </div>
         

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
 


@endsection


