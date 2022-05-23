<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    public function yearList(){
        return $this::all();
    }
}
