 
 
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">  
<style>
    body{
        font-family: Elegance, sans-serif;
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
        <div class="card "  style="margin-top:10px; padding-top:10px;">
             
          
 
                <div style="100%">
                    <div style="float:left; width:50%; margin-bottom:15px; word-break: break-all; font-weight:bold;  padding-left:10px; font-size:12px">
                    <a href="whatsapp://send?text=Text from customer!&phone=+8801537379613">
                     <i class="fa fa-whatsapp"  style="color:red" aria-hidden="true"></i>
                        {{$q1->contact}} 
                    </a>
                    
                        
                    </div>
                    <div style="float:left; width:20%;font-size:12px; ">
                    <i class="fa fa-envelope" style="color:red" aria-hidden="true"></i>
                     <a href="mailto:<?php echo $q1->email?>">{{$q1->email}}</a>
                    </div>
                    <div style="float:left; width:30%; text-align:right">
                    <a href="https://www.simplyretrofits.com/" target="_blank">
                        <img src="{{ asset('backend') }}/img/simply-logo.png" style="width:120px">
                    </a>
                    </div>
                </div>
                <?php clear(); ?>

                <div class="table-responsive">
                    <table  class="table table-bordered">
                        <thead class="text-center"> 
                            <tr>
                                <th style="background:#6FA8DC; color:#000" colspan="5"> {{$q1->page_title}} 
                                </th>
                            </tr>
                            <tr style="background:#4DD0E1; padding-right:0px">
                                <th><?php txt("No");?></th>
                                <th><?php txt("Picture");?></th>
                                <th><?php txt("Description");?></th>
                            <th>SKU/Order</th>
                            <th>Price</th>
                            
                        </tr>
                        </thead>
                        <tbody> <?php $i = 1;?>
                            @foreach($q as $q1)
                            <tr>
                                <td><b>{{ $i }} </b> 

                            
                        
                                </td>
                                <td valign="top" style="width:100px">
                            

                            
                                    <a href="<?php echo $q1->permalink; ?>" target="_blank">
                                        <img src="{{ asset($q1->resize_image)}}" width="70" class="img-responsive"  style="align:top"  target="_blank">
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

    

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
 