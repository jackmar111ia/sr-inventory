<?php

namespace App\Models\moderator;

use Illuminate\Database\Eloquent\Model;

class ModeratorUpdate extends Model
{
    protected $guarded = [];

    public function ModeratorUpdateCurrentRow($moderatorId,$returnType,$clause){
        if($returnType == "count"){
            if($clause == "approval_pending")
            return ModeratorUpdate::where('moderator_id',$moderatorId)->where('status','approval_pending')->count();
            else
            return ModeratorUpdate::where('moderator_id',$moderatorId)->where('status','current')->count();

        }
        else{
            if($clause == "approval_pending")
            return ModeratorUpdate::where('moderator_id',$moderatorId)->where('status','approval_pending')->first();
            else
            return ModeratorUpdate::where('moderator_id',$moderatorId)->where('status','current')->first();

        }
    }
}
