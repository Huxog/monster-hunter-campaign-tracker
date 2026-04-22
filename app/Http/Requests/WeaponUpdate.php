<?php

namespace App\Http\Requests;

use App\Enums\ElementalType;
use App\Enums\WeaponClass;
use App\Traits\FormatValidationFailure;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class WeaponUpdate extends FormRequest
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
            'class' => ['sometimes', new Enum(WeaponClass::class)],
            'element' => ['sometimes', 'nullable', new Enum(ElementalType::class)],
            'damage' => 'nullable|array',
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
            'class.'.Enum::class => 'The class must be a valid weapon class',
            'element.'.Enum::class => 'The element must be a valid elemental type',
            'damage.array' => 'The damage must be an array',
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
            'name.string' => 'WPN-0204-0001',
            'name.max' => 'WPN-0204-0002',
            'class.'.Enum::class => 'WPN-0204-0003',
            'element.'.Enum::class => 'WPN-0204-0004',
            'damage.array' => 'WPN-0204-0005',
            'materials.array' => 'WPN-0204-0006',
            'materials.*.id.exists' => 'WPN-0204-0007',
            'materials.*.quantity.required' => 'WPN-0204-0008',
            'materials.*.quantity.integer' => 'WPN-0204-0009',
            'materials.*.quantity.min' => 'WPN-0204-0010',
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'name' => ['description' => 'The name of the weapon', 'example' => 'Rathalos Blade'],
            'class' => ['description' => 'The weapon class', 'example' => 'Great Sword'],
            'element' => ['description' => 'The elemental type of the weapon', 'example' => 'Fire'],
            'damage' => ['description' => 'The damage deck data for this weapon', 'example' => []],
            'imagePath' => ['description' => 'URL or path to the weapon image', 'example' => 'https://example.com/rathalos-blade.png'],
            'materials' => ['description' => 'Array of materials required to craft this weapon, each with an id and quantity. Omit to leave the recipe unchanged.', 'example' => [['id' => 'uuid', 'quantity' => 3]]],
        ];
    }
}
