<?php

namespace App\Http\Requests;

use App\Traits\FormatValidationFailure;
use Illuminate\Foundation\Http\FormRequest;

class CraftItem extends FormRequest
{
    use FormatValidationFailure;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'craftableType' => 'required|string|in:weapon,equipment',
            'craftableId' => 'required|uuid',
        ];
    }

    public function messages(): array
    {
        return [
            'craftableType.required' => 'You must specify a craftable type',
            'craftableType.string' => 'The craftable type must be a string',
            'craftableType.in' => 'The craftable type must be either weapon or equipment',
            'craftableId.required' => 'You must specify a craftable ID',
            'craftableId.uuid' => 'The craftable ID must be a valid UUID',
        ];
    }

    public function codes(): array
    {
        return [
            'craftableType.required' => 'HUN-0206-0001',
            'craftableType.string' => 'HUN-0206-0002',
            'craftableType.in' => 'HUN-0206-0003',
            'craftableId.required' => 'HUN-0206-0004',
            'craftableId.uuid' => 'HUN-0206-0005',
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'craftableType' => ['description' => 'The type of item to craft', 'example' => 'weapon'],
            'craftableId' => ['description' => 'UUID of the weapon or equipment to craft', 'example' => '019bf2f1-70b4-70e2-abd2-83879497461b'],
        ];
    }
}
