<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $guarded = []; 

    public function category()
    { 
      return $this->belongsTo('App\Models\admin\Category','category_id'); 
    }

    public function product_type()
    { 
       return $this->belongsTo('App\Models\admin\ProductType','product_type_id'); 
    }

}
