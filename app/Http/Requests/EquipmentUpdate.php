<?php

namespace App\Http\Requests;

use App\Enums\EquipmentType;
use App\Enums\WeaponClass;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class EquipmentUpdate extends FormRequest
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
            'name' => 'sometimes|string|max:255',
            'effect' => 'nullable|string',
            'type' => ['sometimes', new Enum(EquipmentType::class)],
            'armor' => 'nullable|integer|min:0',
            'elementalResistances' => 'nullable|array',
            'elementalResistances.fire' => 'nullable|integer|min:0|max:5',
            'elementalResistances.ice' => 'nullable|integer|min:0|max:5',
            'elementalResistances.thunder' => 'nullable|integer|min:0|max:5',
            'elementalResistances.water' => 'nullable|integer|min:0|max:5',
            'elementalResistances.dragon' => 'nullable|integer|min:0|max:5',
            'class' => ['nullable', new Enum(WeaponClass::class)],
        ];
    }
}
