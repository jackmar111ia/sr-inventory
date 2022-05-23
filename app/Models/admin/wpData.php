<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class wpData extends Model
{
   public function checkExistency($wp_id){
       return $this::where('wp_id',$wp_id)->count();
   }
}
