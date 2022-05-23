<!DOCTYPE html>
<html>
<head>
	<title>Products from simplyretrofits</title>
	<meta charset=utf-8>
	<meta name=description content="">
	<meta name=viewport content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" >

	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<?php include("setup.php");

  // see list of products = qt 10
   /*
    $all_products = $woocommerce->get('products');
    echo "<pre>";
   // print_r($all_products);
    echo "</pre>";
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
 
  // insert operation 
  
 
?>
  

<body>



	<?php 
  
    $data = json_encode($all_products);  
		$data = json_decode($data, true);
  
	?>
	
	<div class="container">
        <center><h4>Popular Product Price List</h4></center>
		<div class="table-responsive">
			<table class="table table-hover">
				<thead class="thead-dark">
					<tr>
						<th>No</th>
						<th>Image</th>
						<th>Description</th>
						<th>SKU/Order#</th>
                        <th>RegularPrice</th>
                        <th>CanadaPrice</th>
					</tr>
				</thead>
				<tbody>
					<?php $i = 1; ?>
					<?php foreach ( $data as $row ) : ?>
            <?php if($row['status'] == "publish"){?>

            <tr>
              <td><?= $i; ?></td>
              <td> <img src="<?= $row['images'][0]['src']; ?>" width="100" > </td>
            <td><a href="<?= $row['permalink']; ?>" target="_blank"><?= $row['name']; ?></a>
                <br>
               
            </td> 
              <td><?= $row['sku']; ?></td>
              <td>$<?= $row['regular_price']; ?></td>
              <td>  <?php  $row['meta_data'][6]['value'];
                    foreach( $row['meta_data'] as $arr ){
                        if($arr['key'] == "b2bking_regular_product_price_group_21363"){
                            /*
                            printf(
                                '<pre>
                                    id: %s
                                    key: %s
                                    value: %s
                                </pre>',
                                $arr['id'],
                                $arr['key'],
                                $arr['value']
                            );
                            */
                            echo "<font color='red'>"."$".$arr['value']."</font>";
                        }
                        
                    }
              ?></td>
             
          </tr>
					<?php $i++; ?>
            <?php }?>
				
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>




 
</body>
</html>
 
