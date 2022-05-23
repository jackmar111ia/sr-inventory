<?php

namespace App\Http\Controllers\Moderator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use App\Moderator;
use App\Admin;
use App\Models\moderator\ModeratorUpdate;
use Auth;
use Carbon\Carbon;
use Mail;
use App\Mail\ModeratorGenInfoUpdateSubmission;
 

class SettingsController extends Controller
{
    protected $redirect = "/login#form1";

    public function accountsProperty()
    { 
        //pagePermission("accounts_info");
        $moderatorInfoUpdate = [];
        $moderatorId = Auth::user()->id;
        $moderatorInfo = moderatorInfo($moderatorId);

        $moderatorUpdateTrackCnt = ModeratorUpdateCurrentRow($moderatorId,"count");
        if($moderatorUpdateTrackCnt > 0){
            $moderatorInfoUpdate =  ModeratorUpdateCurrentRow($moderatorId,"row");
        }
       
        return view('moderator.settings.moderatorAccounts',[ 'moderatorInfo' => $moderatorInfo, 'moderatorInfoUpdate' => $moderatorInfoUpdate ]);
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
        $user = Moderator::Find(Auth::user()->id);
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        return redirect()->route('moderator.settings.accounts.property')->with('success','Password changed successfully!');  
    }

    public function accountInfoUpdate(){
        $moderatorId = Auth::user()->id;
        $moderatorInfo = moderatorInfo($moderatorId);

        $moderatorUpdateTrackCnt = ModeratorUpdateCurrentRow($moderatorId,"count");
        if($moderatorUpdateTrackCnt > 0){
            $moderatorInfo =  ModeratorUpdateCurrentRow($moderatorId,"row");
        }

        return view('moderator.settings.accountInfoUpdate',['moderatorInfo' => $moderatorInfo]);
    }

    public function accountInfoUpdateSave(Request $request){
        
        $this->ValidationCheck($request);
        $moderatorId = Auth::user()->id;
        $moderatorInfo = moderatorInfo($moderatorId);
        $moderatorUpdateTrackCnt = ModeratorUpdateCurrentRow($moderatorId,"count");
        //dd($request->all());
        if($moderatorUpdateTrackCnt == 0){
            $moderatorUpdateTrackRow = new ModeratorUpdate();
            $moderatorUpdateTrackRow->moderator_id = $moderatorId;
            $moderatorUpdateTrackRow->status = "current";
            $moderatorUpdateTrackRow->edit_type = "general";
            $moderatorUpdateTrackRow->created_at = Carbon::now();
            
        }
           
        else{
            $moderatorUpdateTrackRow = ModeratorUpdateCurrentRow($moderatorId,"row");
            $moderatorUpdateTrackRow->updated_at = Carbon::now();
        }
            $moderatorUpdateTrackRow->name = $request->name;
            $moderatorUpdateTrackRow->nid = $request->nid;
            $moderatorUpdateTrackRow->present_address = $request->present_address;
            $moderatorUpdateTrackRow->permanent_address = $request->permanent_address;
            $moderatorUpdateTrackRow->save();

        // update Moderrator table 
        $Mobj =  Moderator::Find($moderatorId);
        $Mobj->edit_status = 'saved';
        $Mobj->save();
        return redirect()->route('moderator.settings.accounts.property',['#updateViewGeneralInfo']);
        
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

       // dd("here");
        $moderatorId = Auth::user()->id;
        $moderatorInfo = moderatorInfo($moderatorId);
        $note = $request['note'];

        $moderatorUpdateTrackCnt = ModeratorUpdateCurrentRow($moderatorId,"count");
        if($moderatorUpdateTrackCnt > 0){
            $moderatorUpdateTrackRow =  ModeratorUpdateCurrentRow($moderatorId,"row");
            $moderatorUpdateTrackRow->status = "approval_pending";
            $moderatorUpdateTrackRow->note = $note;
            $moderatorUpdateTrackRow->sent_at =  Carbon::now();
            $moderatorUpdateTrackRow->save();
        }

       
        $Mobj =  Moderator::Find($moderatorId);
        $Mobj->edit_status = 'locked';
        $Mobj->edit_locked_at = Carbon::now();
        $Mobj->save();
       
        $Mobj =  Moderator::Find($moderatorId);
        $adminDefaultEmail = adminDefaultEmail();
       
            //*******************for email****************
           
            $AdminEmails = []; $i = 0;
            $admins = Admin::where('status','active')->get();
            foreach($admins as $admin){
                $AdminEmails[$i] = $admin->email;
              $i = $i + 1; 
            }
            $AdmQty = $i;
          


            for($i=0; $i<$AdmQty; $i++){
                Mail::to($AdminEmails[$i])->send(new ModeratorGenInfoUpdateSubmission($Mobj));
            }

           
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
       
        
        return redirect()->route('moderator.settings.accounts.property',['#updateViewGeneralInfo']);
    }



}
