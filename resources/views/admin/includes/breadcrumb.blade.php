
<?php  

   $currentRoutname = Route::currentRouteName();
   dd("From moderator $currentRoutname");
   $RowUplinks = DB::table('navigation')
      ->where('route_name',$currentRoutname) 
      ->first();

   // echo $RowUplinks->uplinks;
      $explodedUplinks = explodeList($RowUplinks->uplinks);


   $RowUplinks = DB::table('navigation')
   ->whereIn('id',$explodedUplinks)
   ->orderBy('menu_step','ASC') 
   ->get();
?>


   <ol class="breadcrumb page-breadcrumb pull-right">

      <?php foreach($RowUplinks as $singleUplink){

       // echo $singleUplink->sl;
        $menuName =  $singleUplink->menu_name; 
      ?>
    
         <li>
            <i class="<?php  echo $singleUplink->fa_icon;?>"></i>&nbsp;


                <?php   
                if($singleUplink->down_link_exist == "no") {

                ?>

                        <a class="parent-item" 
                        href = "<?php
                         if($singleUplink->params_exist == "no")
                        echo URL::route( $singleUplink->route_name);
                        else
                        echo "#";
                        
                        ?>"> 
                        <?php  echo  txt($menuName); ?>  
                        </a>
                <?php
                }  else 
                   echo  txt($menuName);                         
                   
                  
                 ?>
                
            <?php   if($singleUplink->down_link_exist=="yes") {?> 
                        &nbsp;<i class="fa fa-angle-right"></i>
            <?php } ?>
         </li>
      <?php } ?>
   </ol>
   
  