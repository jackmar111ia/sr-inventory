<?php
define('DB_SERVER','localhost');
define('DB_USER','root');
define('DB_PASS' ,'');
define('DB_NAME', 'simplyretrofits_api');
class DB_con
{
    function __construct()
    {
        $con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
        $this->dbh=$con;

        if (mysqli_connect_errno())
        {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
    }
    public function insert($name)
    {
    $ret=mysqli_query($this->dbh,"insert into iframes (name)
    values('$name')");
    return $ret;
    }
    public function insert_wp_data($wp_id,$title,$permalink,$image,$short_des,$sku,$type,$variable_product_price,$regular_price,$canada_price,$ontario_price,$categories,$hubspot_p_description)
    {  
        //echo $categories;
    $ret=mysqli_query($this->dbh,"insert into wp_fetehed_data (wp_id,title,permalink,image,short_des,sku,type,variable_product_price,regular_price,canada_price,ontario_price,categories,hubspot_p_description,hubspot_p_description_local)
    values('$wp_id','".mysqli_real_escape_string($this->dbh,$title)."','$permalink','$image','$short_des','$sku','$type','$variable_product_price',$regular_price,$canada_price,$ontario_price,'$categories','$hubspot_p_description','$hubspot_p_description')");
    return $ret;
    }

    public function truncateWpTable(){
        $ret=mysqli_query($this->dbh,"TRUNCATE TABLE wp_fetehed_data");
        return $ret;
       
    }

    public function truncatenotInsertedWpIds(){
        $ret=mysqli_query($this->dbh,"TRUNCATE TABLE not_inserted_wp_datas");
        return $ret;
       
    }
    public function notInsertedWpIds($wp_id,$title,$permalink)
    {  
        $ret = mysqli_query($this->dbh,"insert into not_inserted_wp_datas (wp_id,title,permalink)
        values('$wp_id','$title','$permalink')");
        return $ret;
    }
    
    // customers

    public function truncateCustomersPreviews(){
        $ret=mysqli_query($this->dbh,"TRUNCATE TABLE customers_previews");
        return $ret;
       
    }

    public function insert_customers_data_inpreview($customer_id,$image,$name,$email,$user_name,$phone,$account_status_on_wordpress,$fetch_status,$created_at,$updated_at)
    {  
        
    $ret=mysqli_query($this->dbh,"insert into customers_previews (customer_id,image,name,email,user_name,phone,account_status_on_wordpress,fetch_status,created_at,updated_at)
    values('$customer_id','$image','$name','$email','$user_name','$phone','$account_status_on_wordpress','$fetch_status','$created_at','$updated_at')");
    return $ret;
    }


     
}



?>