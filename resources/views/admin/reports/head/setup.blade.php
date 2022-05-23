@extends('admin.master')

@section('page-title')
    <?php txt("Reports Setup"); ?>
@endsection

@section('title')
    <?php txt("Reports Setup"); ?>
@endsection

@section('middle-content')
   
<div class="col-sm-12">
        <div class="card card-topline-green">
             
            <div class="card-body ">
            <form method="post" action="{{route('admin.report.head.setup.management.save')}}">
                @csrf
                
                <div class="row">
                    <div class="col-lg-12">
                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Sorry !</strong> There were some problems with your area input.
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



                        
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group" >
                                    <label>Select Report For</label> 
                                    <select class="form-control"   name ="list_ctegory" id="category"  >
                                        <option   value="canada">Canada</option>
                                        <option   value="ontario">Ontario</option>
                                    </select>
                                    
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    
                                </div>
                            </div>
                        </div>
                        <div id="category_result">
                           
                        </div>
                            


                        
                
                        
                    </div>
                </div>
                



               
                
            </form>
                
            </div>
        </div>
    </div>
         

    <script  type="text/javascript">  
        function confirmModeratorBlock()
        {
            var agree=confirm("Do you really want to block this moderator?");
            if(agree)
            return true;
            else
            return false;
        }
    </script>   
 

    <script>
        $(document).ready(function() {
            $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
            // function starts
            $("#category").click(function(){
                //alert('hey i am here');
                $.ajax({
                    method: "GET",
                    url: "{{ url('admin/reports/setup/ajax/category') }}",
                    data: "category="+$("#category").val(),
                    success:function(result){				
                        $("div#category_result").html(result);
                    }
                });	

            });
            // function ends
 
        });
    </script>


@endsection
 

