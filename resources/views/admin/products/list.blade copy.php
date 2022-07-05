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


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-3.6.0/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.3/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.6/sb-1.3.3/sp-2.0.1/sl-1.4.0/sr-1.1.1/datatables.min.css"/>
 

</head>
<body>
    <div class="container">
    
    <table id="table_id" class="table table-bordered display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>FathersName</th>
                <th>MothersName</th>
                <th>DOB</th>
                <th>NID</th>
                <th>PS</th>
                <th>PO</th>
                <th>SSC</th>
                <th>HSC</th>
                <th>BSC</th>
                <th>MSC</th>
                <th>Passport</th>
                  <th>Phone</th>
                    <th>Email</th>
                      <th>Quota</th>
                        <th>Institution</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Dhiman</td>
                <td>Dr. Anadi</td>
                <td>Bina</td>
                <td>2\1\1998</td>
                <td>1598776</td>
                <td>Double mooring</td>
                   <td>GPO</td>
                    <td>4.69</td>
                     <td>4.00</td>
                      <td>3.06</td>
                       <td>3.54</td>
                        <td>543211</td>
                        <td>01832355230</td>
                        <td>dhiman.nath.cse@gmail.com</td>
                          <td>NON</td>
                            <td>Premier</td>
            </tr>
            <tr>
                 <td>1</td>
                <td>Dhiman</td>
                <td>Dr. Anadi</td>
                <td>Bina</td>
                <td>2\1\1998</td>
                <td>1598776</td>
                <td>Double mooring</td>
                <td>GPO</td>
                <td>4.69</td>
                     <td>4.00</td>
                      <td>3.06</td>
                       <td>3.54</td>
                        <td>543211</td>
                        <td>01832355230</td>
                        <td>dhiman.nath.cse@gmail.com</td>
                          <td>NON</td>
                            <td>Premier</td>
            </tr>
            <tr>
                 <td>1</td>
                <td>Dhiman</td>
                <td>Dr. Anadi</td>
                <td>Bina</td>
                <td>2\1\1998</td>
                <td>1598776</td>
                <td>Double mooring</td>
                <td>GPO</td>
                <td>4.69</td>
                     <td>4.00</td>
                      <td>3.06</td>
                       <td>3.54</td>
                        <td>543211</td>
                        <td>01832355230</td>
                        <td>dhiman.nath.cse@gmail.com</td>
                          <td>NON</td>
                            <td>Premier</td>
            </tr>
            <tr>
                 <td>1</td>
                <td>Dhiman</td>
                <td>Dr. Anadi</td>
                <td>Bina</td>
                <td>2\1\1998</td>
                <td>1598776</td>
                <td>Double mooring</td>
                <td>GPO</td>
                <td>4.69</td>
                     <td>4.00</td>
                      <td>3.06</td>
                       <td>3.54</td>
                        <td>543211</td>
                        <td>01832355230</td>
                        <td>dhiman.nath.cse@gmail.com</td>
                          <td>NON</td>
                            <td>Premier</td>
            </tr>
            <tr>
                 <td>1</td>
                <td>Dhiman</td>
                <td>Dr. Anadi</td>
                <td>Bina</td>
                <td>2\1\1998</td>
                <td>1598776</td>
                <td>Double mooring</td>
                <td>GPO</td>
                <td>4.69</td>
                     <td>4.00</td>
                      <td>3.06</td>
                       <td>3.54</td>
                        <td>543211</td>
                        <td>01832355230</td>
                        <td>dhiman.nath.cse@gmail.com</td>
                          <td>NON</td>
                            <td>Premier</td>
            </tr>
            <tr>
                 <td>1</td>
                <td>Dhiman</td>
                <td>Dr. Anadi</td>
                <td>Bina</td>
                <td>2\1\1998</td>
                <td>1598776</td>
                <td>Double mooring</td>
                <td>GPO</td>
                <td>4.69</td>
                     <td>4.00</td>
                      <td>3.06</td>
                       <td>3.54</td>
                        <td>543211</td>
                        <td>01832355230</td>
                        <td>dhiman.nath.cse@gmail.com</td>
                          <td>NON</td>
                            <td>Premier</td>
            </tr>
            <tr>
                 <td>1</td>
                <td>Dhiman</td>
                <td>Dr. Anadi</td>
                <td>Bina</td>
                <td>2\1\1998</td>
                <td>1598776</td>
                <td>Double mooring</td>
                <td>GPO</td>
                <td>4.69</td>
                     <td>4.00</td>
                      <td>3.06</td>
                       <td>3.54</td>
                        <td>543211</td>
                        <td>01832355230</td>
                        <td>dhiman.nath.cse@gmail.com</td>
                          <td>NON</td>
                            <td>Premier</td>
            </tr>
            <tr>
                 <td>1</td>
                <td>Dhiman</td>
                <td>Dr. Anadi</td>
                <td>Bina</td>
                <td>2\1\1998</td>
                <td>1598776</td>
                <td>Double mooring</td>
                <td>GPO</td>
                <td>4.69</td>
                     <td>4.00</td>
                      <td>3.06</td>
                       <td>3.54</td>
                        <td>543211</td>
                        <td>01832355230</td>
                        <td>dhiman.nath.cse@gmail.com</td>
                          <td>NON</td>
                            <td>Premier</td>
            </tr>
            <tr>
                 <td>1</td>
                <td>Dhiman</td>
                <td>Dr. Anadi</td>
                <td>Bina</td>
                <td>2\1\1998</td>
                <td>1598776</td>
                <td>Double mooring</td>
                <td>GPO</td>
                <td>4.69</td>
                     <td>4.00</td>
                      <td>3.06</td>
                       <td>3.54</td>
                        <td>543211</td>
                        <td>01832355230</td>
                        <td>dhiman.nath.cse@gmail.com</td>
                          <td>NON</td>
                            <td>Premier</td>
            </tr>
            <tr>
                 <td>1</td>
                <td>Dhiman</td>
                <td>Dr. Anadi</td>
                <td>Bina</td>
                <td>2\1\1998</td>
                <td>1598776</td>
                <td>Double mooring</td>
                <td>GPO</td>
                <td>4.69</td>
                     <td>4.00</td>
                      <td>3.06</td>
                       <td>3.54</td>
                        <td>543211</td>
                        <td>01832355230</td>
                        <td>dhiman.nath.cse@gmail.com</td>
                          <td>NON</td>
                            <td>Premier</td>
            </tr>
            <tr>
                 <td>1</td>
                <td>Dhiman</td>
                <td>Dr. Anadi</td>
                <td>Bina</td>
                <td>2\1\1998</td>
                <td>1598776</td>
                <td>Double mooring</td>
                <td>GPO</td>
                <td>4.69</td>
                     <td>4.00</td>
                      <td>3.06</td>
                       <td>3.54</td>
                        <td>543211</td>
                        <td>01832355230</td>
                        <td>dhiman.nath.cse@gmail.com</td>
                          <td>NON</td>
                            <td>Premier</td>
            </tr>
        </tbody>
    </table>
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
</body>
</html>


<style>
    :root {
  --height-height: 150px;
  /* cell width has to reserve some space for scrolling. Hence the sum < 100% */
  --cell-width: 85px;
}

.header-fixed {
  width: 200px;
}

/* Treat all as divs */
.header-fixed > thead,
.header-fixed > tbody,
.header-fixed > thead > tr,
.header-fixed > tbody > tr,
.header-fixed > thead > tr > th,
.header-fixed > tbody > tr > td {
  display: block;
}

/* Prevent header to wrap */
.header-fixed > thead > tr > th {
  white-space: nowrap;
  background-color: lightgrey;
}

.header-fixed > tbody > tr:after,
.header-fixed > thead > tr:after {
  content: ' ';
  display: block;
  visibility: hidden;
  clear: both;
}

.header-fixed > tbody {
  overflow-y: auto;
  height: var(--height-height);
}

.header-fixed > tbody > tr > td,
.header-fixed > thead > tr > th {
  width: var(--cell-width);
  border: thin solid grey;
  float: left;
}
</style>
<table class="header-fixed">
 <thead>
   <tr> <th>Header 1</th> <th>Header 2</th> </tr>
 </thead>
 <tbody>
   <tr> <td>cell 11</td> <td>cell 12</td> </tr>
   <tr> <td>cell 21</td> <td>cell 22</td> </tr>
   <tr> <td>cell 31</td> <td>cell 32</td> </tr>
   <tr> <td>cell 41</td> <td>cell 42</td> </tr>
   <tr> <td>cell 51</td> <td>cell 52</td> </tr>
   <tr> <td>cell 61</td> <td>cell 62</td> </tr>
   <tr> <td>cell 71</td> <td>cell 72</td> </tr>
   <tr> <td>cell 81</td> <td>cell 82</td> </tr>
   <tr> <td>cell 91</td> <td>cell 92</td> </tr>
 </tbody>
</table>




   <style>
        table {
            display: flex;
            flex-flow: column;
            width: 100%;
        }

        thead {
            flex: 0 0 auto;
        }

        tbody {
            flex: 1 1 auto;
            display: block;
            overflow-y: auto;
           <?php /* overflow-x: hidden; */?>
        }

        tr {
            width: 100%;
            display: table;
            table-layout: fixed;
        }

   </style>
 
    <style>
        table {
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
        border: 1px solid #ddd;
        }

        th, td {
        text-align: left;
        padding: 8px;
        }

        tr:nth-child(even){background-color: #f2f2f2}
    </style>
 

   <?php /*
    <div style="height: 600px;overflow: scroll;">
    <!-- change height to increase the number of visible row  -->
        <table></table>
    </div>*/?>

    <div class="card card-topline-green">
        <div class="panel-body">
            <div class="tab-content">
                <div class="table-responsive">
                    <table  class="table table-bordered" style="height:400px;">
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