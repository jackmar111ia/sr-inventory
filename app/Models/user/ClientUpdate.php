<?php

namespace App\Models\user;

use Illuminate\Database\Eloquent\Model;

class ClientUpdate extends Model
{
    protected $guarded = [];

    public function ClientUpdateCurrentRow($client_id,$returnType,$clause){
      
        //echo "$client_id,$returnType,$clause";
        if($returnType == "count"){
           
            if($clause == "approval_pending")
            return $this::where('client_id',$client_id)->where('status','approval_pending')->count();
            else
            return $this::where('client_id',$client_id)->where('status','current')->count();
        }
        
        else{
            if($clause == "approval_pending")
            return $this::where('client_id',$client_id)->where('status','approval_pending')->first();
            else
            return $this::where('client_id',$client_id)->where('status','current')->first();
        }
        
    }
}

 