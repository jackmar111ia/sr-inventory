@extends('admin.full_width_property.master')

@section('meta-description')
some text
@endsection

@section('page-title')          
    {{ __('List Product') }}
@endsection
 

@section('middle-content')
<!--- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-3.6.0/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.3/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.6/sb-1.3.3/sp-2.0.1/sl-1.4.0/sr-1.1.1/datatables.min.css"/>
 
<div class="row" style="margin:10px">
    <div class="col-md-12">
        <div class="card card-topline-green">
            <div class="panel-body">
                <div class="tab-content">
                    <div class="table-responsive">
                        <table id="table_id" class="table table-bordered display">
                            <thead class="text-center"> 
                                <tr>
                                    <th>Sl</th>
                                    <th>Add Type/
                                        <br>Product Type/
                                        <br>Category/
                                    </th>
                                    
                                    <th>Image</th>
                                    <th>Product name /
                                        <br>Description
                                    </th>
                                
                                    <th>SKU</th>
                                    <th>Certification</th>
                                    <th>Case Qty</th>
                                    <th>Regular Price</th>
                                    <th>Ontario Price</th>
                                    <th>Canada Price</th>
                                    <th>WB price</th>
                                    <th>Variable Product Price</th>
                                    <th>Supplier SKU</th>
                                    <th>Supplier Description</th>
                                    <th>Available Qty</th>
                                    <th>Sold Qty</th>
                                    <th>Operation</th>
                                </tr>
                                
                            </thead>
                            <tbody> <?php $i = 1;?>
                                @foreach($products as $product)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td valign="top" style="width:100px">
                                        @if($product->product_add_type != "manual")
                                        
                                        <a href="{{route('admin.wpdata.manage.single.edit',[ 'id'=>$product->id ])}}"  target="_blank"> @php small_label("danger","SR Products"); @endphp </a>
                                        @endif
                                        <?php clear(); ?>
                                        {{ $product->product_type->product_type }}
                                        <?php clear(); ?>
                                        @php small_label("primary",$product->category->category); @endphp
                                    </td> 
                                    <td>
                                        @if($product->pic_thumb == "no_thumb")
                                        No Picture
                                        @else
                                        <img src="{{ asset($product->pic_thumb) }}" width="50"> 
                                        @endif
                                    </td> 
                                    <td>
                                        <b>{{ $product->product_name }}</b> 
                                        <?php clear();   ?><hr/>
                                        <?php echo $product->description; ?>
                                    </td>
                                    <td>
                                        <?php echo $product->sku; ?>
                                    </td>
                                    <td>
                                        <?php echo $product->certification; ?>
                                    </td>
                                    <td><?php echo $product->case_qty; ?></td>

                                    <td><?php echo $product->regular_price; ?></td>
                                    <td><?php echo $product->ontario_price; ?></td>
                                    <td><?php echo $product->canada_price; ?></td>
                                    <td><?php echo $product->wb_price; ?></td>
                                    <td><?php echo $product->variable_product_price; ?></td>
                                    <td><?php echo $product->supplier_sku; ?></td>
                                    <td><?php echo $product->supplier_description; ?></td>
                                    <td><?php echo $product->aviable_qty; ?></td>
                                    <td><?php echo $product->sold_qty; ?></td>
                                    <td>
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
                                <?php $i = $i+1; ?>                            
                                @endforeach                                            
                            </tbody>
                        </table>
                    </div>
                <?php /* {{ $q->links() }}     */?>   
                </div>
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

    
    
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-3.6.0/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.3/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.6/sb-1.3.3/sp-2.0.1/sl-1.4.0/sr-1.1.1/datatables.min.js"></script>
    <script>
        $(document).ready( function () {
        $('#table_id').DataTable({
            scrollY: '400px',
            scrollX: true,
            scrollCollapse: true,
        });
    } );
    </script>
   
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