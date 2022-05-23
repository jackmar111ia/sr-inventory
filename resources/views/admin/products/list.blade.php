@extends('admin.master')

@section('meta-description')
some text
@endsection

@section('page-title')
    {{ __('List Product') }}
@endsection


@section('title')
    {{ __('List Product') }} 
    
    <?php /* <a href="{{ route('softwareSetup.country.list') }}" class="btn btn-info"> <i class='fas fa-list'></i> Country List</a> */ ?>
@endsection

@section('middle-content')
    <div class="card card-topline-green">
        <div class="panel-body">
            <div class="tab-content">
                 
                    
                    <div>
                        <!---------Child Retrieve------>
                            <div class="table-scrollable">
                                <table class="table table-bordered table-striped table-responsive">
                                 
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Image</th>
                                            <th>Category</th>
                                            <th>Product Type</th>
                                            <th>Product Name</th>
                                            <th>Description</th>
                                        </tr>
                                    </thead>
                                    <?php $i=0; ?>
                                    @foreach($products as $product)
                                                
                                    <tbody>
                                        <tr class="odd gradeX">
                                            <td>{{ $loop->iteration }}.</td>

                                            <td>{{ $product->category->category }} </td>
                                            <td>{{ $product->product_type->product_type }}</td>

                                            
                                            <td>
                                                @if($product->pic_thumb == "no_thumb")
                                                No Picture
                                                @else
                                                <img src="{{ asset($product->pic_thumb) }}" width="50"> 
                                                @endif
                                            </td>
                                            <td>{{ $product->product_name }} </td>
                                            <td><?php echo $product->description; ?></td>
                                            
                                            <td class="center">

                                                <div class="btn-group">
                                                   
                                                        <a href="{{ route('admin.product.management.details',['id'=> $product->id]) }}" 
                                                                class="btn btn-primary btn-xs m-b-10">
                                                                <i class="fa fa-search" aria-hidden="true"></i> <?php txt("Details");?>
                                                        </a>
                                                        <a href="{{ route('admin.product.management.update',['id'=> $product->id]) }}" 
                                                                class="btn btn-success btn-xs m-b-10">
                                                                <i class="fa fa-pencil" aria-hidden="true"></i> <?php txt("Edit");?>
                                                        </a>
                                                    
                                                        <!--
                                                        Booking cancel is possible till before checkIn Date
                                                        --!-->
                                                        <a href="{{ route('admin.product.management.delete',['id'=> $product->id]) }}" 
                                                                class="btn btn-danger btn-xs m-b-10">
                                                                <i class="fa fa-times" aria-hidden="true"></i> <?php txt("Delete");?>
                                                        </a>
                                                        
                                                    
                                                </div>
                                                 
                                                 
                                            
                                            
                                            </td>
                                        </tr>
                                    </tbody>
                                    @endforeach
                                    
                                </table>
                            
                                <script type="text/javascript">
                                function submitconfirms()
                                {
                                var agree=confirm("Do you want to delete it finally?");
                                if (agree)
                                    return true ;
                                else
                                    return false ;
                                }
                                </script> 

                            </div>
                            
                            <!---------Child Retrieve------>
                    </div>

               

            </div>
        </div>  
    </div>

@endsection