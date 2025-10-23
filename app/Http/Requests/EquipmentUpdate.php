<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'name' => 'required|string|min:3|max:255',
            'effect' => 'nullable|text',
            'type' => 'required|char|min:1|max:1',
            'armor' => 'nullable|Integer|min:0|max:5',
            'elementalResistance' => 'nullable|string|max:50',
            'elementalResistanceValue' => 'nullable|integer|min:1|max:5',
            'class' => 'nullable|string|max:50',
        ];
    }

    /**
     * Get the error messages fo the validation rules
     * 3 char entity
     * 2 digit stack level
     *      middleware -> 01
     *      controller -> 02
     *      service    -> 03
     *      model      -> 04
     *      other      -> 05
     * 2 digit resource route type
     *      index      -> 01
     *      store      -> 02
     *      show       -> 03
     *      update     -> 04
     *      delete     -> 05
     *      custom     -> 06
     * 4 digit sequence map
     *
     * @return array<string, string>
     **/
    public function messages(): array
    {
        return [
            'name.required' => 'You must specify a name for the equipment',
            'name.string' => 'The equipment name must be a string',
            'name.max' => 'The equipment name must not exceed 255 characters',
            'effect.string' => 'The effect must be a string',
            'type.required' => 'You must specify a type for the equipment',
            'type.string' => 'The type must be a string',
            'type.max' => 'The type must not exceed 50 characters',
            'armor.integer' => 'The armor value must be an integer',
            'armor.min' => 'The armor value must be at least 0',
            'armor.max' => 'The armor value must not exceed 5',
            'elementalResistance.string' => 'The elemental resistance must be a string',
            'elementalResistance.max' => 'The elemental resistance must not exceed 50 characters',
            'elementalResistanceValue.integer' => 'The elemental resistance value must be an integer',
            'elementalResistanceValue.min' => 'The elemental resistance value must be at least 1',
            'elementalResistanceValue.max' => 'The elemental resistance value must not exceed 5',
            'class.required' => 'You must specify a class for the equipment',
            'class.string' => 'The class must be a string',
            'class.max' => 'The class must not exceed 50 characters',
        ];
    }

    public function codes(): array
    {
        return [
            'name.required' => 'EQUIP-0204-0001',
            'name.string' => 'EQUIP-0204-0002',
            'name.max' => 'EQUIP-0204-0003',
            'effect.string' => 'EQUIP-0204-0004',
            'type.required' => 'EQUIP-0204-0005',
            'type.string' => 'EQUIP-0204-0006',
            'type.max' => 'EQUIP-0204-0007',
            'armor.integer' => 'EQUIP-0204-0008',
            'armor.min' => 'EQUIP-0204-0009',
            'armor.max' => 'EQUIP-0204-0010',
            'elementalResistance.string' => 'EQUIP-0204-0011',
            'elementalResistance.max' => 'EQUIP-0204-0012',
            'elementalResistanceValue.integer' => 'EQUIP-0204-0013',
            'elementalResistanceValue.min' => 'EQUIP-0204-0014',
            'elementalResistanceValue.max' => 'EQUIP-0204-0015',
            'class.required' => 'EQUIP-0204-0016',
            'class.string' => 'EQUIP-0204-0017',
            'class.max' => 'EQUIP-0204-0018',
        ];
    }

    /**
     * Provide descriptions and examples for the request body parameters.
     */
    public function bodyParameters(): array
    {
        return [
            'name' => [
                'description' => 'Name for the given equipment',
                'example' => 'Great Jagras Helm',
            ],
            'effect' => [
                'description' => 'Brief description of the equipment and its effect in case theres any',
                'example' => 'A helmet made from the scales of a Great Jagras. Offers decent protection. +1 to fire resistance when full armor set is worn.',
            ],
            'type' => [
                'description' => 'What type of equipment is it. Helmet, Vest, Trousers',
                'example' => 'Helmet',
            ],
            'armor' => [
                'description' => 'Armor value provided by the equipment',
                'example' => '3',
            ],
            'elementalResistance' => [
                'description' => 'Elemental resistance provided by the equipment',
                'example' => 'fire',
            ],
            'elementalResistanceValue' => [
                'description' => 'Amount of elemental resistance provided by the equipment',
                'example' => '2',
            ],
            'class' => [
                'description' => 'What class can use this equipment',
                'example' => 'Sword and Shield, Great Sword, Dual Blades',
            ],
        ];
    }
}
