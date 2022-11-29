<?php

namespace App\Http\Requests;

use App\Http\Helpers\Helper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class DistrictRequest extends FormRequest
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
            'bn_name' => 'required',
            'url' => 'required',
            'division_id' => 'required',

        ];
    }
    public function failedValidation(Validator $validator)
    {

        Helper::sendError('Validation Failed',$validator->errors());
    }
}
