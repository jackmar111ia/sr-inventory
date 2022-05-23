 
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="text-center">
                <tr>
                <th><?php txt("Sl");?></th>
                <th><?php txt("Image");?></th>
                <th><?php txt("Title");?></th>
                <th>Type</th>
                <th>Regular Price</th>
                <th>Canada Price</th>
                <th>Ontario Price</th>
            </tr>
            </thead>
            <tbody> <?php $i = 1;?>
                @foreach($qsimple as $q1)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $q1->wp_id }}</td>
                    <td valign="top"><img src="{{asset($q1->resize_image)}}" width="100" target="_new" style="align:top" ></td>  
                    <td><a href="<?php echo $q1->permalink; ?>">{{ $q1->title }}</a>
                    <br><div style="width:400px">
                    <?php echo $q1->short_des; ?>
                    </div>
                    <?php clear();?>
                    </td>    
                    <td>{{ $q1->type }}</td> 
                    @if($q1->type == "simple")
                        <td>{{ $q1->regular_price }}</td> 
                        <td>{{ $q1->canada_price }}</td> 
                        <td>{{ $q1->ontario_price }}</td> 
                        @else
                        <td colspan="3"><?php echo $q1->variable_product_price; ?></td> 
                    @endif

                
                </tr>  
                <?php $i = $i+1; ?>                            
                @endforeach                                            
            </tbody>
        </table>
    </div>
                
     

  

