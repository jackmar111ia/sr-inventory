<?php

namespace App\Rules\user\auth;

use Illuminate\Contracts\Validation\Rule;
use App\Models\admin\Apartment;

class checkApartmentAvilability implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
       
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $apartment = $value;
        //dd($apartment);
       $cnt = Apartment::where('apartment_name',$apartment)->count();
       //dd($cnt);
       if($cnt > 0){
        $StatusAvailability = Apartment::where('apartment_name',$apartment)->where('status','=','available')->count();
       // dd($StatusAvailability);
        if($StatusAvailability == 1)
        return true;
       }
      
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {

        return "Apartment not found!";
    }
}
