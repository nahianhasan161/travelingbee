<?php

namespace App\Http\Requests;

use App\Http\Helpers\Helper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class GroupTourRequest extends FormRequest
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
            'title' => 'required',
            'description' => 'required',
            'division' => 'required',
            'district' => 'required',
            'area' => 'required',
            'place' => 'required',
            'date' => 'required',
            'feature_image'=> '',

            'person' => 'required|numeric|max:10000',
            'price' => 'required|numeric|max:100000',
            'rating' => 'required|numeric|max:5',
            'plans' => 'required',
            'user_id' => 'required'
            /* 'place'=> 'required',
            'description'=> 'required',
            'category'=> 'required',
            'division'=> 'required',
            'district'=> 'required',
            'area'=> 'required',
            'time' => '',
            'day' => 'required|numeric|min:1|max:100', */

        ];

    }
    public function failedValidation(Validator $validation)
    {
        Helper::sendError('Validation Failed' , $validation->errors());
    }
}
