<?php

namespace App\Http\Requests;

use App\Rules\ValidCity;
use Illuminate\Foundation\Http\FormRequest;

class CalculatePriceRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'addresses.*' => ['required', new ValidCity()],
            'addresses' => 'required|array|min:2',
            'addresses.*.country' => 'required|string|size:2',
            'addresses.*.zip' => 'required|string',
            'addresses.*.city' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'addresses.required' => 'Addresses field is required.',
            'addresses.array' => 'Addresses field must be an array.',
            'addresses.min' => 'Addresses field must contain at least two addresses.',
            'addresses.*.country.required' => 'Country field is required.',
            'addresses.*.zip.required' => 'ZIP code field is required.',
            'addresses.*.city.required' => 'City field is required.',
        ];
    }
}
