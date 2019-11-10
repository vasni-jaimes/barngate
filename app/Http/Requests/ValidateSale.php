<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateSale extends FormRequest
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
        return [
            "animals" => "required|max:2",
            "breeds" => "required|max:2",
            "colors" => "required|max:2",
            "genders" => "required|max:2",
            "ages" => "required|max:2",
            "discipline" => "required|max:2",
            "temperament" => "required|max:2",
            "price" => "required|max:255",
            "description" => "required",
            "city" => "required|max:255",
            "region" => "required|max:255",
            "zip" => "required|max:5|numeric",
            "country" => "required|max:255",
            "phone_number" => "required|numeric|max:13"
        ]; 
    }
}
