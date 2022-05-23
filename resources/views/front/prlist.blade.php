 @extends('front.master')
 @section('page-title')
 {{$q1->page_title}}
 @endsection
 @section('middle-content')

 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<style>
    body{
        font-size: 1em;
        }
        @media only screen and (max-width: 320px) {
        body { 
        font-size: 1em; 
        }

        
    }

    td {
         word-break: break-all;
        }
</style>
 <div class="col-sm-12">
        <div class="card "  style="margin-top:10px">
             
            <div class="card-body">
 
                <div style="100%">
                    <div style="float:left; width:50%; margin-bottom:15px; word-break: break-all;">
                    <a href="whatsapp://send?text=Text from customer!&phone=+8801537379613">
                     <i class="fa fa-whatsapp"  style="color:red" aria-hidden="true"></i>
                        {{$q1->contact}} 
                    </a>
                    
                        
                    </div>
                    <div style="float:left; width:20%; word-break: break-all;">
                    <i class="fa fa-envelope" style="color:red" aria-hidden="true"></i>
                     <a href="mailto:<?php echo $q1->email?>">{{$q1->email}}</a> 
                     <a href="{{url('report-pdf/canada')}}" class="btn btn-success"> <i class="fa fa-file-pdf-o" aria-hidden="true"></i> Download Pdf</a>
                    </div>
                    
                    <div style="float:left; width:30%; text-align:right">
                    <a href="https://www.simplyretrofits.com/" target="_blank">
                        <img src="{{ asset('backend') }}/img/simply-logo.png" style="width:100px">
                    </a>
                    </div>
                </div>
                <?php clear(); ?>

                <div class="table-responsive">
                <table  class="table table-bordered">
                    <thead class="text-center"> 
                        <tr>
                        <th style="background:#6FA8DC; color:#000" colspan="6"> {{$q1->page_title}} 
                        <span style="float:right">
                        <?php 
                        if (Auth::guard('web')->check() == 1){ ?>
                            <a  style="color:#333" href="{{ route('home')}}">
                                My account
                            </a>
                        <?php } 
                         if (Auth::guard('admin')->check() == 1) {?>
                          <a style="color:#333" href="{{ route('admin.dashboard')}}">
                                My account
                            </a>
                         <?php }
                        

                        ?>
                        
                    
                        </span>
                        </th>
                        </tr>

                    

                        <tr style="background:#4DD0E1">
                        <th><?php txt("No");?></th>
                        <th><?php txt("Picture");?></th>
                        <th><?php txt("Description");?> 

                        </th>
                        <th>SKU/Order</th>
                        <th>Price</th>
                        
                       </tr>
                    </thead>
                    <tbody> <?php $i = 1;?>
                        @foreach($q as $q1)
                        <tr>
                            <td><b>{{ $i }} </b> 

                            <?php  
                            if(Auth::guard('admin')->check() == 1){ ?>
                            <a href="{{ route('admin.wpdata.manage.single.edit',['id' => $q1->id]) }}" target="_blank">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </a>
                            <?php }?>
                    
                            </td>
                            <td valign="top" style="width:100px">
                                <a href="<?php echo $q1->permalink; ?>" target="_blank">
                                    <img src="{{asset($q1->resize_image)}}" width="70" class="img-responsive"  style="align:top"  target="_blank">
                                </a>
                            </td>  
                            <td ><a href="<?php echo $q1->permalink; ?>" target="_blank">{{ $q1->title }}</a>
                             <br> 
                             <?php echo $q1->short_des; ?>
                            </div>
                             <?php clear();?>
                            </td>    
                            <td>{{ $q1->sku }}</td> 
                            
                                @if($q1->type == "variable")
                                    <td colspan="2">
                                        <font color='red'> <b><?php echo $q1->variable_product_price; ?> </b></font>
                                        <br>
                                        <a href="https://www.simplyretrofits.com/?add-to-cart=<?php echo $q1->wp_id; ?>&quantity=1" class="btn btn-success" target="_new"> Order</a>
                                    </td>
                                @else
                                    <td> <font color='red'>
                                        @if($type == "canada")
                                        $<?php echo $q1->canada_price; ?>
                                        @else
                                        $<?php echo $q1->ontario_price; ?>
                                        @endif
                                        </b></font>
                                        <br>
                                        <a href="https://www.simplyretrofits.com/?add-to-cart=<?php echo $q1->wp_id; ?>&quantity=1" class="btn btn-success" target="_new">Order</a>
                                    </td>
                                @endif
                               
                                  
                                   
                                   
                             
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
@endsection