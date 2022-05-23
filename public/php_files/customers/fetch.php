<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" >

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>


<?php include("../setup.php");

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
  $customers = [];
  $all_customers = [];
  do{
    try {
      $customers = $woocommerce->get('customers',array('per_page' => 100, 'page' => $page));
    }catch(HttpClientException $e){
      die("Can't get products: $e");
    }
    $all_customers = array_merge($all_customers,$customers);
    $page++;
  } while (count($customers) > 0);
 
  //echo "<pre>";
  //print_r($all_customers);
  //echo "</pre>";
  

  $data = json_encode($all_customers);  
  $data = json_decode($data, true);
  // insert operation 
  
 
  include_once("../function.php");
  $insertdata = new DB_con();
  $sql = $insertdata->truncateCustomersPreviews();

  $i = 0;
   
  foreach ( $data as $row ){
    
     
      $customer_id = $row['id'];
      $image = $row['avatar_url'];;
      $name = $row['first_name'];
      $email = $row['email'];
      $user_name = $row['username'];
      $phone = $row['billing']['phone'];

        foreach( $row['meta_data'] as $arr ){
          if($arr['key'] == "b2bking_account_approved"){
          $acc_approval_status = $arr['value'];
          }
        }
      $account_status_on_wordpress = $acc_approval_status;
      $fetch_status = 'no';

      $sql = $insertdata->insert_customers_data_inpreview($customer_id,$image,$name,$email,$user_name,$phone,$account_status_on_wordpress,$fetch_status,'','');
     // echo "inserted $row[id]<br>";
     
      $i = $i + 1;
  
    
  }

?>
 
  <div class="alert alert-success" role="alert">
    Data fetched successfully!
    <?php $project_folder = "simply-retrofits"; ?>
    <script>window.top.location.href = "http://localhost/<?php echo $project_folder;?>/admin/fetched-customer-preview"; </script>
  </div>

 

 
	

 
