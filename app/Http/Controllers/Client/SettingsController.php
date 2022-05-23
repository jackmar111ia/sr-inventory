<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use App\User;
use App\Models\user\ClientUpdate;
use Auth;
use Carbon\Carbon;
use Mail;
use App\Mail\UserGenInfoUpdateSubmission;
use App\Http\Controllers\Traits\smsAndPhoneTrait;
use Session;
 
class SettingsController extends Controller
{
    use smsAndPhoneTrait;
    protected $redirect = "/login#form1";

    public function accountsProperty()
    { 
        //pagePermission("accounts_info");
        
        
        return view('clients.settings.clientsAccountsTab');
    }

     
    public function changePassword(Request $request )
    {
        
        
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);

        //Change Password
        $user = User::Find(Auth::user()->id);
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
 
        return redirect()->route('client.settings.accounts')->with('success','Password changed successfully!');  

    }

    public function accountInfoUpdate(){
        $clientId = Auth::user()->id;
        $clientInfo = clientInfo($clientId);

        $clientUpdateTrackCnt = ClientUpdateCurrentRow($clientId,"count");
        if($clientUpdateTrackCnt > 0){
            $clientInfo =  ClientUpdateCurrentRow($clientId,"row");
        }

        return view('clients.settings.accountInfoUpdate',['clientInfo' => $clientInfo]);
    }

    public function accountInfoUpdateSave(Request $request){
        
        $this->ValidationCheck($request);
        $clientId = Auth::user()->id;
        $clientInfo = clientInfo($clientId);
        $clientUpdateTrackCnt = ClientUpdateCurrentRow($clientId,"count");
        //dd($request->all());
        if($clientUpdateTrackCnt == 0){
            $clientUpdateTrackRow = new ClientUpdate();
            $clientUpdateTrackRow->client_id = $clientId;
            $clientUpdateTrackRow->status = "current";
            $clientUpdateTrackRow->edit_type = "general";
            $clientUpdateTrackRow->created_at = Carbon::now();
            
        }
           
        else{
            $clientUpdateTrackRow = ClientUpdateCurrentRow($clientId,"row");
            $clientUpdateTrackRow->updated_at = Carbon::now();
        }
            $clientUpdateTrackRow->name = $request->name;
            $clientUpdateTrackRow->nid = $request->nid;
            $clientUpdateTrackRow->date_of_deed = $request->date_of_deed;
            $clientUpdateTrackRow->present_address = $request->present_address;
            $clientUpdateTrackRow->permanent_address = $request->permanent_address;
            $clientUpdateTrackRow->save();

        // update Moderrator table 
        $uObj =  User::Find($clientId);
        $uObj->edit_status = 'saved';
        $uObj->save();
        return redirect()->route('client.settings.accounts',['#updateViewGeneralInfo']);
        
    }

    private function ValidationCheck($request)
    {
        $nameLength = 255;
       
        $msgbox =[
            'nameRequired' => "Please enter your name.",
            'nameTypeRequiredString' => "Name should be string",
            'nameMaxLength' => "Name's length should not greater than $nameLength characters",
            
            'nidRequired' => "Please enter valid NID",
            'nidNumeric' => "NID should be number",

            'present_addressRequired' => "Please enter present address",
            'permanent_addressRequired' => "Please enter permanent address",
            
        ];
        
        
      
        $rules=[
            'name'  => "required|string|max:$nameLength",  
            'present_address'  => "required",  
            'permanent_address'  => "required",  
            'nid' => "required|numeric",
        ];

        $custom_error_msg=[

            'name.required'  => $msgbox['nameRequired'], 
            'name.string'  => $msgbox['nameTypeRequiredString'], 
            'name.max'=>  $msgbox['nameMaxLength'], 
  
            'nid.required'  => $msgbox['nidRequired'], 
            'nid.numeric'  => $msgbox['nidNumeric'], 

            'present_address.required'  => $msgbox['present_addressRequired'], 
            'permanent_address.required'  => $msgbox['permanent_addressRequired'], 
            
            
        ];
        
        $this->validate($request,$rules,$custom_error_msg);
      
      

    }

    public function accountInfoSendForPublishment(Request $request){

        $clientId = Auth::user()->id;
        $clientInfo = clientInfo($clientId);
       
        $clientUpdateTrackCnt = ClientUpdateCurrentRow($clientId,"count");
        if($clientUpdateTrackCnt > 0){
            $clientUpdateTrackRow =  ClientUpdateCurrentRow($clientId,"row");
            $clientUpdateTrackRow->status = "approval_pending";
            $clientUpdateTrackRow->note = $request->note;
            $clientUpdateTrackRow->sent_at =  Carbon::now();
            $clientUpdateTrackRow->save();
        }
        
        $Uobj =  User::Find($clientId);
        $Uobj->edit_status = 'locked';
        $Uobj->edit_locked_at = Carbon::now();
        $Uobj->save();
       
       
    
        $data1 = adminEmails();
        // send phone noti to moderators those have phone notification
        $this->sendEmailNotification($data1['emailQty'],$data1['emails'],$clientInfo,"admin");


        // moderator emails store to array
        $data2 = moderatorEmails();
        // send email noti to moderators those have email notification
        $this->sendEmailNotification($data2['emailQty'],$data2['emails'],$clientInfo,"moderator");
        
        // moderator phones store to array
        $data3 = moderatorPhones();
        $this->sendPhoneNotification($data3['phoneQty'],$data3['phones'],$clientInfo,"moderator");


        return redirect()->route('client.settings.accounts',['#updateViewGeneralInfo']);
    }

    public function clientNotiTypeEmail(){
        $notitype = $_REQUEST['notitype'];
        
        $clientId = Auth::user()->id;
        $clientInfo = clientInfo($clientId);
        return view('clients.settings.ajax.clientAjaxResult',['option'=> 'email','clientInfo'=>$clientInfo]);
    }

    public function clientNotiTypePhone(){
        $notitype = $_REQUEST['notitype'];
        //dd($notitype);
        return view('clients.settings.ajax.clientAjaxResult',['option'=> 'phone']);
    }


    
    private function sendEmailNotification($qty,$emails,$user,$type){
      
        for($i=0; $i<$qty; $i++){
          Mail::to($emails[$i])->send(new UserGenInfoUpdateSubmission($user));
        }
        return "";
      }
  
      private function sendPhoneNotification($qty,$phones,$user,$type){
  
        for($i=0; $i<$qty; $i++){

            $dataSms['status'] = "clientGenInfoUpdateSubmission";
            $dataSms['user'] = $user;
            $dataSms['phone'] = $phones[$i];
            $dataSms['phone_no_exist'] = "other_table";
            $smsReturnData = $this->smsResponse($dataSms);

        } // for end 
        
         return "";
      }


      public function showPasswordCreateForm(){

        $email  = Session::get('customer_email');
        return view('auth.customerPasswordCreateForm',compact('email'));  
    }


      public function createPasswordSave(Request $request )
      {
        $email  = Session::get('customer_email');
          //dd($email);
          //dd("$request->new_password",$request->password_confirmation);
         
        
        $rules=[
           
            'password' => 'required|string|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/|
            confirmed',
        ];

        $custom_error_msg=[

        'password.required' => "Password is required",
        'password.min' => "Password's minimum length should be 6",
        'password.regex' => "Within the 6 characters password should contain at least 3 of a-z or A-Z and number and special character.",

        'password.confirmed' => "Password confirmation does not match.",
         
        ];
        $this->validate($request,$rules,$custom_error_msg);
    
        /*
          $validatedData = $request->validate([
              'new_password' => 'required|string|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/|
              confirmed',
          ]);
  
          */
          //Change Password
            $user = User::where('email',$email)->first();
            //$user->password = bcrypt($request->get('new_password'));
            $user->password = Hash::make($request->get('new_password'));
           
            $user->save();
            if($user->save()){
                // forget session 
                Session::forget('customer_email');
                $msgType = "password_creation_success";
            session()->flash('msgType',$msgType);
            session()->flash('type',"success");
            return redirect()->route('login'); 
            }
           
  
      }

      
   
      

}
