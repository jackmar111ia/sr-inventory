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

 

<?php 



 $width = "<script>document.write(screen.width);</script>";
 echo $width; 
 //$b = $width - 90;

 
// if($width>1100) echo "Big device"; else echo "Small device";
//echo $height = "Height : <script>document.write(screen.height);</script>";

/*
$demo= "$width";
$num = intval($width);
echo "Here".$num;
*/

$int = (int)$width;

?>

    <div class="col-sm-12">
        <div class="card "  style="margin-top:10px">
             
            <div class="card-body">
 

                 
                <?php  $i = 1; ?>
                <?php   if($width > 600 ) {?>
                    
                   

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
                        <a href='{{url("report-pdf/$type")}}' class="btn btn-success"> <i class="fa fa-file-pdf-o" aria-hidden="true"></i> Download Pdf</a>
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
                                        
                                        </th>
                                        </tr>

                                    

                                        <tr style="background:#4DD0E1">
                                        <th style="width:40px"><?php txt("No");?></th>
                                        <th><?php txt("Picture");?></th>
                                        <th><?php txt("Description");?> 

                                        </th>
                                        <th>SKU/Order</th>
                                        <th style="width:80px">Price</th>
                                        
                                    </tr>
                                </thead>
                                <?php  
                                foreach($q0 as $q2){
                                    $excludedCategories = str_replace("<br>",",",$q2->categories);
                                
                                    ?>
                                    <tbody> 
                                        <tr>
                                            <td colspan="5" style="background:#4DD0E1"> <?php  echo "<h6>$excludedCategories</h6>"; ?></td>
                                        </tr>
                                    </tbody> 
                                    <?php
                                    $q = categoryWiseWpData($type,$q2->categories);
                                    ?>

                                    <tbody> 
                                        @foreach($q as $q1)
                                            <tr>
                                                <td><b>{{ $i }} </b> 
        
                                        
                                                </td>
                                                <td  style="width:40px; vertical-align:top; ">
                                                    <a href="<?php echo $q1->permalink; ?>" target="_blank" >
                                                        <img src="{{asset($q1->resize_image)}}" width="40"  style="margin-top:-10px"  target="_blank">
                                                    </a>
                                                </td>  
                                                <td style="padding:2px; vertical-align:top; ">
                                                <a href="<?php echo $q1->permalink; ?>" target="_blank">{{ $q1->title }}</a>
                                                <br> 
                                                <?php echo $q1->short_des; ?> 
                                                </td>    
                                                <td>{{ $q1->sku }}</td> 
                                                
                                                    @if($q1->type == "variable")
                                                        <td colspan="2">
                                                            <font color='red'> <b><?php echo $q1->variable_product_price; ?> </b></font>
                                                            
                                                        </td>
                                                    @else
                                                        <td> <font color='red'>
                                                            @if($type == "canada")
                                                            $<?php echo $q1->canada_price; ?>
                                                            @else
                                                            $<?php echo $q1->ontario_price; ?>
                                                            @endif
                                                            </b></font>
                                                        
                                                        </td>
                                                    @endif
                                                
                                                    
                                                    
                                                    
                                                
                                            </tr>  
                                            <?php $i = $i+1; ?>                            
                                        @endforeach                                            
                                    </tbody>
                                        
                                <?php          
                                }
                                ?>
                          
                        </table>
                    </div>
                <?php } else{?>
                    
                    <div style="100%">
                       
                       <div style="float:left; width:70%; word-break: break-all;">
                       <i class="fa fa-envelope" style="color:red" aria-hidden="true"></i>
                       <a href="mailto:<?php echo $q1->email?>">{{$q1->email}}</a> 
                       </div>
                       
                       <div style="float:right; width:30%; text-align:right">
                       <a href="https://www.simplyretrofits.com/" target="_blank">
                           <img src="{{ asset('backend') }}/img/simply-logo.png" style="width:100px">
                       </a>
                       </div>
                       <?php clear();?><br>
                       <div style="float:left; width:100%; margin-bottom:15px; word-break: break-all;font-size:12px">
                           <a href="#">
                           <i class="fa fa-whatsapp"  style="color:red" aria-hidden="true"></i>
                               {{$q1->contact}} 
                           </a>
                       </div>
                    </div>
                    <?php clear(); ?>


                        <div class="table-responsive">
                            <table  class="table table-bordered">
                            
                                    <thead class="text-center"> 
                                        <tr>
                                            <th style="background:#6FA8DC; color:#000" colspan="6"> {{$q1->page_title}} 
                                            
                                            </th>
                                            </tr>

                                        

                                            <tr style="background:#4DD0E1">
                                            <th style="width:40px"><?php txt("No");?></th>
                                            <th><?php txt("Picture");?></th>
                                            
                                            <th>SKU/Order</th>
                                            <th style="width:80px">Price</th>
                                            
                                        </tr>
                                    </thead>


                                    <?php  
                                    foreach($q0 as $q2){
                                      
                                        $excludedCategories = str_replace("<br>"," ",$q2->categories);
                                        ?>
                                        <tbody> 
                                            <tr>
                                                <td colspan="5" style="background:#4DD0E1"> <?php  echo "<h6>Categories: $excludedCategories</h6>"; ?></td>
                                            </tr>
                                        </tbody> 
                                        <?php
                                       

                                        $q = categoryWiseWpData($type,$q2->categories);
                                        ?>

                                        <tbody> 
                                            @foreach($q as $q1)
                                                <?php 
                                                $evenodd = $i%2;
                                                if($evenodd == 1)
                                                $bgcolor = "#f5f5f5"; 
                                                else $bgcolor = "#fffffff";
                                                ?>

                                                <tr style="background:<?php echo $bgcolor;?>">
                                                    <td><b>{{ $i }}  </b> 
            
                                            
                                                    </td>
                                                    <td  style="width:40px; vertical-align:top;">
                                                        <a href="<?php echo $q1->permalink; ?>" target="_blank" >
                                                            <img src="{{asset($q1->resize_image)}}" width="40"  style="margin-top:-10px"  target="_blank">
                                                        </a>
                                                    </td>  
                                                
                                                    <td><b style="font-size:10px">SKU:</b> {{ $q1->sku }}</td> 
                                                    
                                                        @if($q1->type == "variable")
                                                            <td colspan="2">
                                                                <font color='red'> <b><?php echo $q1->variable_product_price; ?> </b></font>
                                                                
                                                            </td>
                                                        @else
                                                            <td> <font color='red'>
                                                                @if($type == "canada")
                                                                $<?php echo $q1->canada_price; ?>
                                                                @else
                                                                $<?php echo $q1->ontario_price; ?>
                                                                @endif
                                                                </b></font>
                                                            
                                                            </td>
                                                        @endif
                                                    
                                                        
                                                        
                                                        
                                                    
                                                </tr> 
                                                <tr style="background:<?php echo $bgcolor;?>">
                                                    <td colspan="4">
                                                        <a href="<?php echo $q1->permalink; ?>" target="_blank">{{ $q1->title }}</a>
                                                    <?php clear();?> 
                                                    <?php echo $q1->short_des; ?> 
                                                    </td>
                                                </tr> 
                                                <?php $i = $i+1; ?>                            
                                            @endforeach                                            
                                        </tbody>
                                            
                                    <?php          
                                    }
                                    ?>
                                
                            
                            
                                
                            </table>
                        </div>
                <?php
                }?>



               <?php /* {{ $q->links() }}     */?>        
                
            </div>
        </div>
    </div>
@endsection