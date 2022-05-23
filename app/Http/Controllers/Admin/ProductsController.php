<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Products;
use App\Models\Admin\Category;
use App\Models\Admin\ProductType;
use App\Http\Requests\admin\ProductValidationRequest;

use Image;
use Auth;

class ProductsController extends Controller
{
    public function create(){
        pagePermission('product_create');
        $categories = Category::all();
        $producttypes = ProductType::all();
        return view("admin.products.create",compact('categories','producttypes'));
    }

    public function list()
    {
        $products = Products::get(); 
        return view('admin.products.list',['products' => $products]);
    }
    
    public function save(ProductValidationRequest $request)
    {
        // custom validation is used here 
        // php artisan make:request admin/CityValidationRequest
        

        if($request->hasFile('picture'))
        {
           
            $lastid = $this->ProductSave($request);
               //dd("here");
                if($lastid>0) // general information insertion success
                    {
                        $picSaveStatus = $this->ProductPicUpload($request,$lastid);

                        if ($picSaveStatus == "yes")
                        return redirect()->route('admin.product.management.create')->with('success','Product has been added succefully!'); // as per sofall tutorial
                   
                        else // pic save failed
                        return redirect()->back()->withInput();

                    }
               
                else
                {
                    // insertion failed
                    return redirect()->back()->withInput();
                }
               

        }
        else
        {
           
            $lastid = $this->ProductSave($request);
            
            if ($lastid>0)
            return redirect()->route('admin.product.management.create')->with('success','Product has been added succefully!'); // as per sofall tutorial
        
            else
            return redirect()->back()->withInput();
        }
        //$this->ValidationCheck($request);
     
    }

    

    public function update($id)
    {
        //dd("here");
        pagePermission('product_update');
        $EditableRow = Products::Find($id); 
        //dd($EditableRow);
        $categories = Category::all();
        $producttypes = ProductType::all();

        return view('admin.products.edit',compact('categories','producttypes','EditableRow'));
    }
    public function updateSave(CityValidationRequest $request)
    {

        $EditableId = $request->EditableProductId;

        $pInfo = Products::where('id',$EditableId)->first();
       
        if($request->hasFile('picture')) // country update with image
        {
          
            // first unlink old picturers
            $old_picture = $pInfo->picture;
          

            // pic large unlink 
            if(file_exists($old_picture))
                unlink($old_picture);

            // product info update
            $savedStatus = $this->ProductSave($request);

            //pic info update
            if ($savedStatus == "yes")
            $picSaveStatus = $this->ProductPicUpload($request,$EditableId);

                if ($picSaveStatus == "yes")
                return redirect()->route('softwareSetup.city.list')->with('success','City has been updated successfully!'); // as per sofall tutorial
            
                else
                return redirect()->action('Admin\CityController@update',$EditableId)->back()->withInput();

        }
        else // country update without image
        {   
           
            $savedStatus = $this->ProductSave($request);
         
            if ($savedStatus == "yes")
            return redirect()->route('softwareSetup.city.list')->with('success','City has been updated successfully!'); 
        
            else
            return redirect()->action('Admin\CityController@update',$EditableId)->back()->withInput();
        }
       
        
    }
    public function delete($id)
    {
        $City=City::find($id);
        $City->delete();
        return redirect()->route('softwareSetup.city.list')->with('message','Sucessfully deleted');
         
    }
    public function restore($id)
    {
       // $country=Country::find($id);
       City::withTrashed()->where('id', $id)->restore();
         
        return redirect()->route('softwareSetup.city.list')->with('message','Sucessfully Restored');
        
    }




    private function ProductSave($request)
    { 
        // new entry and save 
        $editid = $request->EditableProductId;
         //dd("here");
        if($editid>0)
        $pObj = Products::Find($editid);
        else
        $pObj = new Products();

       
        $pObj->category_id = $request->category_id;
        $pObj->product_name = $request->product_name;
        $pObj->description = $request->description;
        $pObj->sku = $request->sku;
        $pObj->certification = $request->certification;
        $pObj->case_qty = $request->case_qty;
        $pObj->product_type_id = $request->product_type_id;
        $pObj->regular_price = $request->regular_price;
        $pObj->ontario_price = $request->ontario_price;
        $pObj->canada_price = $request->canada_price;
        $pObj->wb_price = $request->wb_price;
        $pObj->variable_product_price = $request->variable_product_price;
        $pObj->product_add_type = "manual";
        $pObj->product_sr_id = 0;
        $pObj->supplier_sku = $request->supplier_sku;
        $pObj->supplier_description = $request->supplier_description;
        $pObj->supplier_sku = $request->supplier_sku;
        
        $pObj->inhouse_qty = $request->inhouse_qty;
        $pObj->sold_qty = $request->sold_qty;
        $pObj->aviable_qty = $request->aviable_qty;

       
        $pObj->modified_by = Auth::id();
        $pObj->modified_history = '';
        $pObj->indication_color = '';
        $pObj->indication_row_qty = 0;

        if($editid == 0) // if new row entry
        {
            $pObj->pic_large = 'no_pic';
            $pObj->pic_thumb = 'no_thumb';
            $pObj->added_by = Auth::id();
        }
      
        
      
        //$pObj->PublicationStatus = 1;
        $pObj->save();

        if ($pObj->save())
        {
            if($editid > 0) // if edit
            {
                $savedStatus="yes";// current inserted  id take
                return($savedStatus);
            }
            else
            {
                $lastid = $pObj->id;// current inserted  id take
                return($lastid);
            }
             
        }

        
      

    }

    private function ProductPicUpload($request,$lastid)
    {
      // for seeing the picture info
      $picinfo = $request->file('picture'); // for showing the total pic info
      // print_r($picinfo);  // for showing the total pic info
    
      //
      // getClientOriginalName method for taking image extension
      $picext = $picinfo->getClientOriginalExtension(); 
      //***************thumb create**************** 
      //****thumb image upload process 
          // vlink // https://www.youtube.com/watch?v=FPBO4xIil38
          // package install
          //  composer require intervention/image
          //  use Image; eta use korte hobe
      
      
      $thumbimg = Image::make($picinfo->getRealPath());
      $thumbimg->resize(300,300, function($constraint)
          {
              $constraint->aspectRatio();

          }
      );
      $thumbfolder = 'public/images/productImages/thumb/';
      $thpicname = 'th_'.$lastid.'_'.time().".$picext"; 
      // thumb move to folder
      $thumbimg->save($thumbfolder.$thpicname);
      $thumburl = $thumbfolder.$thpicname;
      //***************thumb create****************


      // actual pic name create (add mysql last insert id with picname)
      $picname = $lastid.'_'.time().".$picext";  
      $folder="public/images/productImages/large/";
      $picinfo->move($folder,$picname); // move file
      $picurl = $folder.$picname;

      // now object create using country model
      $Product = Products::find($lastid);
      $Product->pic_large = $picurl;
      $Product->pic_thumb = $thumburl;
      $Product->save();

      if ($Product->save())
      $picSaveStatus = "yes";
      else
      $picSaveStatus = "no";
      //dd($lastid);
      return($picSaveStatus);
  }
}
