<?php

namespace App\Http\Requests;

use App\Traits\FormValidationFailure;
use Illuminate\Foundation\Http\FormRequest;

class EquipmentStore extends FormRequest
{
    use FormValidationFailure;
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
            'name' => 'required|string|max:255',
            'effect' => 'nullable|text',
            'type' => 'required|string|max:50',
            'armor' => 'nullable|Integer|min:0|max:5',
            'elementalResistance' => 'nullable|string|max:50',
            'elementalResistanceValue' => 'nullable|integer|min:1|max:5',
            'class' => 'required|string|max:50',
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
            'name.required' => 'EQU-0202-0001',
            'name.string' => 'EQU-0202-0002',
            'name.max' => 'EQU-0202-0003',
            'effect.string' => 'EQU-0202-0004',
            'type.required' => 'EQU-0202-0005',
            'type.string' => 'EQU-0202-0006',
            'type.max' => 'EQU-0202-0007',
            'armor.integer' => 'EQU-0202-0008',
            'armor.min' => 'EQU-0202-0009',
            'armor.max' => 'EQU-0202-0010',
            'elementalResistance.max' => 'EQU-0202-0011',
            'elementalResistanceValue.integer' => 'EQU-0202-0012',
            'elementalResistanceValue.min' => 'EQU-0202-0013',
            'elementalResistanceValue.max' => 'EQU-0202-0014',
            'class.required' => 'EQU-0202-0015',
            'class.string' => 'EQU-0202-0016',
            'class.max' => 'EQU-0202-0017',
        ];
    }
}
