<?php

namespace App\Http\Requests;

use App\Enums\ElementalType;
use App\Enums\WeaponClass;
use App\Traits\FormatValidationFailure;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class WeaponStore extends FormRequest
{
    use FormatValidationFailure;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'class' => ['required', new Enum(WeaponClass::class)],
            'element' => ['nullable', new Enum(ElementalType::class)],
            'damage' => 'nullable|array',
            'imagePath' => 'nullable|string',
            'materials' => 'nullable|array',
            'materials.*.id' => 'required|uuid|exists:materials,id',
            'materials.*.quantity' => 'required|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'You must specify a name for the weapon',
            'name.string' => 'The name must be a string',
            'name.max' => 'The name must not exceed 255 characters',
            'class.required' => 'You must specify a weapon class',
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
            'name.required' => 'WPN-0202-0001',
            'name.string' => 'WPN-0202-0002',
            'name.max' => 'WPN-0202-0003',
            'class.required' => 'WPN-0202-0004',
            'class.'.Enum::class => 'WPN-0202-0005',
            'element.'.Enum::class => 'WPN-0202-0006',
            'damage.array' => 'WPN-0202-0007',
            'materials.array' => 'WPN-0202-0008',
            'materials.*.id.exists' => 'WPN-0202-0009',
            'materials.*.quantity.required' => 'WPN-0202-0010',
            'materials.*.quantity.integer' => 'WPN-0202-0011',
            'materials.*.quantity.min' => 'WPN-0202-0012',
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
            'materials' => ['description' => 'Array of materials required to craft this weapon, each with an id and quantity', 'example' => [['id' => 'uuid', 'quantity' => 3]]],
        ];
    }
}
