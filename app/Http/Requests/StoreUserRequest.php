<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
        if($this->id=='')
        {
            return [
                'email'     => 'required|unique:users,email,NULL,id,isDeleted,0',
                'firstname' => 'required',
                'phone'     => 'required',
                'password'  =>'required|confirmed|min:6',
                'branch_id' => 'required'
            ];
        }
        else
        {
            return [
                'email'     => 'required|unique:users,email,'.$this->id.'NULL,id,isDeleted,0',
    
                'firstname' => 'required',
                'lastname'  => 'required',
                'phone'     => 'required',
                'branch_id' => 'required'
            ]; 
        }
    }
}
