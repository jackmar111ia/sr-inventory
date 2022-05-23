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
 
<body>
  
<?php //$project_folder = "simply-retrofits"; ?>
    <?php /* <script>window.top.location.href = "http://localhost/<?php echo $project_folder;?>/admin/resize-download-images"; </script>

    */?>
	 
    <?php /*
     <div class="alert alert-success" role="alert">
        Data fetched successfully!
        <?php $project_folder = "simply-retrofits"; ?>
        <script>window.top.location.href = "http://localhost/<?php echo $project_folder;?>/admin/wp-data/non-inserted-data-fetch"; </script>
    </div>
    */?>
  
   <!---<a href="fetch_preview.php">Fetech preview</a>--!-->
    <form name="f1" method="post" action="fetch.php">
      <input type="submit"  onclick="return OnclickFetchConfirm()" class="btn btn-success" value="Fetch Customers From Simply retrofits">
    </form>

      <script  type="text/javascript">  
          function OnclickFetchConfirm()
          {
              var agree=confirm("Do you really want to proceed?");
              if(agree)
              return true;
              else
              return false;
          }
      </script> 


</body>
</html>
 
