<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
                'email'     => 'required|unique:employees,email,'.$this->id.'NULL,id,isDeleted,0',
                'name'      => 'required',
                'phone'     => 'required',
                'proof_type'=> 'required',
                'address'   =>  'required',
                'designation'   =>  'required',

            ];
        }
        else
        {
            return [
                'email'     => 'required|unique:employees,email,NULL,id,isDeleted,0',
                'name'      => 'required',
                'phone'     => 'required',
                'proof_type'=> 'required',
                'address'   =>  'required',
                'designation'   =>  'required',
                'proof' => 'mimes:jpeg,jpg,png|max:2048',
                // 'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]; 
        }
    }
}
