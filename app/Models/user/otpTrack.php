<?php

namespace App\Models\user;

use Illuminate\Database\Eloquent\Model;
use Session;
class otpTrack extends Model
{
    public function otpCount(){
        $nonValidatedPhone = Session::get('nonValidatedPhone');
        $cnt = $this::where('phone', $nonValidatedPhone)->count();
        return $cnt;
    }
}
