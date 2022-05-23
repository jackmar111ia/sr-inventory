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
                                <table class="table table-striped table-hover" >
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Image</th>
                                            <th>Product Name</th>
                                            <th>Description</th>
                                        </tr>
                                    </thead>
                                    <?php $i=0; ?>
                                    @foreach($products as $product)
                                                
                                    <tbody>
                                        <tr class="odd gradeX">
                                            <td>{{ $loop->iteration }}.</td>
                                            
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
                                                 
                                                <?php  
                                                
                                                linkwithfaicon ("admin.product.management.update",$product->id,"Update Product",'','','','',
                                                'pencil','',"","",
                                                'no',"",'success','','');
                                                
                                                ?>

                                                <?php  
                                                /*
                                                linkwithfaicon ("softwareSetup.city.list.delete",$SingleCity->id,"Delete City",'','','','',
                                                'trash','',"","",
                                                'yes',"",'danger','white','');*/
                                                ?>
                                            
                                            
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