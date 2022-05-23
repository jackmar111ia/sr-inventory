<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    public function checkUserExistency($cid){
        return $this::where('customer_id',$cid)->count();
    }
}
