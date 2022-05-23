<?php

namespace App\Http\Controllers\Common;
use Mail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\user\ClientUpdate;
use Carbon\Carbon;
use App\Mail\ClientAccountActivated;
use GuzzleHttp\Client;
use App\Http\Controllers\Traits\smsAndPhoneTrait;
class ClientsController extends Controller
{
    
   use smsAndPhoneTrait;
    // for admin
    public function approveClientListFromAdmin(){
       
        return view('admin.clients.approved');
    }
    public function pendingClientListFromAdmin(){
        return view('admin.clients.pending');
    }
     // for admin

      // for moderator
    public function approveClientListFromModerator(){
      
        return view('moderator.clients.approved');
    }
    public function pendingClientListFromModerator(){
        return view('moderator.clients.pending');
    }
  // for moderator
   
    
    public function approvedClients($user){

        $userData = json_decode($user);
        //dd($msgData);
        $userId =  $userData->id;
        $userName =  $userData->name;

        $clientList =  User::where('ustatus','active')->paginate(10);

        // dd("$userId,$userName");
        return view('common.clients.tab.iframes.approved', compact('userData','clientList'));
        //return view('common.clients.tab.iframes.approved',['user'=>$user]);
    }

    public function pendingClientApprove(Request $request){
        dd("sdsdsdsdsd");
    }

    public function approvalPendingClients($user){
       
        $userData = json_decode($user);
      // dd($userData->role);
        $clientList = User::where('ustatus','approval_pending')->where('otp_verify_status',1)->where('email_verified',1)->paginate(10);
        return view('common.clients.tab.iframes.pending',['user'=>$userData,'clientList'=>$clientList ]);
    }

    public function approveClientStatus($clientId,$updatedUser,$updatedUserType){
        //dd("$clientId,$updatedUser,$updatedUserType");

        $user = User::where('ustatus','approval_pending')->where('id',$clientId)->first();
        $user->ustatus = 'active';
        $user->activated_by = $updatedUser;
        $user->activated_user_type = $updatedUserType;
        $user->user_activation_time = Carbon::now();

        $user->save();
        
        if($user->save()){
            $notiType = $user->notiType;
            
            if($notiType ==  "email"){
                // send email notification
                Mail::to($user->email)->send(new ClientAccountActivated($user));
                if( count(Mail::failures()) > 0 ) {
                   
                    $sent_status="not_sent";
                
                } else {
                    // echo "Mail sent successfully!";
                    $sent_status="sent";
                }


            }else{
                // send phone notification
                $dataSms['status'] = "clientAccountActivation";
                $dataSms['user'] = $user;
                $dataSms['phone_no_exist'] = "same";
                $this->smsResponse($dataSms);

            }
            //sendUserNotification();
        } 
        // send mail
       
        if($updatedUserType == 1)
        $route  = "return.to.admin.clients.approval.list";
        else
        $route  = "return.to.moderator.clients.approval.list";
       // if($updatedUserType == 1)
       // echo "<script>window.top.location.href = 'clients/list/approved'</script>";

        return redirect()->route($route)->with("success", alertMessage("Client account updated!"));

    }


    public function declineClientStatus($clientId,$updatedUser,$updatedUserType){
       //dd("$clientId,$updatedUser,$updatedUserType decline");
       
        //dd("here");
        $user = User::where('ustatus','approval_pending')->where('id',$clientId)->first();
        $user->ustatus = 'not_active';
        $user->activated_by = $updatedUser;
        $user->activated_user_type = $updatedUserType;
        $user->user_activation_time = Carbon::now();
       // $user->save();
       $m = 0;
       
        if($m == 0){
            $notiType = $user->notiType;
            
            if($notiType ==  "email"){
                // send email notification
                Mail::to($user->email)->send(new ClientAccountActivated($user));
                if( count(Mail::failures()) > 0 ) {
                   
                    $sent_status="not_sent";
                
                } else {
                    // echo "Mail sent successfully!";
                    $sent_status="sent";
                }


            }else{
                // send phone notification
                $dataSms['status'] = "clientAccountDeclinedByAdmin";
                $dataSms['user'] = $user;
                $dataSms['phone_no_exist'] = "same";
                $this->smsResponse($dataSms);

            }
            //sendUserNotification();
        } 
        // send mail
     
        if($updatedUserType == 1)
        $route  = "return.to.admin.clients.approval.list";
        else
        $route  = "return.to.moderator.clients.approval.list";
       // if($updatedUserType == 1)
       // echo "<script>window.top.location.href = 'clients/list/approved'</script>";

        return redirect()->route($route)->with("success", alertMessage("Client account updated!"));

    }

    public function clientDeatilsShow(){

        $client_id = $_REQUEST['client_id'];
        $viewtype = $_REQUEST['viewtype'];
       
        $clientInfo =  clientInfo($client_id);
        //dd($clientInfo);
        $approveUser = clientApprovalUserInfo($client_id);
       // dd($approveUser);
        return view("common.clients.modalDetails",['clientInfo' => $clientInfo,'approveUser' =>$approveUser,'viewtype' => $viewtype]);
    }

    public function pendingGenInfoListromAdmin(){
       
        return view('admin.clients.pendingGenInfo');
    }
    public function pendingGenInfoListromModerator(){
       
        return view('moderator.clients.pendingGenInfo');
    }

    public function pendingGenInfoIframeChild($user){

      
        $userData = json_decode($user);
        //dd($msgData);
        $userId =  $userData->id;
        $userName =  $userData->name;
       // dd($userName);

        $clientList =  User::where('edit_status','locked')->paginate(10);

        // dd("$userId,$userName");
        return view('common.clients.tab.iframes.genInfo', compact('userData','clientList'));
    }
     


    public function approvedGenInfoOfClient($id,$role,$adminId){
       // return redirect()->back();
       //dd($id,$role,$adminId);
        $updateType = "Approved";
        $mObjNew = ClientUpdate::where('client_id',$id)->where('status','approval_pending')->first();
        if($mObjNew){
            $mObj = User::Find($id);
            $mObj->name =  $mObjNew->name;
            $mObj->nid = $mObjNew->nid;
            $mObj->date_of_deed = $mObjNew->date_of_deed;
            $mObj->present_address = $mObjNew->present_address;
            $mObj->permanent_address = $mObjNew->permanent_address;
            $mObj->edit_status = 'open';
            $mObj->save();
            if($mObj->save()){
                // update 
               
                $mObjNew->status = $updateType;
                $mObjNew->approval_user_type = $role;
                $mObjNew->approval_note = '';
                $mObjNew->approved_at = Carbon::now();
                $mObjNew->approved_by = $adminId;
 
                $mObjNew->save();
                 // send phone notification to user
                if($mObjNew->save()){
                    $clientInfo= clientInfo($id);
                    $this->sendPhoneNotification($clientInfo,$updateType);

                }
            }
            
           
            return redirect()->back();

        }
        else{
            return redirect()->back();
        }

        
    }
    public function rejectGenInfoOfClient($id,$role,$adminId){
        //dd($id,$role,$adminId);
        $updateType = "Rejected";
        $mObjNew = ClientUpdate::where('client_id',$id)->where('status','approval_pending')->first();
        if($mObjNew){
            $mObj = User::Find($id);
            $mObj->edit_status = 'open';
            $mObj->save();
            if($mObj->save()){
                // update 
               
                $mObjNew->status = $updateType;
                $mObjNew->approval_user_type = $role;
                $mObjNew->approval_note = '';
                $mObjNew->approved_at = Carbon::now();
                $mObjNew->approved_by = $adminId;
 
                $mObjNew->save();
                 // send phone notification to user
                if($mObjNew->save()){
                    $clientInfo= clientInfo($id);
                    $this->sendPhoneNotification($clientInfo,$updateType);

                }
            }
            
           
            return redirect()->back();

        }
        else{
            return redirect()->back();
        }
    }
    

    private function sendPhoneNotification($user,$updateType){

        
        if($updateType == "Approved")
        $dataSms['status'] = "clientUpdateApproveByAdminAlert";
        else
        $dataSms['status'] = "clientUpdateRejectedByAdminAlert";

        $dataSms['user'] = $user;
        $dataSms['phone_no_exist'] = "same";
        $this->smsResponse($dataSms);
         
         return "";
      }
     
    
    

 
    
}
