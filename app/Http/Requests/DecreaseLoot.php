<?php

namespace App\Http\Requests;

use App\Traits\FormatValidationFailure;
use Illuminate\Foundation\Http\FormRequest;

class DecreaseLoot extends FormRequest
{
    use FormatValidationFailure;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'quantity' => 'required|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'quantity.required' => 'You must specify a quantity',
            'quantity.integer' => 'The quantity must be an integer',
            'quantity.min' => 'The quantity must be at least 1',
        ];
    }

    public function codes(): array
    {
        return [
            'quantity.required' => 'HUN-0206-0012',
            'quantity.integer' => 'HUN-0206-0013',
            'quantity.min' => 'HUN-0206-0014',
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'quantity' => ['description' => 'Amount to subtract from the material quantity', 'example' => 2],
        ];
    }
}
