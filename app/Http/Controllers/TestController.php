<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hotel;
use App\Models\Admin\Category;
class TestController extends Controller
{
    public function index(){
        
        $hotels = Hotel::all();
        return view('admin.test.test', compact('hotels'));
    }
    
    public function update1($id,$color){
        $hotel = Hotel::find($id);
        $hotel->color = $color;
        $hotel->save();
        
    }
    public function update($id,$color){
        $hotel = Category::find($id);
        $hotel->color = $color;
        $hotel->save();
        
    }
}
