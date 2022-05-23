<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\admin\Apartment;
 

use Auth;

class ApartmentController extends Controller
{
    public function index(){
        return view('admin.apartments.management');
    }

    public function apartmentNameAddSave(Request $request)
    {    
        $this->apartmentValidationCheck($request);
        $lastid = $this->AddInsert($request);
        
        if ($lastid>0)
        return redirect()->route('admin.apartment.management')->with('success',alertMessage("Apartment has been added successfully!")); // as per sofall tutorial
        else
        return redirect()->back()->withInput();
    
    
    }
    

    public function Edit($id)
    {
         $apartmentInfo = Apartment::with('client_apartment')->Find($id);
        return view('admin.apartments.includes.edit' , ['apartmentInfo' => $apartmentInfo]);
    }

    public function editsave(Request $request)
    {
       
        $this->apartmentValidationCheck($request);
        $lastid = $this->AddInsert($request);
        
        if ($lastid > 0)
        return redirect()->route('admin.apartment.management.edit', ['id' => $lastid])->with('success',alertMessage('Service has been updated successfully'));  
        else
        return redirect()->back()->withInput();
        
    }

    private function apartmentValidationCheck($request)
    {
        $EditableId = $request->editId;
         
        $msgbox =[
                'apartment_nameRequired' => alertMessage("Name should not be empty"),  
            ];
                
            $rules=[
              
                'apartment_name'  => "required|unique:apartments,apartment_name,$EditableId",  

            ];
    
            $custom_error_msg=[
                'apartment_name.required' => "$msgbox[apartment_nameRequired]",
            ];
        $this->validate($request,$rules,$custom_error_msg);
        
     
     
    }

    private function AddInsert($request)
    {
        $editid = $request->editId;
        $uid = Auth::id();
      
        if($editid>0)
        $obj = Apartment::Find($editid);
        else
        $obj = new Apartment();
      
        $obj->apartment_name = $request->apartment_name;
        $obj->status = "available";
       
        
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
