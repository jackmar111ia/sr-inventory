<?php

namespace App\Models\user;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public function client()
    {    
        return $this->belongsTo('App\User', 'client_id', 'id');
        
    }
}
