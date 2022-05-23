<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class Month extends Model
{
   public function monthList(){
       return $this::all();
   }
}
