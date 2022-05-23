<?php if($option == "email"){
    ?>
   <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter active email" required autocomplete="email">
    
    <?php
}
else if($option == "phone"){
    ?>
     <input  type="hidden"  name="email" value="">
    <?php
    echo "<font color='green'>Your registered phone number will be used for notification.</font>";
}

?>