<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use App\Models\user\Payment;

use Mail;
use App\Mail\clientPaymentUpdated;
use Carbon\Carbon;

class PaymentsController extends Controller
{
    // for admin
    public function approvePaymentsListFromAdmin(){
       
        return view('admin.payments.approved');
    }
    public function pendingPaymentsListFromAdmin(){
        return view('admin.payments.pending');
    }
     // for admin

       // for moderator
    public function approvePaymentsListFromModerator(){
      
        return view('moderator.payments.approved');
    }
    public function pendingPaymentsListFromModerator(){
        return view('moderator.payments.pending');
    }
  // for moderator
  

  public function approvedPaymentsIframeChild($user){

    $userData = json_decode($user);
    //dd($msgData);
    $userId =  $userData->id;
    $userName =  $userData->name;

    $userList = User::paginate(10);
    $payInfo = Payment::where('send_status','sent')->where('approval_status','approved')->paginate(10);
    
   // dd("$userId,$userName");
    return view('common.payments.tab.iframes.approved', compact('userData','payInfo'));
     
    }
    public function pendingPaymentsIframeChild($user){
        $userData = json_decode($user);
        //dd($userData);
        $userId =  $userData->id;
        $userName =  $userData->name;

        $userList = User::paginate(10);
        // dd($userList);
        $payInfo = Payment::with('client')->where('send_status','sent')->where('approval_status','!=','Approved')->paginate(2);
        
         //dd($payInfo);
        return view('common.payments.tab.iframes.pending', compact('userData','payInfo'));
       
    }

    
    public function iFrameSinglePaymentUpdate($id,$updateUserId,$updateUserRole){
        //echo $id; 
      
       // notification to user
        $payInfo = Payment::with('client')->where('id',$id)->first();
        //dd("Updated user id = $updateUserId,urole = $updateUserRole, payment id = $id, client id = $payObj->client_id");
        $client_id = $payInfo->client_id;
        $user = clientInfo($client_id);

        $userData = roleWiseUserInfo($updateUserRole,$updateUserId);

        //dd($userData);

        return view('common.payments.tab.iframes.paymentUpdateForm', compact('userData','payInfo'));
    }

    public function iFrameSinglePaymentUpdateSave(Request $request){
       
        $updateUserRole = $request->updatedUserRole;
        $updateType = $request->updateType;
        $updateUserId = $request->updatedUserId;
        $note_approved_user = $request->note_approved_user;
        $pay_id =  $request->pay_id;
        
        
        $payObj = Payment::with('client')->where('id',$pay_id)->first();
      
        $client_id = $payObj->client_id;
        $user = clientInfo($client_id); // client Info
       //dd("Updated user id = $updateUserId,urole = $updateUserRole, payment id = $pay_id, client id = $client_id");

         //dd($payObj);
     
        $payObj->approval_status = $updateType;
        if($updateType == "Approved"){
            $payObj->edit_option = 'locked';
        }else{
            $payObj->send_status = 'not_sent';
            $payObj->edit_option = 'open';
        }
        $payObj->approve_update_user = $updateUserRole;
        $payObj->approved_by = $updateUserId;
        $payObj->approved_time = Carbon::now();
        $payObj->note_approved_user = $note_approved_user;
        $payObj->save();
        //$m = 3;
        if($payObj->save()){
        //if($m == 3){
            $notiType = $user->notiType;
            
            if($notiType ==  "email"){
                // send email notification
                Mail::to($user->email)->send(new clientPaymentUpdated($payObj));
                if( count(Mail::failures()) > 0 ) {
                   
                    $sent_status="not_sent";
                
                } else {
                    // echo "Mail sent successfully!";
                    $sent_status="sent";
                }


            }else{
                // send phone notification
                $data = enableDisableStatus();
                $otpSendStatus = $data['clientPaymentUpdateAlert'];
        
                $apiLink = smsPostApiLink();
                $toUser = $user->phone;
                $apartment_id = $payObj->client->apartment_id;
                $approval_status = $payObj->approval_status;
                $amount = $payObj->amount;
                $year = $payObj->year;
                $month = $payObj->month;


                if($otpSendStatus == "on"){ // id send sms on from our system
                    // send otp
                    $message = "Dear $user->name,
                    Your payment has been updated.
                    Update Type : $approval_status  
                     Apartment : $apartment_id  
                     Amount :  $amount 
                     Month  : $month 
                     Year  : $year  
                     Please log in to your account and check details in payment section.
                    Thanking you.
                   ".appname()."
                        ";
                    $countryCode = $user->country_code;
                    $toUser = $countryCode.$user->phone;
                    $client = new \GuzzleHttp\Client();
        
                    $url = $apiLink;
                    $response = $client->request('POST', $url, [
                        'form_params' => [
                            'callerID' => "+8801839822261",
                            'toUser' => $toUser,
                            'messageContent' => $message,
                        ]
                    ]);
        
                    // echo $response->getBody(); // it will also work
                    // return  $response->getBody();  // it will also work
                    // {"Status":"0","Text":"ACCEPTD","Message_ID":"38592044"}
        
                    $msgData = json_decode($response->getBody()->getContents());
                    //dd($msgData);
        
                     // response from API
                    $msgStatus =  $msgData->Status;
                    $msgID =  $msgData->Message_ID;
                    $msgTxt =  $msgData->Text;
                }else{ 
                    // if we stop sms send option then we set the below fake ID 
                    $msgStatus =  0;
                    $msgID =  1;
                    $msgTxt =  "ACCEPTD";
                }


            }
            //sendUserNotification();
        } 
        // send mail
       $updatedUserType = $updateUserRole;
        if($updatedUserType == 1)
        $route  = "return.to.admin.clients.payment.pending.list";
        else
        $route  = "return.to.moderator.clients.payment.pending.list";
       // if($updatedUserType == 1)
       // echo "<script>window.top.location.href = 'clients/list/approved'</script>";

        return redirect()->route($route)->with("success", alertMessage("Client payment updated!"));


        //return redirect()->back()->withInput(['tab' => 'sent']);
    }


    public function balanaceSheetCheckFromAdmin(){
        return view('admin.payments.balanace-sheet');
    }

    public function balanaceSheetIframeChild($user){
        
        $userData = json_decode($user);
        //dd($msgData);
        $userId =  $userData->id;
        $userName =  $userData->name;

        $userList = User::paginate(10);
        $payInfo = Payment::where('send_status','sent')->where('approval_status','approved')->paginate(10);
        
    // dd("$userId,$userName");
        return view('common.payments.tab.iframes.balancesheet', compact('userData','payInfo'));
     
    }

    public function balanaceSheetCheckFromModerator(){
      
        return view('moderator.payments.balance-sheet');
    }

    // ajax
    public function yearWisePayments(){
        $year = $_REQUEST['year'];
        $client_id = $_REQUEST['client_id'];
        //dd($client_id);
        $optype = "yearwise";
        return view('common.payments.balance.ajaxResult',[ 'optype' => 'yearwise', 'year' => $year, 'client_id'=> $client_id ]);
      }
      public function yearMonthWisePayments(){
          
        $year = $_REQUEST['year'];
        $month = $_REQUEST['month'];
        $client_id = $_REQUEST['client_id'];
        $optype = "yearMonthWise";
 
        return view('common.payments.balance.ajaxResult',[ 'optype' => 'yearMonthWise', 'year' => $year , 'month' => $month , 'client_id'=> $client_id ]);
      }


    
    

}
