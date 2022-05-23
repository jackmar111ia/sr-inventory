<?php if($option == "email"){
     echo "<font color='green'>Your registered email address will be used for notification.</font>";
    ?>
    
    <?php
}
else if($option == "phone"){
    ?>
     <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required placeholder="Ex: 018XXXXXXX" autocomplete="phone">
    <?php
   
}

?>