<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    public function products()
    { 
        return $this->hasMany('App\Models\Admin\Products','product_type_id'); 
    }

}
