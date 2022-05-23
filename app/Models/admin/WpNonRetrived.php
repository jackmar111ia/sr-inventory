<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class WpNonRetrived extends Model
{
    public function checkNonRetrievedExistencyInLocalFetchTable($wp_id){
        return $this::where('wp_id',$wp_id)->count();
    }
}
