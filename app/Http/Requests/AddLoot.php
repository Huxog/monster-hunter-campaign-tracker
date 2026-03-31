<?php

namespace App\Http\Requests;

use App\Traits\FormatValidationFailure;
use Illuminate\Foundation\Http\FormRequest;

class AddLoot extends FormRequest
{
    use FormatValidationFailure;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'materialId' => 'required|uuid|exists:materials,id,deleted_at,NULL',
            'quantity' => 'required|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'materialId.required' => 'You must specify a material ID',
            'materialId.uuid' => 'The material ID must be a valid UUID',
            'materialId.exists' => 'The specified material does not exist',
            'quantity.required' => 'You must specify a quantity',
            'quantity.integer' => 'The quantity must be an integer',
            'quantity.min' => 'The quantity must be at least 1',
        ];
    }

    public function codes(): array
    {
        return [
            'materialId.required' => 'HUN-0206-0006',
            'materialId.uuid' => 'HUN-0206-0007',
            'materialId.exists' => 'HUN-0206-0008',
            'quantity.required' => 'HUN-0206-0009',
            'quantity.integer' => 'HUN-0206-0010',
            'quantity.min' => 'HUN-0206-0011',
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'materialId' => ['description' => 'UUID of the material to add to loot', 'example' => '019bf2f1-70b4-70e2-abd2-83879497461b'],
            'quantity' => ['description' => 'Amount of the material to add', 'example' => 3],
        ];
    }
}
