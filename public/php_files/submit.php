
<?php

include_once("function.php");

$insertdata = new DB_con();

if($_POST['submit'] == 'submit'){

$name=$_POST['name'];

$sql = $insertdata->insert($name);

}

?>
