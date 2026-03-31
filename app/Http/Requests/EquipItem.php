<?php

namespace App\Http\Requests;

use App\Traits\FormatValidationFailure;
use Illuminate\Foundation\Http\FormRequest;

class EquipItem extends FormRequest
{
    use FormatValidationFailure;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'equippableId' => 'required|uuid',
        ];
    }

    public function messages(): array
    {
        return [
            'equippableId.required' => 'You must specify an item ID',
            'equippableId.uuid' => 'The item ID must be a valid UUID',
        ];
    }

    public function codes(): array
    {
        return [
            'equippableId.required' => 'HUN-0206-0015',
            'equippableId.uuid' => 'HUN-0206-0016',
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'equippableId' => ['description' => 'UUID of the weapon or equipment to equip from inventory', 'example' => '019bf2f1-70b4-70e2-abd2-83879497461b'],
        ];
    }
}
