<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductValidationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
       
        // dd($this->all()); 
        $ValueArray = $this->DynamicValues();
       // $countryid=$this->countryid; 
        
        $EditableProductId = $this->EditableProductId;
       
        if($this->hasFile('picture')){
            $picFieldName = 'picture';
            $picVaidationProperty = "required|image|mimes:$ValueArray[picture_type]|max:$ValueArray[picture_size]";
           
        }
        else
        {
            $picFieldName = '';
            $picVaidationProperty = "";
        }
        
         
        return [
            //'countryid' => "required",
            'category_id' => "required",
            'producty_type_id' => "required",
            'product_name'  => "required", // here the categoryname is the variable that came from form input field name
            'description' => "required",
            'sku'  => "required",
            //'titleTag'  => "required|min:$ValueArray[titleTag_min]|max:$ValueArray[titleTag_max]",
            "$picFieldName" => $picVaidationProperty
           
        ];
       
    }

    public function messages()
    {
         // user defined function
        $msgbox = $this->MessagesWithDynamicDatas();
        return [
           // 'countryid.required' => "$msgbox[countryid_required]",
            'category_id.required'   => "$msgbox[category_id_required]",
            'producty_type_id.required'   => "$msgbox[producty_type_id_required]",
            'product_name.required' => "$msgbox[product_name_required]",
            'description.required' => "$msgbox[description_required]",
            'sku.required' => "$msgbox[sku_required]",

            'picture.required'=> "$msgbox[picture_required]",
            'picture.image'=> "$msgbox[picture_image]",
            'picture.mimes'=> "$msgbox[picture_mimes]",
            'picture.max'=> "$msgbox[picture_size]",
    
           
        ];

         
        
    }

    private function DynamicValues()
    {
        // function from helper
        $picProperty = ProductPicProperty("validation");
        // user defined function
       
        $data =[
             
            'picture_type' => $picProperty[1],
            'picture_size' => $picProperty[0]


        ];
        return $data;
    }

    private function MessagesWithDynamicDatas()
    {
          // user defined function

        $ValueArray = $this->DynamicValues();

        $msgbox =[
            'category_id_required' => 'Please select category!',
            'producty_type_id_required' => 'Please select product type!',
            
            'product_name_required' => 'Product name is required!',
            'description_required' => 'Please select descriptiond!',
            'sku_required' => 'Please select sku!',
  
            'picture_required' => 'Picture is required',
            'picture_image' => 'Picture must be an image',
            'picture_mimes' => "Picture type should be in $ValueArray[picture_type]",
            'picture_size' => "Picture size limit $ValueArray[picture_size]",
 

        ];
        return $msgbox;
    }
}
