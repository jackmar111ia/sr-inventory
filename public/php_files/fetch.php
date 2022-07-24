<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" >

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>


<?php include("setup.php");

  // see list of products = qt 10
    /*
    $all_products = $woocommerce->get('products');
     
    echo "<pre>";
   // print_r($all_products);
    echo "</pre>";
    $data = json_encode($all_products);  
    $data = json_decode($data, true);

   */


  $page = 1;
  $products = [];
  $all_products = [];
  do{
    try {
      $products = $woocommerce->get('products',array('per_page' => 100, 'page' => $page));
    }catch(HttpClientException $e){
      die("Can't get products: $e");
    }
    $all_products = array_merge($all_products,$products);
    $page++;
  } while (count($products) > 0);
 
  $data = json_encode($all_products);  
  $data = json_decode($data, true);
  // insert operation 
  
 
  include_once("function.php");
  $insertdata = new DB_con();
  $sql = $insertdata->truncateWpTable();

  
  $sql = $insertdata->truncatenotInsertedWpIds();
  

  
  $i = 0;
  foreach ( $data as $row ){
    if($row['status'] == "publish"){
      $image = '';
      $wp_id = $row['id'];
      $title = $row['name']; 
      $permalink = $row['permalink'];
      $image = $row['images'][0]['src'];
      if($row['short_description'] != '')
      $short_des = $row['short_description'];
      else
      $short_des = "something";

      $sku = $row['sku'];
      $type = $row['type'];

      $hubspotpdes = ''; $hubspotpdesCustom = '';
      // catch hubspot product description 
      foreach( $row['meta_data'] as $arr ){
        if($arr['key'] == "_technical_specs"){
        // $canada_price = $row['meta_data'][6]['value'];
        $hubspotpdes = $arr['value'];
       // $hubspotpdesCustom =  preg_replace('/\s+/', ' ', preg_replace('/<[^>]*>/', ' ', $hubspotpdes));
        
        }
      }

      if($row['type'] == "variable"){
        $variable_product_price = $row['price_html'];
        $regular_price = 0;
        $canada_price = 0;
        $ontario_price = 0;

      }else{
          $variable_product_price = '';
          $regular_price = $row['regular_price'];
          $canada_price = 0;
          $ontario_price = 0;
          
          foreach( $row['meta_data'] as $arr ){
            
            if($arr['key'] == "b2bking_regular_product_price_group_21363"){
              // $canada_price = $row['meta_data'][6]['value'];
              $canada_price = $arr['value'];
            }

            if($arr['key'] == "b2bking_regular_product_price_group_21362"){
              $ontario_price = $arr['value'];
            }
             
          }
      }

      $cats = '';
   
      $categoryQty = 0; $commAbrNo = 0;
      $categoryQty = count($row['categories']);
      $commAbrNo = $categoryQty - 1;
      
      $j = 0; 
      while($j < $categoryQty){
        
         if($row['categories'][$j]['name'] == "")
           {   $j = $j - 1; break;}
         else 
         {
          if($j == $commAbrNo){
            $cats = $cats.$row['categories'][$j]['name'];
          }else{
            $cats = $cats.$row['categories'][$j]['name']."<br>";
          }
         
           $j = $j + 1;
           
         }
   
      }
      //$cats = $categoryQty.",".$cats;
      //echo $cats;
      $sql = $insertdata->insert_wp_data($wp_id,$title,$permalink,$image,$short_des,$sku,$type,$variable_product_price,$regular_price,$canada_price,$ontario_price,$cats,$hubspotpdes);
     // echo "inserted $row[id]<br>";
      if(!$sql){
        $sql = $insertdata->notInsertedWpIds($wp_id,$title,$permalink);

        //echo "Not inserted $row[id]<br>";
      }
      $i = $i + 1;
    }
    
  }

?>

  <div class="alert alert-success" role="alert">
    Data fetched successfully!
    <?php $project_folder = "simply-retrofits"; ?>
    <script>window.top.location.href = "http://localhost/<?php echo $project_folder;?>/admin/wp-data/fetch-preview/filter"; </script>
    <?php /*
    <script>window.top.location.href = "http://localhost/<?php echo $project_folder;?>/admin/wp-data/non-inserted-data-fetch"; </script>
    */ ?>
  </div>

 
	

 
