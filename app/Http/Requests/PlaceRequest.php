<?php

namespace App\Http\Requests;

use App\Http\Helpers\Helper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class PlaceRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            
'name' => 'required',
'description' => 'required',
'features'=> 'required',
'rating'=> 'required|numeric|max:5',
'price'=> 'required|numeric',
'category_id'=> 'required',
'division'=> 'required',
'district'=> 'required',
'area'=> 'required',
'user_id'=> 'required',
        ];
    }

    public function failedValidation(Validator $validation)
    {
        Helper::sendError('Validation Failed' , $validation->errors());
    }
    
}
