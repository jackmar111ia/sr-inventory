<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user\Payment;
use App\Moderator;
use App\Admin;

use Auth; 
use Carbon\Carbon;
use App\Http\Controllers\Traits\smsAndPhoneTrait;


use Mail;
use App\Mail\PaymentNotiSendToAdmins;
use GuzzleHttp\Client;


class PaymentsController extends Controller
{
  use smsAndPhoneTrait;
  
   public function addPayments(){
    $clientId = Auth::user()->id;
    $clientInfo = clientInfo($clientId);
    
    return view('clients.payments.add',[ 'clientInfo' => $clientInfo]);
      
   }
   public function paymentsSave(Request $request){
   // dd($request->opType);
    $clientId = Auth::user()->id;
    $clientInfo = clientInfo($clientId);
    $this->paymentsValidation($request);
   
    $lastid = $this->paymentSaveTodatbase($request);
      
    if($lastid > 0)
    return redirect()->route('client.payments.list.draftsent')->with("success", alertMessage("Payment has been saved successfully!"));// as per sofall tutorial
   

   }
   private function paymentsValidation($request)
   {
       
      

      $regex = 'regex:/^\d+(\.\d{1,2})?$/';
      
      $msgbox =[
            'amountRequired' => alertMessage("Enter amount"),
            'postDateRequired' => alertMessage("Enter posting date"),
            'year_nameRequired' => alertMessage("Select year"),
            'month_nameRequired' => alertMessage("Select month"),
             
       ];
           
        
       $rules=[
            "amount"    => "required|$regex",
            "pay_date"    => "required",
            "year_name"    => 'required' , 
            "month_name"    => "required",
          
       ];

       $custom_error_msg=[
         
         'amount.required' => "$msgbox[amountRequired]",
         'pay_date.required' => "$msgbox[postDateRequired]",
         'year_name.required' => "$msgbox[year_nameRequired]",
         'month_name.required' => "$msgbox[month_nameRequired]",

       ];
      $this->validate($request,$rules,$custom_error_msg);
     
     
   }

   private function paymentSaveTodatbase($request)
   {
        $opType = $request->opType;
        $clientId = Auth::user()->id;
        $clientInfo = clientInfo($clientId);

        if($opType == "add"){
          $editId = 0;
        }else{
            $editId = $request->editId;
        }
        
      
      
      if($opType == "add"){
        $payObj = new Payment();
        $payObj->client_id = $clientId;
        $payObj->apartment_id = $clientInfo->apartment_id;
        $payObj->send_status = 'not_sent';
        $payObj->edit_option = 'open';
        $payObj->approval_status = 'pending';
        $payObj->created_at = Carbon::now();
      }
       
      else {
        $payObj = Payment::where('client_id',$clientId)->where('id',$editId)->where('edit_option','open')->first();
        //dd($payObj);
       
      }
       
      if(!empty($payObj)){
        $payObj->year = $request->year_name;
        $payObj->month = $request->month_name;
        $payObj->amount = $request->amount;
        $payObj->pay_date = $request->pay_date;
        $payObj->note_user = $request->note_user;
        if($opType == "edit")
        $payObj->updated_at = Carbon::now();
        $payObj->save();

        if ($payObj->save())
        $payid = $payObj->id; 
        
      }else{
       $payid = 0;
      }
      return $payid;
   }


   public function draftSentList(){
    // dd($request->opType);
     $clientId = Auth::user()->id;
     $clientInfo = clientInfo($clientId);
     $payList = Payment::where('client_id',$clientId)->where('send_status','not_sent')->paginate(10);
     
     $payListSent = Payment::where('client_id',$clientId)->where('edit_option','locked')->where('send_status','sent')->where('approval_status','!=','approved')->paginate(10);
     // dd($payListSent);
     return view('clients.payments.list.draft_and_sent',[ 'clientInfo' => $clientInfo, 'payList'=>$payList, 'payListSent' => $payListSent]);
    }

    public function approvedList(){
      // dd($request->opType);
     
       $clientId = Auth::user()->id;
       $clientInfo = clientInfo($clientId);
       $payList = Payment::where('client_id',$clientId)->where('approval_status','Approved')->paginate(5);
      //dd($payList);
       return view('clients.payments.list.approved',[ 'clientInfo' => $clientInfo, 'payList'=>$payList ]);
      }
    

    public function paymentEdit($id){
        $clientId = Auth::user()->id;
        $clientInfo = clientInfo($clientId);
        $payInfo = Payment::Find($id);
        return view('clients.payments.edit',[ 'clientInfo' => $clientInfo,'payInfo' => $payInfo]);  
    }

    public function paymentEditSave(Request $request){
      
        $clientId = Auth::user()->id;
        $clientInfo = clientInfo($clientId);
        $this->paymentsValidation($request);
        $lastid = $this->paymentSaveTodatbase($request);
   
        if($lastid > 0)
         return redirect()->route('client.payments.list.draftsent')->with("success", alertMessage("Payment has been updated successfully!"));
        else
        return redirect()->route('client.payments.list.draftsent');
         //return redirect()->back()->with('success', alertMessage("Successfully updated."));
       
    }
    

    public function paymentDelete($id)
    {
       
        $clientId = Auth::user()->id;
        $clientInfo = clientInfo($clientId);

        $payDelete = Payment::find($id)->where('client_id',$clientId)->where('send_status','not_sent')->first();
        //dd($payDelete);
        $payDelete->delete();
        return redirect()->back()->with('success', alertMessage("Successfully deleted."));
       // return redirect()->route('client.payments.list.draftsent')->with('message','Sucessfully deleted');
        
    }

    public function draftSendForPublishMent($id)
    {
       
        $clientId = Auth::user()->id;
        $clientInfo = clientInfo($clientId);

        // mail send
        $payObj = Payment::find($id)->where('client_id',$clientId)->where('send_status','not_sent')->first();
        $payObj->send_status = 'sent';
        $payObj->sent_time = Carbon::now();
        $payObj->edit_option = 'locked';
        $payObj->save();
        // send email alert
        
         // $m = 3;
         if($payObj->save()){
         // if($m == 3){
            // admin emails store to array
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
          
          } 
          // send mail

        return redirect()->back()->withInput(['tab' => 'sent']);
       
    }

    public function paymentDeatilsShow(){
        $payment_id = $_REQUEST['payment_id'];
        $viewtype = $_REQUEST['viewtype'];
        $payInfo =  Payment::with('client')->find($payment_id);
         //dd($payInfo);
        return view("clients.payments.details",['payInfo' => $payInfo,'viewtype' => $viewtype]);
    }

    public function balanceSheet(){
      $clientId = Auth::user()->id;
      $clientInfo = clientInfo($clientId);
      return view('clients.payments.balance.balancesheet',[ 'clientInfo' => $clientInfo]);
    }
    public function yearWisePayments(){
      $year = $_REQUEST['year'];
      $optype = "yearwise";
      return view('clients.payments.balance.ajaxResult',[ 'optype' => 'yearwise', 'year' => $year ]);
    }
    public function yearMonthWisePayments(){
      $year = $_REQUEST['year'];
      $month = $_REQUEST['month'];
      $optype = "yearMonthWise";
      //dd($year,$month);
      return view('clients.payments.balance.ajaxResult',[ 'optype' => 'yearMonthWise', 'year' => $year , 'month' => $month ]);
    }

    private function sendEmailNotification($qty,$emails,$user,$type){
      
      for($i=0; $i<$qty; $i++){
        Mail::to($emails[$i])->send(new PaymentNotiSendToAdmins($user));
      }
      return "";
    }

    private function sendPhoneNotification($qty,$phones,$user,$type){

     
      for($i=0; $i<$qty; $i++){

        $dataSms['status'] = "clientPaymentSubmissionAlert";
        $dataSms['user'] = $user;
        $dataSms['phone'] = $phones[$i];
        $dataSms['phone_no_exist'] = "other_table";
        $smsReturnData = $this->smsResponse($dataSms);

      } // for end 
       
       return "";
    }
   

}
