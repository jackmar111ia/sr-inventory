
<?php

use App\User;
use App\Admin;
use App\Moderator;
use App\Models\moderator\ModeratorUpdate;
use App\Models\user\ClientUpdate;
use App\Models\admin\Month;
use App\Models\admin\Year;
use App\Models\user\otpTrack;
use App\Models\Role;
use App\Models\admin\Apartment;
use App\Models\admin\wpData;
use App\Models\admin\Customers;
use App\Models\admin\WpNonRetrived;
use Carbon\Carbon;

function appname()
{
    return  "Simply Retrofits";
}
function userRegiOtpLimit(){
    $limit = 6;
   return $limit;
}

function isError($errors, $name){
    if(empty($className))
     $className = "invalid-feedback";
     
    if($errors->has($name)){
        echo "<span class='help-block' style='color:#dc3545; font-weight:bold;font-size:12px'>".$errors->first($name).'</span>';
    }
}

    function textareaEditor($fieldTitle,$inputFldName,$class,$idName,$style,$ph,$row,$col,$val,$required,$array)
        { 
            //echo "$fieldTitle,$inputFldName,$class,$idName,$style,$ph,$row,$col,$val,$required,$array";
            if($fieldTitle!='')
            {
                echo  "<b>";
                txt($fieldTitle);
                echo  "</b>"; 
            }
            ?>
            <textarea  class="<?php echo $class; ?>"  name="<?php echo $inputFldName; ?>"  placeholder="<?php echo $ph; ?>"  id="<?php echo $idName; ?>" style=" <?php echo $style; ?>" rows="<?php echo $row; ?>" cols="<?php echo $col; ?>"  <?php echo $required; ?>><?php echo old($inputFldName,$val);?></textarea>
             
            <?php 
            return("");               
        }    
        
    function submitBtn($name, $classValue, $value, $array)
    {
    
    ?>
    <input type="submit" name="<?php echo $name; ?>" value="<?php echo txt($value); ?>"
        class="btn btn-<?php echo $classValue; ?>">
    <?php
    }

function inputfield($fieldTitle,$type,$name,$class,$val,$editId,$jqueryidname,$placeholder,$style,$maxlength,$required,$arrayData = null)
{  
    $autocomplete = "on";
    $arrayData = explode(',', $arrayData);
    $expldeQty = explodeCount($arrayData); 
    // dd($expldeQty);
    $readonly = $arrayData[0];

    if($expldeQty == 2)
    $disabled = $arrayData[1];

    if($expldeQty == 3)
    $autocomplete = $arrayData[2];

     
   // echo "$fieldTitle,$type,$name,$class,$val,$editId,$jqueryidname,$placeholder,$style,$maxlength,$required,$arrayData";
   /* if($type == "hidden"){  
        <input <?php echo $required; ?>style=" <?php echo $style; ?> " placeholder="<?php echo $placeholder;?>" type="<?php echo $type;?>" name="<?php echo $name;?>"   value = "<?php echo htmlentities(stripslashes($val));?>" onFocus="$(this).addClass('active');" onBlur="$(this).removeClass('active');" id="<?php echo $jqueryidname;?>" <?php echo $required; ?> />

      } */ ?>


            <?php if($fieldTitle!="")
                {
                   // echo  "<label>".__("lang.$fieldTitle")."</label>"; 
                   
                     echo  "<b>";
                     echo $fieldTitle;
                     echo  "</b>"; 
                }   
            ?>
            
            <input autocomplete = "<?php echo $autocomplete; ?>" <?php echo $readonly; ?> class="form-control" 
            type="<?php echo $type;?>" maxlength="<?php echo $maxlength; ?>"
                value="<?php echo old($val,$editId); ?>" name="<?php echo $name;?>" id="<?php echo $jqueryidname; ?>"  placeholder="<?php echo $placeholder;?>"  onFocus="$(this).addClass('active');" onBlur="$(this).removeClass('active');" id="<?php echo $jqueryidname;?>" style=" <?php echo $style; ?> "  <?php echo $required; ?> <?php echo $readonly;?> >
    
       <?php

    return("");
}

function selectoption($fieldTitle,$name,$class,$selectedval,$jqueryidname,$query,$showing_val,$passing_val,$firstOption,$array = null)
{
    /* jodi kono select option e relation thake 
    tahole last arry value hobe "required,yes,relationStepNo 
    SUppese i ta relation step hole 1, 2 ta hole 2,relationkeys"
    jodi city model theke CoutryListWithChildCityList function use kora hoy
    then passing value hobe id,showingValue hobe CountryName, array value hobe 
    "required,yes,1,country"
     passing value = $row->country->CountryName
     Showing value = $row->country->id
    */

    // array data setup
    $relation = 'no';  $required = ''; $relationKeys ='';

    $arrayData = explode(',',$array);
    $arraySize = sizeof($arrayData);

    if($arraySize == 1) 
    $required = $arrayData[0];

    if($arraySize > 1)
    {
         
        $relation = $arrayData[1]; // relation = yes
       

        if($relation == "yes"){
            $relationStep = $arrayData[2];
            $firstRelationkey = $arrayData[3];
        }
      

      
        if($relationStep == 1)
        {
            $firstRelationkey = $arrayData[3];
            $relationKeys = $firstRelationkey;
            
        }
       // echo "$arraySize,Relation = $relation, relation step = $relationStep ,$firstRelationkey, $passing_val, $showing_val ,Required = $required";
       
    }
   

    if($fieldTitle!="")
    {
       echo  "<label>";
         txt($fieldTitle);
         echo  "</label>"; 
    }
    
    ?>

    <select <?php echo $required; ?> name = "<?php echo $name; ?>" id = "<?php echo $jqueryidname; ?>" class = "<?php echo $class; ?>"  >
        <option value = ""><?php txt($firstOption); ?></option>
        <?php 
        foreach($query as $row)
            {
                if($relation == "no"){

                    if (old($name) == $row->$passing_val) 
                    {
                        ?>
                        <option value = "<?php echo $row->$passing_val; ?>" selected> <?php echo $row->$showing_val; ?>  </option>
                        <?php
                    }
                    elseif(($row->$passing_val == $selectedval) AND (empty(old($name))))
                    {
                        ?>
                        <option value = "<?php echo $row->$passing_val; ?>" selected> <?php echo $row->$showing_val; ?>  </option>
                        <?php
                    }
                    else
                    {
                        ?>
                        <option value = "<?php echo $row->$passing_val; ?>" > <?php echo $row->$showing_val; ?>  </option>
                        <?php
                    }
                }else{

                    if (old($name) == $row->$relationKeys->$passing_val) 
                    {
                        ?>
                        <option value = "<?php echo $row->$relationKeys->$passing_val; ?>" selected> <?php echo $row->$relationKeys->$showing_val; ?>  </option>
                        <?php
                    }
                    elseif(($row->$relationKeys->$passing_val == $selectedval) AND (empty(old($name))))
                    {
                        ?>
                        <option value = "<?php echo $row->$relationKeys->$passing_val; ?>" selected> <?php echo $row->$relationKeys->$showing_val; ?>  </option>
                        <?php
                    }
                    else
                    {
                        ?>
                        <option value = "<?php echo $row->$relationKeys->$passing_val; ?>" > <?php echo $row->$relationKeys->$showing_val; ?>  </option>
                        <?php
                    }
                }
                    
                

            
            }
            
        
        ?>
    </select>
    
    
     

    <?php
    return("");
}



function textareaBox($fieldTitle,$inputFldName,$idName,$style,$ph,$row,$col,$val,$required,$array = null)
{ 
    $arrayData = explode(',', $array);
    $expldeQty = explodeCount($arrayData); 
    // dd($expldeQty);
    $readonly = $arrayData[0];

    if($expldeQty == 2)
    $disabled = $arrayData[1];

    if($expldeQty == 3)
    $autocomplete = $arrayData[2];


    if($fieldTitle!='')
    {
        echo  "<label>";
        txt($fieldTitle);
        echo  "</label>"; 
    }
   
    ?>
    <textarea  <?php echo $readonly; ?> class="form-control"  name="<?php echo $inputFldName; ?>"  placeholder="<?php echo $ph; ?>"  id="<?php echo $idName; ?>" style=" <?php echo $style; ?>" rows="<?php echo $row; ?>" cols="<?php echo $col; ?>" <?php echo $required; ?>><?php echo old($inputFldName,$val);?></textarea>
     
    <?php 
    return("");               
}   


function explodeCount($data)
{
    $cnt = 0;
    while(!empty($data[$cnt]))
    $cnt = $cnt + 1;
   return  $cnt;
}

function randomUniqueId(){
    $id = random_int(100000, 999999);
    return $id;
}

function enableDisableStatus(){

    $r = DB::table('enable_disable_status')
        ->select('status')
        ->where('name','otpAfterRegi')
        ->first();
    $otpAfterRegi = $r->status;

    $r = DB::table('enable_disable_status')
        ->select('status')
        ->where('name','otpAfterPasswordReset')
        ->first();
    $otpAfterPasswordReset = $r->status;

    $r = DB::table('enable_disable_status')
    ->select('status')
    ->where('name','validationMsgUpdateStatus')
    ->first();
    $validationMsgUpdateStatus = $r->status;

    $r = DB::table('enable_disable_status')
    ->select('status')
    ->where('name','clientAccountActivation')
    ->first();
    $clientAccountActivation = $r->status;

    $r = DB::table('enable_disable_status')
    ->select('status')
    ->where('name','clientPaymentUpdateAlert')
    ->first();
    $clientPaymentUpdateAlert = $r->status;


    $r = DB::table('enable_disable_status')
    ->select('status')
    ->where('name','clientPaymentSubmissionAlert')
    ->first();
    $clientPaymentSubmissionAlert = $r->status;

    $r = DB::table('enable_disable_status')
    ->select('status')
    ->where('name','otpAfterRegiForModeratorPhoneVerification')
    ->first();
    $otpAfterRegiForModeratorPhoneVerification = $r->status;


    
    $r = DB::table('enable_disable_status')
    ->select('status')
    ->where('name','clientGenInfoUpdateSubmission')
    ->first();
    $clientGenInfoUpdateSubmission = $r->status;

    $r = DB::table('enable_disable_status')
    ->select('status')
    ->where('name','clientUpdateApproveByAdminAlert')
    ->first();
    $clientUpdateApproveByAdminAlert = $r->status;


    $r = DB::table('enable_disable_status')
    ->select('status')
    ->where('name','clientUpdateRejectedByAdminAlert')
    ->first();
    $clientUpdateRejectedByAdminAlert = $r->status;



    $r = DB::table('enable_disable_status')
    ->select('status')
    ->where('name','clientAccountDeclinedByAdmin')
    ->first();
    $clientAccountDeclinedByAdmin = $r->status;


    $dataArray= [];
    $dataArray['otpAfterRegi'] = $otpAfterRegi; // after registration mobile otp send status
    $dataArray['otpAfterPasswordReset'] = $otpAfterPasswordReset;
    $dataArray['validationMsgUpdateStatus'] = $validationMsgUpdateStatus;
    $dataArray['clientAccountActivation'] = $clientAccountActivation;
    $dataArray['clientPaymentUpdateAlert'] = $clientPaymentUpdateAlert;
    $dataArray['clientPaymentSubmissionAlert'] = $clientPaymentSubmissionAlert;
    $dataArray['otpAfterRegiForModeratorPhoneVerification'] = $otpAfterRegiForModeratorPhoneVerification;
    $dataArray['clientGenInfoUpdateSubmission'] = $clientGenInfoUpdateSubmission;
    $dataArray['clientUpdateApproveByAdminAlert'] = $clientUpdateApproveByAdminAlert;
    $dataArray['clientAccountDeclinedByAdmin'] = $clientAccountDeclinedByAdmin;
    $dataArray['clientUpdateRejectedByAdminAlert'] = $clientUpdateRejectedByAdminAlert;
    
    
    
    

    return $dataArray;
}
function smsPostApiLink(){
    /*
    https://smpp.ajuratech.com/portal/

    User: Burj Al Madina

    pass: buj#7464
    */

    //$link = "https://smpp.ajuratech.com:7790/sendtext?apikey=e770e1b1df832632&secretkey=43ed1588";
    //return $link;

       /*
        https://smpp.ajuratech.com/portal/
        User: chutyrooms
        Pass: chuty#9871
        */
        $key = "e770e1b1df832632";
        $secret = "43ed1588";
        $link = "https://smpp.ajuratech.com:7790/sendtext?apikey=$key&secretkey=$secret";
        return $link;

}

function smsApiKeys(){

    $data = []; // array
    $apikey = "c0d0c9e29cca2f83";
    $secretkey = "80ad838e";  

    $data[0] = $apikey;
    $data[1] = $secretkey;
    return $data;
}

function alertMessage($msg)
{
    /*$status = localizationStatus();
    
    if($status == "on")
    return __("lang.$msg");
    else*/
    return $msg;
}
function txt($title)
{
    /*$status = localizationStatus();
    if($status == "on")
    echo  __("lang.$title");
    else*/
    echo   $title;
    
    
}

 /********************Function of model User***************** */
 function CheckUserOtpVerification($phone)
 { 
     $userObj = new User();
     $objMethod = $userObj->CheckUserOtpVerification($phone); 
     return $objMethod;
 }
 function CheckUserStatus($phone)
 { 
     $userObj = new User();
     $objMethod = $userObj->CheckUserStatus($phone); 
     return $objMethod;
 }

 
 function notificatioEmailVerificationCheck($user)
 { 
     $userObj = new User();
     $objMethod = $userObj->notificatioEmailVerificationCheck($user); 
     return $objMethod;
 }
 /********************Function of model User***************** */
  //************************Function in Model otpTrack***********************************

  function otpCount(){
    $Obj = new otpTrack();
    $objMethod = $Obj->otpCount();
    return $objMethod;
}
//************************Function in Model ValidationCategory***********************************
function explodePermissionIds($pids)
{
   return  explode(',',$pids);
}
function role()
{
    $role = Auth::user()->role;
    return $role;
}


function permissions($role)
{
     
    // role 1 = admin
    // role 2 = moderator
    // role3 = user
    $role = $role;
    // dd($role);
    $r = Role::where('id', $role)
    ->first();

    return $r;

}


function pagePermission($pagename)
{

    if (Auth::guard('admin')->check() == 1) {

        $roleInfo = permissions(role());
        

        $roleName = $roleInfo->role_keyword;
        $permissionIds = explodePermissionIds($roleInfo->general_permissions);

        // $permission = Auth::user()->permission;
        //$permissions= explode(',',$permission);


        if ($roleName == "superadmin"){
            $permissionstatus = "yes";
           
        }
        else // owner_secondary
        {
           
            // checkhas the menu permission or not 
            $r = DB::table('navigation')
                ->whereIn('id', $permissionIds)
                ->where('page_hint', '=', $pagename)
                ->first();
                
            if ($r)
                $permissionstatus = "yes";
            else
                $permissionstatus = "no";
               
        }
    } else
        $permissionstatus = "no";

     
    // return redirect()->action('DashboardControllers\SuperAdminController@commonrouteredirectifguest');

    if ($permissionstatus == "no") {
        //echo redirect('/owner/No/Access');
    ?>
    <script>
        window.location.replace("<?php echo URL::route("admin.no.pagePermission"); ?>");

    </script>
    <?php
        // echo  redirect()->route('owner.no.pagePermission');
        exit();
    } else
        return "";
}


//***********************Functions in model Moderator************************************* */
function moderatorInfo($moderatorId)
{
    $obj = new Moderator();
    $ObjResult = $obj->moderatorInfo($moderatorId);
 
    return $ObjResult;
}

function registrationOtpSendToUser($user,$callType)
{
    $obj = new Moderator();
    $ObjResult = $obj->registrationOtpSendToUser($user,$callType);
 
    return $ObjResult;
}



function clear()
{ 
   ?> <div class="clearfix"></div>
   <?php
   return "";
}


function explodeList($arrayData)
{
    $List = explode(',', $arrayData);
    return $List;
}


function small_label($style,$text)
{ // values => primary,secondary,success,danger,warning,info,light,dark

?>
    <span class="badge bg-<?php echo $style; ?>"><?php echo $text; ?></span>
   <?php
   return "";
}
function small_label2($style, $text)
{ // values => primary,secondary,success,danger,warning,info,light,dark

?> <span class="label label-sm label-<?php echo $style; ?> no-margin"><?php echo $text; ?></span>


<?php
    return "";
}


function GenInfoAlert($moderatorId)
{
    $obj = new Moderator();
    $objMethod = $obj->GenInfoAlert($moderatorId);
    return $objMethod;
}

//***********************Functions in model ModeratorUpdate************************************* */
function ModeratorUpdateCurrentRow($moderatorId,$type,$clause = NULL)
{
    $obj = new ModeratorUpdate();
    $ObjResult = $obj->ModeratorUpdateCurrentRow($moderatorId,$type,$clause);
     return $ObjResult;
}
 
 function redirectTab($route,$tab){
    echo redirect()->route($route,["#$tab"]); 
}

function adminDefaultEmail(){
    return "admin@gmail.com";
}


//***********************Functions in model User************************************* */
function clientInfo($clientId)
{
    $obj = new User();
    $ObjResult = $obj->clientInfo($clientId);
 
    return $ObjResult;
}

function GenInfoAlertUser($clientId)
{
    $obj = new User();
    $objMethod = $obj->GenInfoAlertUser($clientId);
    return $objMethod;
}

//***********************Functions in model ClientUpdate************************************* */
function ClientUpdateCurrentRow($clientId,$type,$clause = NULL)
{ 
     //dd("$clientId,$type,$clause");
    $obj = new ClientUpdate();
    $ObjResult = $obj->ClientUpdateCurrentRow($clientId,$type,$clause);
     return $ObjResult;
}

function monthList()
{
    $obj = new Month();
    $objMethod = $obj->monthList();
    return $objMethod;
}

function yearList()
{
    $obj = new Year();
    $objMethod = $obj->yearList();
    return $objMethod;
}
function clientApprovalUserInfo($clientId)
{
     
    $clientInfo= clientInfo($clientId);
    $role = $clientInfo->activated_user_type;
    if($role == 1) // super admin
    {
        $approveUser = Admin::Find($clientInfo->activated_by);
        //echo " <b>Approved By:</b>"; small_label("secondary","Admin");
       // echo " <b>Approval User:</b> $approveUser->name";  ;
    }else{
        $approveUser = Moderator::Find($clientInfo->activated_by);
        //echo " <b>Approved By:</b>"; small_label("primary","Moderator");
        //echo " <b>Approval User:</b> $approveUser->name";  ;
    }
    return $approveUser;
     

}

function roleWiseUserInfo($roleId,$userid)
{
     
    $roleInfo = Role::Find($roleId);
    
    if($roleId == 1) // super admin
    {
        $user = Admin::Find($userid);
      
    }elseif($roleId == 3){
        $user = Moderator::Find($userid);
       
    }
    return $user;
     

}


function apartmentsList()
{
    $obj = new Apartment();
    $objMethod = $obj->apartmentsList();
    return $objMethod;
}

function adminEmails(){
    $data = [];
    $adminEmails = []; $k = 0; 
    $admins = Admin::where('status','active')->get();
    foreach($admins as $admin){
        $adminEmails[$k] = $admin->email;
        $k = $k + 1; 
    }
    $adminEmailQty = $k;

    $data['emailQty'] = $adminEmailQty;
    $data['emails'] = $adminEmails;
    return $data;

}
function moderatorEmails(){
    $data = [];
    $moderatorEmails = []; $i = 0;
    $moderators = Moderator::where('activity_status','active')->where('notiType','email')->get();
    foreach($moderators as $moderator){
      $moderatorEmails[$i] = $moderator->email;
      $i = $i + 1; 
    }
    $moderatorEmailQty = $i;

    $data['emailQty'] = $moderatorEmailQty;
    $data['emails'] = $moderatorEmails;
    return $data;
}

function moderatorPhones(){
    $data = [];
    $moderatorPhones = []; $j = 0;

    $moderatorsP = Moderator::where('activity_status','active')->where('notiType','phone')->get();
    foreach($moderatorsP as $moderatorP){
      $moderatorPhones[$j] = $moderatorP->phone;
      $j = $j + 1; 
    }
    $moderatorPhoneQty = $j;
     
    $data['phoneQty'] = $moderatorPhoneQty;
    $data['phones'] = $moderatorPhones;
    return $data;
}
function phoneSms($data,$type){
    if($type == "moderator_notification_phone_verify"){
        $OTP = $data['OTP'];
        $message = "Your OTP - $OTP. Please, validate the phone number with OTP
        ";
    }
    else if($type == "client_phone_verify_for_account_activation_after_registration"){
        $OTP = $data['OTP'];
        $message = "Your OTP - $OTP. Please, submit the OTP to activate your account
        ";
    }
   
    else if($type == "client_payment_notification_to_admin_and_moderator"){
        $name = $data['name']; $apartment_id = $data['apartment_id'];
        $message = "One payment has been submitted. Apartment: $apartment_id. Please log in and check details.
        ";
    }
  
 
    $message.= appname();
    return $message;

}

 /********************Function of model User***************** */
 function checkExistency($wp_id)
 { 
     $obj = new wpData();
     $objMethod = $obj->checkExistency($wp_id); 
     return $objMethod;
 }

 function checkUserExistency($cid)
 { 
     $obj = new Customers();
     $objMethod = $obj->checkUserExistency($cid); 
     return $objMethod;
 }

 function message_alert($class, $msg, $data = '')
{
    if ($data) {
        // $a = explode(',', $data);
        //echo "$a[0], $a[1],$a[2]";
    }

    echo "<div class='alert alert-$class'>$msg ";
    echo "</div>";
    return ("");
}
function customerAccountExistenctCheck($customer_id)
 { 
     return User::where('customer_id',$customer_id)->count();
    
 }

 function customerAccountActivationStatus($customer_id)
 { 
      $u = User::where('customer_id',$customer_id)->first();
     if($u->password == "")
     $status = "not_active";
     else
     $status = "active";
     return $status; 
    
 }
 

 function userInfo($email){
    return User::where('email',$email)->first();
 }

 function checkNonRetrievedExistencyInLocalFetchTable($wp_id){

    $obj = new WpNonRetrived();
    $objMethod = $obj->checkNonRetrievedExistencyInLocalFetchTable($wp_id); 
    return $objMethod;

 }
 
 function currdatetime()
    {
        date_default_timezone_set('Asia/Dhaka');
        $crrentDateTime = carbon::now();
        return $crrentDateTime;
    }


 function guest_session_create()
    {

        if (session()->has('GuestSesId')) {
            //echo "existing ";
            $value = Session::get('GuestSesId');
        } else { // if guset has no Id create session ID
            // catch unique id and datetime and set as session variable
            //echo "First time  ";
            $uniqueid = uniqid();
            $currdatetime = currdatetime();
            $currdatetime = strtotime($currdatetime);

            $guest_unique_id = $uniqueid . $currdatetime;
            $md5_guest_unique_id = md5($guest_unique_id);
            // echo $md5_guest_unique_id."<br>";

            Session::put('GuestSesId', $md5_guest_unique_id);
            $value = Session::get('GuestSesId');
        }

        //echo $value;
        return $value;
    }

    function session_customer($email)
    {

        if (session()->has('sessionCustomer')) {
            //echo "existing ";
            $value = Session::get('sessionCustomer');
        } else { // if guset has no Id create session ID
        
            Session::put('sessionCustomer', $email);
            $value = Session::get('sessionCustomer');
        }

       
        return $value;
    }

 

    function guest_session_destroy()
    {
        Session::forget('GuestSesId');
        //Session::forget('sessionCustomer');
        return "";
    }


    function PublicationStatus($fieldTitle, $formName, $editeVal, $InputFieldName, $id = "null")
    {

    ?>

    <?php if ($fieldTitle != "") echo "<label>$fieldTitle</label>"; ?>
    <select name="<?php echo $InputFieldName; ?>" class="form-control" id="<?php echo $id; ?>" required>
        <option value="" <?php if (old($InputFieldName) == "") { ?>selected<?php } ?>>Select...</option>
        <option value="1" <?php if (old($InputFieldName) == "1") { ?>selected<?php } ?>>Published</option>
        <option value="0" <?php if (old($InputFieldName) == "0") { ?>selected<?php } ?>>Unpublished</option>
    </select>

    <?php if (old($InputFieldName) == "") { ?>
    <script type="text/javascript">
        document.forms["<?php echo $formName; ?>"].elements["<?php echo $InputFieldName; ?>"].value =
            "<?php echo $editeVal; ?>"

    </script>
    <?php } ?>
    <?php
        return "";
    }

    function ProductPicProperty($status)
    {
        $dataArray = [];

        $uploadSize = "1024";
        $type = " jpeg,png,jpg,gif,svg ";

        if ($status == "view")
            return "Upload Size: $uploadSize KB, Type| $type";

        if ($status == "validation") {
            $dataArray[0] = $uploadSize;
            $dataArray[1] = $type;
            return $dataArray;
        }
    }

function linkwithfaicon(
        $routeName,
        $editedId,
        $hrefTitle,
        $hrefClass,
        $hrefStyle,
        $id,
        $name,
        $iconname1,
        $iconname2,
        $linktext,
        $LinkTextPos,
        $onclick,
        $target,
        $spanclass,
        $spanTextColor,
        $arrayData
    ) {
    
        $explodeEditedids =  explode(',', $editedId);
        if ($target == "")
            $target = "self";
    
        /*
                @foreach ($sections as $dataName => $details)
                    <li>
                        <?php $routeName = $details['route']; ?>
    <a href="{{ URL::route($routeName) }}">{{{ $dataName }}}</a>
    </li>
    @endforeach
    */
    ?>
    <?php //if($LinkType=="route") 
        $routeName = URL::route($routeName, $explodeEditedids);
    
        ?>
    
    
    
    <a target="_<?php echo $target; ?>" href="<?php echo $routeName; ?>" title="<?php echo $hrefTitle; ?>"
        class="<?php echo $hrefClass; ?>" style=" <?php echo $hrefStyle; ?>; text-decoration:none " id="<?php echo $id; ?>"
        name="<?php echo $name; ?>" onclick="<?php if ($onclick == "yes") { ?> return OnclickConfirm()<?php }  ?>">
    
        <span class="btn btn-<?php echo $spanclass; ?>"
            style="   color:<?php echo $spanTextColor; ?>; padding-right:0px; padding-left:6px; padding-top:0px; padding-bottom:0px ">
    
            <?php if ($LinkTextPos == "beforeIcon") {
                    echo $linktext;
                    gap(1);
                } ?>
    
            <i class="fa fa-<?php echo $iconname1; ?>" aria-hidden="true"></i> <i class="fas fa-<?php echo $iconname2; ?>"
                aria-hidden="true"></i>
    
            <?php if ($LinkTextPos == "afterIcon") {
                    echo $linktext;
                    gap(1);
                } ?>
        </span>
    </a>
    <script type="text/javascript">
        function OnclickConfirm() {
            var agree = confirm("Do you really want to proceed?");
            if (agree)
                return true;
            else
                return false;
        }
    
    </script>
    
    
    <?php
        return ("");
}
    