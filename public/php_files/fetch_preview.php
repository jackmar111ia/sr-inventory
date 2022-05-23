<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" >

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>


<?php include("setup.php");
 
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
 ?>
 

	<div>
	
		<center>
			<h3>Data From Woocommerce</h3>
		</center>
	
	</div>
	<div class="container">
		<div class="table-responsive">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " style="background:#F0F2E0; padding:10px; " >
                <input type="text" id="myInput" onkeyup="myFunction()" class="form-control"  placeholder="Search for a test.." title="Type in a name" style="border:solid 1px #000">
            </div>
          
			<table  id="myTable"  class="table table-hover">
				<thead>
					<tr>
						<th>No</th>
						<th>ID</th>
						<th >Product Name</th>
						
					</tr>
				</thead>
				<tbody>
					<?php $j = 0; ?>
                    <?php foreach ( $data as $row ) : ?>	
                        <?php  if($row['status'] == "publish"){ ?>

                            <tr>
                            <td><?= $j; ?> <input type="checkbox" name="select_id[]" ></td>
                            <td><img src="<?= $row['images'][0]['src']; ?>" width="100" > </td>

                           
                            <td><a href="<?= $row['permalink']; ?>" target="_blank"><?= $row['name']; ?></a></td> 
                          
                            </tr>
                        <?php $j++; ?>
                        <?php }?>
			        <?php endforeach; ?>	
 
				</tbody>
			</table>
        <script>
            function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[2];
                if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
                }       
            }
            }
        </script>
 

 