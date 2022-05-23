<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    public function apartmentsList(){
        return $this::with(['client_apartment','added_admin'])->paginate(100);
    }

    public function added_admin(){
        return $this->belongsTo('App\Admin', 'addedby', 'id');
    }

    public function client_apartment()
    {    
        return $this->belongsTo('App\User', 'apartment_name', 'apartment_id')->withDefault();
        
    } 
}
