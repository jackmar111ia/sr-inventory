<?php

namespace App\Http\Controllers\Admin;
use App\Models\admin\Customers;
use App\Models\admin\CustomersPreview;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Codexshaper\WooCommerce\Facades\Customer;
use Carbon\Carbon;
use App\User;
use GuzzleHttp\Client;
use Session;
use App\Mail\IframeEmail;
use Mail;

use Illuminate\Support\Str;

class CustomerMangement extends Controller
{
    public function index(){
        pagePermission("customer_data_fetch");
        $q = Customers::count();
         return view('admin.customers.iframe.index',compact('q'));  
   }
    public function fetchedPreview(){
    $q = CustomersPreview::get();
    //dd($q);
    return view('admin.customers.fecthedUserDataFilter',compact('q'));  
   
   }
   public function fetchedPreviewSelectionSave(Request $request){
   
    //dd("here");
    
    $customer_id = [];

    if($request->customer_id!=''){
       foreach($request->customer_id as $q){
          array_push($customer_id, $q); 
          } 
    }

    $q = CustomersPreview::whereIn('customer_id',$customer_id)->get();
    $this->dataTransferFromCustomerPreviewToCustomer($q,"new",0);
    
    //$q = wpFetehedData::truncate();
    return redirect("admin/sr/customers");
    
  }

  private function dataTransferFromCustomerPreviewToCustomer($data,$insertType,$customer_id){
    
    foreach($data as $q1){ //dd("here",$q1->wp_id);
       if($insertType == "new"){
          $q2 = new Customers();
          $q2->customer_id = $q1->customer_id;
       }else{
          $q2 = Customers::where('customer_id',$customer_id)->first();
       }
      
       //$q2->customer_id = $q1->customer_id;
       $q2->image = $q1->image;
       $q2->name = $q1->name;
       $q2->email = $q1->email;
       $q2->user_name = $q1->user_name;

       $q2->phone = $q1->phone;
       $q2->account_status_on_wordpress = $q1->account_status_on_wordpress;

       $q2->send_email_status = 'pending';
       $q2->email_sent_at = '';

       $q2->email_sent_by = 0;
       $q2->created_at = carbon::now();
       $q2->updated_at = '';
       $q2->save();

       
        $updatedCID = $q1->customer_id;
        $q3 = CustomersPreview::where('customer_id',$updatedCID)->first();
        $q3->fetch_status = 'yes';
        $q3->save();
         

    }
    return "";
 }
    public function srCustomers(){
        pagePermission("fetched_customer_list");
        $q = Customers::get();
        //dd($q);
        return view('admin.customers.srCustomers',compact('q'));  
    }

    public function userAccountCreationAndSendEmail(){
        

        $customer_id = $_REQUEST['customer_id'];
        $q1 = customerAccountExistenctCheck($customer_id);
        if($q1 == 0){
            //dd($customer_id);
            $customerInfo = Customers::where('customer_id',$customer_id)->first();
            $user = new User();
            $user->customer_id = $customerInfo->customer_id;
            $user->name = $customerInfo->name;
            $user->user_name = $customerInfo->user_name;
            $user->email = $customerInfo->email;
            $user->email_verification_token = Str::random(40);
            $user->email_verified = 0;

            $user->country_code = "";
            $user->phone = $customerInfo->phone;
            $user->password = '';
        
            $user->ustatus = 'active';
            $user->user_activation_time = '';

            $user->lastlogin = '';
            $user->save();
            $NewUserID = $user->id;

            if($NewUserID>0)  
            {
                $userCreate="success";
                $sent_status = notificatioEmailVerificationCheck($user);
            }
            else
            {
                $userCreate="error";
                $sent_status="not_sent";
            }
            //dd($userCreate,$sent_status);
            // protected $redirectTo is using here, this is defined in this page up
            if(($userCreate == "success") AND ($sent_status == "sent")){
            
                message_alert('success',"Account created and mail sent!");
                
            // return redirect()->route('user.registration.otp.verify'); 
            }
        
        }else{
            $user = User::where('customer_id',$customer_id)->first();
            if(($user->password == "") AND ($user->email_verified == 0)){
                $sent_status = notificatioEmailVerificationCheck($user);
                
                if($sent_status == "sent")
                message_alert('success',"Mail sent success!");
                else
                message_alert('danger',"Mail sent error!");
               
            }else
            message_alert('warning',"Account activated by user!");
        }
       
        
     
     
    }


    public function sendIframeEmail(){

        //dd("here");
        $email = "jacklin@gmail.com";
        Mail::to($email)->send(new IframeEmail());
        if( count(Mail::failures()) > 0 ) {
            /*
            foreach(Mail::failures as $email_address) {
                echo "$email_address <br />";
            }
            */
            $sent_status="not_sent";
        
        } else {
            // echo "Mail sent successfully!";
            $sent_status="sent";
        }
        //*******************for email****************
      

        
    }
    

}
