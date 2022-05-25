<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use Auth;
use Carbon\Carbon;
class CategoryController extends Controller
{
    public function index(){
        return view('admin.category.management');
    }

    public function CategoryNameAddSave(Request $request)
    {    
        $this->categoryValidationCheck($request);
        $lastid = $this->AddInsert($request);
        
        if ($lastid>0)
        return redirect()->route('admin.category.management')->with('success',alertMessage("Apartment has been added successfully!")); // as per sofall tutorial
        else
        return redirect()->back()->withInput();
    
    
    }
    

    public function Edit($id)
    {
        pagePermission('admin_categories_edit');
        $catInfo = Category::Find($id);
        return view('admin.category.includes.edit' , ['catInfo' => $catInfo]);
    }

    public function editsave(Request $request)
    {
       
        $this->categoryValidationCheck($request);
        $lastid = $this->AddInsert($request);
        
        if ($lastid > 0)
        return redirect()->route('admin.category.management.edit', ['id' => $lastid])->with('success',alertMessage('Service has been updated successfully'));  
        else
        return redirect()->back()->withInput();
        
    }

    private function categoryValidationCheck($request)
    {
        $EditableId = $request->editId;
         
        $msgbox =[
                'category_name_required' => alertMessage("Name should not be empty"),  
            ];
                
            $rules=[
              
                'category'  => "required|unique:categories,category,$EditableId",  

            ];
    
            $custom_error_msg = [
                'category.required' => "$msgbox[category_name_required]",
            ];
        $this->validate($request,$rules,$custom_error_msg);
        
     
     
    }

    private function AddInsert($request)
    {
        $editid = $request->editId;
        $uid = Auth::id();
      
        if($editid>0)
        $obj = Category::Find($editid);
        else
        $obj = new Category();
      
        $obj->category = $request->category;
       
        
        if($editid == 0) {
            $obj->addedby = $uid;
            $obj->created_at = Carbon::now();
        }
        
        else
        $obj->updated_at = Carbon::now();

        $obj->save();

        if ($obj->save())
        {
            if($editid == 0) 
            $lastId = $obj->id; // current inserted  id take
            else
            $lastId = $editid; // current inserted  id take
        }
       

        return($lastId);

    } 
}
