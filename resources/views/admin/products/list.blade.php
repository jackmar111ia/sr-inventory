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
                                    <th>Add Type</th>
                                    <th>Image</th>
                                    <th>Category</th>
                                    <th>Product Type</th>
                                    <th>Product Name</th>
                                    <th>Description</th>
                                    <th>SKU</th>
                                    <th>Certification</th>
                                    <th>Case Qty</th>
                                    <th>Regular Price</th>
                                    <th>Ontario Price</th>
                                    <th>Canada Price</th>
                                    <th>WB Price</th>
                                    <th>Variable Product Price</th>
                                    <th>Supplier SKU</th>
                                    <th>Supplier Description</th>
                                    <th>Inhouse Qty</th>
                                    <th>Available Qty</th>


                                </tr>
                            </thead>
                            <?php $i=0; ?>
                            @foreach($products as $product)
                                        
                            <tbody>


                                <tr class="odd gradeX">
                                    <td>{{ $loop->iteration }}.

                                        <button type="button" class="btn btn-primary btn-xs m-b-10 proShowAjaxBtn" data-toggle="modal" data-original-title="test" data-target="#proInfoShow" data-id="{{ $product->id}}" data-viewtype="pending">
                                            Review Deatails
                                        </button>
                                    </td>
                                    <td>
                                        @if($product->product_add_type == "manual")
                                        @php small_label("primary","Inhouse"); @endphp
                                        @else
                                        @php small_label("danger","SR Products"); @endphp
                                        <a href="{{route('admin.wpdata.manage.single.edit',[ 'id'=>$product->id ])}}"  target="_blank">View </a>
                                        @endif
                                    </td>
                                    <td> @php small_label("primary",$product->category->category); @endphp</td>
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
                                        
                                    <td><?php echo $product->sku; ?></td>
                                    <td><?php echo $product->certification; ?></td>
                                    <td><?php echo $product->case_qty; ?></td>
                                    <td><?php echo $product->regular_price; ?></td>
                                    <td><?php echo $product->ontario_price; ?></td>
                                    <td><?php echo $product->wb_price; ?></td>
                                    <td><?php echo $product->variable_product_price; ?></td>
                                    <td><?php echo $product->supplier_sku; ?></td>
                                    <td><?php echo $product->supplier_description; ?></td>
                                    <td><?php echo $product->inhouse_qty; ?></td>
                                    <td><?php echo $product->sold_qty; ?></td>
                                    <td><?php echo $product->aviable_qty; ?></td>
                                    
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
                                                        class="btn btn-danger btn-xs m-b-10" onclick="return submitconfirms()">
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


    
    {{-- pending gen info show modal--}}
    <div class="modal fade" id="proInfoShow" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title f-w-600" id="exampleModalLabel">Product Details</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body-proInfoShow">

                </div>
            </div>
        </div>
    </div>

    
   
    {{--prodcut info show--}}
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'csrftoken': '{{ csrf_token() }}'
                }
            });
            // function starts
            $(".proShowAjaxBtn").click(function() {

                var proid = $(this).data('id');
                 
                //alert("first value " + ownerId + "And second value is " + propertyId );
                $.ajax({
                    method: "GET", // post does not work 
                    url: "{{ url('admin/ajax/proInfoModalShow') }}",
                    data: {
                        proid: proid
                      
                    },

                    success: function(response) {
                        $('.modal-body-proInfoShow').html(response);
                        // $("div#CityResShow").html(result);
                        $('#proInfoShow').modal('show');

                    }
                });

            });
            // function ends
        });
    </script>

@endsection