<?php 
namespace App\Http\Controllers\Traits;
use GuzzleHttp\Client;
use Mail;

trait smsAndPhoneTrait{
     public function smsResponse($data){

        // dd($data['user']['name']);
     
        $status = $data['status'];

        $phone_no_exist = $data['phone_no_exist'];

        if($phone_no_exist == "other_table"){ 
            $userPhone = $data['phone'];
            $userCountryCode = "+88";
        }else{
            $userPhone = $data['user']['phone'];
            $userCountryCode = $data['user']['country_code'];
    
        }
      
        //dd($userCountryCode.$userPhone);
       
        $returnData = enableDisableStatus();
        $otpSendStatus = $returnData[$status];

        $apiLink = smsPostApiLink();
        

        if($otpSendStatus == "on"){ // id send sms on from our system
            // send otp
     
            $message = $this->phoneSms($data);
         
            $toUser = $userCountryCode.$userPhone;
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
        
        // send otp
       
        if(($msgID > 0) AND ($msgTxt == "ACCEPTD"))
           $sent_status="sent";

        else{    
            // if sms send option is on but message send failed then
            $sent_status="not_sent";
            // response from API
            $msgStatus =  $msgData->Status;
            $msgID =  0;
            $msgTxt =  "REJECTED";
        }
       
 
       
        
        $smsReturnData['sent_status'] = $sent_status;
        $smsReturnData['msgStatus'] = $msgStatus;
        $smsReturnData['msgID'] = $msgID;
        $smsReturnData['msgTxt'] = $msgTxt;
        return $smsReturnData;

     } 

     private function phoneSms($data){

        //dd("Here",$data['user']['name'], $data['user']['apartment_id']);

        $type = $data['status'];
        //dd($type);
        if($type == "otpAfterRegiForModeratorPhoneVerification"){
            $OTP = $data['otp'];
            $name = $data['user']['name'];
            $message = "Your OTP - $OTP. Please, submit the OTP to validate your phone.
            ";
        }
        else if($type == "otpAfterRegi"){
            $OTP = $data['otp'];
            $name = $data['user']['name'];
            $message = "Your OTP - $OTP. Please, submit the OTP to activate your account.
            ";
        }
       
        else if($type == "clientPaymentSubmissionAlert"){
            $name = $data['user']['name']; $apartment_id = $data['user']['apartment_id'];
            $message = "One payment has been submitted. Name: $name Apartment: $apartment_id. Please log in and check details.
            ";
        }

        else if($type == "clientAccountActivation"){
            $name = $data['user']['name']; $phone = $data['user']['phone'];
            $message = "Your client account has been activated by admin.Please login using phone '$phone' and password.
            ";
        }


        else if($type == "clientAccountDeclinedByAdmin"){
            $name = $data['user']['name']; $apartment_id = $data['user']['apartment_id'];
            $message = "Your client account has not been approved by admin.
            ";
        }

        else if($type == "clientUpdateApproveByAdminAlert"){
            $name = $data['user']['name'];  
            $message = "Your info update request has been approved by admin.
            ";
        }

        else if($type == "clientUpdateRejectedByAdminAlert"){
            $name = $data['user']['name'];
            $message = "Your info update request has not been approved by admin.
            ";
        }

        else if($type == "clientGenInfoUpdateSubmission"){
            $name = $data['user']['name'];
            $message = "Client $name has submitted general info update request.
            ";
        }
 
     
        $message.= appname();
        return $message;
    
    }

    
}