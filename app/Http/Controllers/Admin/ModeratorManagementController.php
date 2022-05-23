<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Moderator;
use App\Models\moderator\ModeratorUpdate;

use Carbon\Carbon;
use Auth;

class ModeratorManagementController extends Controller
{
    public function pending(){
        $mList =  Moderator::where('activity_status','approval_pending')->paginate(10);
        return view('admin.moderators.pending', compact('mList'));
    }

    public function approved(){
        $mList =  Moderator::where('activity_status','!=','approval_pending')->paginate(10);
        return view('admin.moderators.approved', compact('mList'));
    }

    public function approvedModerator($id){
        //dd("here");
        $adminUser = Auth::user()->id;
        $mObj = Moderator::Find($id);
        $mObj->activity_status = 'active';
        $mObj->approvedBy = $adminUser;
        $mObj->approval_time =  Carbon::now();
        $mObj->save();
        return redirect()->route('admin.moderators.head.user.approved')->with("success", alertMessage("Moderator account updated!"));

    }

    public function blockModerator($id){

        $adminUser = Auth::user()->id;
        $mObj = Moderator::Find($id);
        $mObj->activity_status = 'block';
        $mObj->blockedBy = $adminUser;
        $mObj->block_time =  Carbon::now();
        $mObj->save();
        return redirect()->route('admin.moderators.head.approved')->with("success", alertMessage("Moderator account blocked!"));

    }

    public function unBlockModerator($id){

        $adminUser = Auth::user()->id;
        $mObj = Moderator::Find($id);
        $mObj->activity_status = 'active';
        $mObj->approvedBy = $adminUser;
        $mObj->approval_time =  Carbon::now();
        $mObj->save();
        return redirect()->route('admin.moderators.head.approved')->with("success", alertMessage("Moderator account blocked!"));

    }


    public function moderatorDeatilsShow(){

        $moderator_id = $_REQUEST['moderator_id'];
        $viewtype = $_REQUEST['viewtype'];
        // dd($moderator_id);
        $mInfo = Moderator::Find($moderator_id);
        // dd($mInfo);
        return view("admin.moderators.modalDetails",['mInfo' => $mInfo , 'viewtype' => $viewtype]);
    }

    public function updatePending(){
       
        $mList =  Moderator::where('edit_status','locked')->paginate(10);
        //dd($mList);
        return view('admin.moderators.genInfo.pending', compact('mList'));
    }

    public function approvedGenInfoModerator($id){
       
        $adminId = Auth::user()->id;
        $mObjNew = ModeratorUpdate::where('moderator_id',$id)->where('status','approval_pending')->first();
        if($mObjNew){
            $mObj = Moderator::Find($id);
            $mObj->name =  $mObjNew->name;
            $mObj->nid = $mObjNew->nid;
            $mObj->present_address = $mObjNew->present_address;
            $mObj->permanent_address = $mObjNew->permanent_address;
            $mObj->edit_status = 'open';
            $mObj->updated_admin_track = $mObj->updated_admin_track.','.$adminId.'['.Carbon::now().']'.','; 
            $mObj->save();
            if($mObj->save()){
                // update 
                $mObjNew->status = 'expired';
                $mObjNew->save();
            }
            return redirect()->route('admin.moderators.head.update.pending')->with("success", alertMessage("Moderator's info updated!"));

        }
        else{
            return redirect()->back();
        }

        
    }
    public function declineGenInfoModerator($id){
        $adminId = Auth::user()->id;
        $mObjNew = ModeratorUpdate::where('moderator_id',$id)->where('status','approval_pending')->first();
        if($mObjNew){
            $mObj = Moderator::Find($id);
            $mObj->edit_status = 'open';
            $mObj->updated_admin_track = $mObj->updated_admin_track.','.$adminId.'['.Carbon::now().']'.','; 
            $mObj->save();
            if($mObj->save()){
                // update 
                $mObjNew->status = 'expired';
                $mObjNew->save();
            }
            return redirect()->route('admin.moderators.head.update.pending')->with("danger", alertMessage("Moderator's info update declined!"));

        }
        else{
            return redirect()->back();
        }
    }
    
    
    

    
}
