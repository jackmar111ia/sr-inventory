 
 
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">  
<style>
    body{
         margin: 0;
    padding: 0;
        font-family: Elegance, sans-serif;
        font-size: 1em;
        }
        @media only screen and (max-width: 320px) {
        body { 
        font-size: 1em; 
        }

        
    }
    table, th, td {
        border: 1px solid black;
        }
    td {
         word-break: break-all; align:top
        }
</style>
<?php $font_size = "font-size:11px";?>
 <div class="col-sm-12" style="padding:10px; margin-top:-30px; margin-left:-7px;  margin-bottom:-50px; ">
        <div class="card"  style="margin-top:1px; padding-top:3px;">
             
          
 
                <div style="100%">
                    <div style="float:left; width:40%; margin-bottom:15px; word-break: break-all; font-weight:bold;  padding-left:10px; font-size:12px">
                    <a href="whatsapp://send?text=Text from customer!&phone=+8801537379613">
                     <i class="fa fa-whatsapp"  style="color:red" aria-hidden="true"></i>
                        {{$q1->contact}} 
                    </a>
                    
                        
                    </div>
                    <div style="float:left; width:30%;font-size:12px; ">
                    <i class="fa fa-envelope" style="color:red" aria-hidden="true"></i>
                     <a href="mailto:<?php echo $q1->email?>">{{$q1->email}}</a>
                    </div>
                    <div style="float:left; width:30%; text-align:right; ">
                    <a href="https://www.simplyretrofits.com/" target="_blank" >
                        <img src="{{ asset('backend') }}/img/simply-logo.png" style="width:120px; margin-top:5px">
                    </a>
                    </div>
                </div>
                <?php clear(); ?>

                <div class="table-responsive">
                    <table  border="1">
                        <thead class="text-center" style="<?php echo $font_size;?>"> 
                            <tr>
                                <th style="background:#6FA8DC; color:#000" colspan="5"> {{$q1->page_title}} 
                                </th>
                            </tr>
                            <tr style="background:#4DD0E1; padding-right:0px">
                                <th><?php txt("No");?></th>
                                <th><?php txt("Picture");?></th>
                                <th><?php txt("Description");?></th>
                                <th>SKU/Order#</th>
                                <th>Price </th>
                            
                        </tr>
                        </thead>
                        <tbody> <?php $i = 1;?>
                            @foreach($q as $q1) 
                            <?php
                            $clval = $i%2;
                            if($clval == 0) $bgcolorrow = "#fff"; else $bgcolorrow= "#DEF8F9";?>
                            <tr style="border:solid 1px #999; background:<?php echo $bgcolorrow;?>">
                                <td  style="vertical-align:top;padding:3px"><b style="<?php echo $font_size;?>" >&nbsp;{{ $i }} </b> 

                            
                        
                                </td>
                                <td style="width:auto;padding:3px; vertical-align:top;text-align:center;">
                                     <a href="<?php echo $q1->permalink; ?>" target="_blank">
                                        <img src="{{ asset($q1->resize_image)}}" width="40" class="img-responsive"  style="align:top"  target="_blank">
                                    </a>
                                </td>  
                                <td style=" line-height:1;padding:3px; text-align:center; <?php echo $font_size;?>;">
                                <a style=" color:#29246D; font-weight:bold" href="<?php echo $q1->permalink; ?>" target="_blank">{{ $q1->title }}</a>
                                    <?php clear();?>
                                    
                                        <?php //echo str_replace('font-size: 12px;', 'font-size: 16px;', $q1->short_des); ?>
                                        <?php  echo $q1->hubspot_p_description_local; ?>
                                      
                                </div>
                                <?php clear();?>
                                </td>    
                                <td style="vertical-align:top; padding:3px; text-align:center;<?php echo $font_size;?>">{{ $q1->sku }}</td> 
                                
                                    @if($q1->type == "variable")
                                        <td colspan="2" style="vertical-align:top; padding:3px; text-align:center;<?php echo $font_size;?>" >
                                            <b><?php echo $q1->variable_product_price; ?> </b> 
                                            <?php /*
                                            <br>
                                            <a href="https://www.simplyretrofits.com/?add-to-cart=<?php echo $q1->wp_id; ?>&quantity=1" class="btn btn-success" target="_new"> Order</a>
                                            */?>
                                        </td>
                                    @else
                                        <td style="vertical-align:top; padding:3px; text-align:center;<?php echo $font_size;?>"> <font color='red'>
                                            @if($type == "canada")
                                            $<?php echo $q1->canada_price; ?>
                                            @else
                                            $<?php echo $q1->ontario_price; ?>
                                            @endif
                                            </b></font>
                                            <?php /*
                                            <br>
                                            <a href="https://www.simplyretrofits.com/?add-to-cart=<?php echo $q1->wp_id; ?>&quantity=1" class="btn btn-success" target="_new">Order</a>
                                            */?>
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

    

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
 