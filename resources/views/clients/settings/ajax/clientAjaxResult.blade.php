<?php if($option == "email"){
    ?>
   <?php  inputfield("","text","email","form-control",'nid',$clientInfo->email,'',"Your notifiable email",'','',"","'','','',$errors");   ?>
    <?php
}
else if($option == "phone"){
    ?>
     <input  type="hidden"  name="email" value="">
    <?php
    echo "<font color='green'>Your registered phone number will be used for notification.</font>";
}

?>