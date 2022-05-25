<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function products()
    { 
        return $this->hasMany('App\Models\Admin\Products','category_id'); 
    }

    public function categoryList(){
        return $this::paginate(100);
    }

    public function added_admin(){
        return $this->belongsTo('App\Admin', 'addedby', 'id');
    }
    

}
