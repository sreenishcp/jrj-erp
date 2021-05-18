<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequst extends FormRequest
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
                'name'            => 'required',
                'cost'            => 'required',
                'selling_price'   => 'required',
                'unit_id'         =>  'required',
                'category_id'     => 'required',
                'quandity'        => 'required',
            ];
        }
        else{
            return [
                'name'            => 'required',
                'cost'            => 'required',
                'selling_price'   => 'required',
                'unit_id'         =>  'required',
                'category_id'     => 'required',
                'quandity'        => 'required',
                'images'          => 'required',
                'images.*'        => 'mimes:jpeg,jpg,png|max:2048'
            ];
        }
    }
}
