<?php

namespace App\Http\Requests;

use App\Enums\EquipmentType;
use App\Enums\WeaponClass;
use App\Traits\FormatValidationFailure;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class EquipmentUpdate extends FormRequest
{
    use FormatValidationFailure;

    public function authorize(): bool
    {
        return true;
    }

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
            'class' => ['sometimes', 'nullable', new Enum(WeaponClass::class)],
            'imagePath' => 'sometimes|nullable|string',
            'materials' => 'sometimes|nullable|array',
            'materials.*.id' => 'required|uuid|exists:materials,id',
            'materials.*.quantity' => 'required|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'name.string' => 'The name must be a string',
            'name.max' => 'The name must not exceed 255 characters',
            'type.'.Enum::class => 'The type must be a valid equipment type (helmet, vest, trouser)',
            'class.'.Enum::class => 'The class must be a valid weapon class',
            'armor.integer' => 'The armor value must be an integer',
            'armor.min' => 'The armor value must be at least 0',
            'elementalResistances.array' => 'The elemental resistances must be an array',
            'materials.array' => 'Materials must be an array',
            'materials.*.id.exists' => 'One or more materials were not found',
            'materials.*.quantity.required' => 'Each material entry must specify a quantity',
            'materials.*.quantity.integer' => 'Material quantity must be an integer',
            'materials.*.quantity.min' => 'Material quantity must be at least 1',
        ];
    }

    public function codes(): array
    {
        return [
            'name.string' => 'EQP-0204-0001',
            'name.max' => 'EQP-0204-0002',
            'type.'.Enum::class => 'EQP-0204-0003',
            'class.'.Enum::class => 'EQP-0204-0004',
            'armor.integer' => 'EQP-0204-0005',
            'armor.min' => 'EQP-0204-0006',
            'elementalResistances.array' => 'EQP-0204-0007',
            'materials.array' => 'EQP-0204-0008',
            'materials.*.id.exists' => 'EQP-0204-0009',
            'materials.*.quantity.required' => 'EQP-0204-0010',
            'materials.*.quantity.integer' => 'EQP-0204-0011',
            'materials.*.quantity.min' => 'EQP-0204-0012',
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'name' => ['description' => 'The name of the equipment piece', 'example' => 'Rathalos Helm'],
            'effect' => ['description' => 'The skill or effect granted by this equipment', 'example' => 'Attack Boost Lv3'],
            'type' => ['description' => 'The equipment slot type (helmet, vest, trouser)', 'example' => 'helmet'],
            'armor' => ['description' => 'The armor defense value', 'example' => 50],
            'class' => ['description' => 'The weapon class this equipment is associated with', 'example' => 'Great Sword'],
            'elementalResistances' => ['description' => 'Elemental resistance values (0–5 each)', 'example' => ['fire' => 3, 'ice' => 0]],
            'imagePath' => ['description' => 'URL or path to the equipment image', 'example' => 'https://example.com/rathalos-helm.png'],
            'materials' => ['description' => 'Array of materials required to craft this equipment, each with an id and quantity. Omit to leave the recipe unchanged.', 'example' => [['id' => 'uuid', 'quantity' => 2]]],
        ];
    }
}
