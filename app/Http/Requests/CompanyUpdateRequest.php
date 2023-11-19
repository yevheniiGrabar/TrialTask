<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompanyUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            "company_name" => "string|min:3",
            'country' =>  Rule::exists('countries','id'),
            'vat_number' => 'string',
            'street' => 'string',
            'street_2' => 'string',
            'city' => "string",
            'zipcode' => "string",
            "phone" => "string",
            "email" => "string",
        ];
    }
}
