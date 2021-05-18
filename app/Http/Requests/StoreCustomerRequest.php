<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
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
        if($this->id!='')
        {
            return [
                'email'        => 'required|unique:customers,email,'.$this->id.'NULL,id,isDeleted,0',
                'name'         => 'required',
                'phone'        => 'required',
                'door_number'  => 'required',
                'postcode'     =>  'required',
                'address_line' =>  'required',

            ];
        }
        else
        {
            return [
                'email'        => 'required|unique:customers,email,NULL,id,isDeleted,0',
                'name'         => 'required',
                'phone'        => 'required',
                'door_number'  => 'required',
                'postcode'     =>  'required',
                'address_line' =>  'required',
            ]; 
        }
    }
}
