<?php

namespace App\Http\Requests;

use App\Traits\FormatValidationFailure;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MaterialUpdate extends FormRequest
{
    use FormatValidationFailure;

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
            'name' => ['required', 'string', 'max:255', Rule::unique('materials')->ignore($this->route('material'))],
        ];
    }

    /**
     * Get the error messages for the validation rules.
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
            'name.required' => 'You must specify a name for the material',
            'name.string' => 'The name must be a string',
            'name.max' => 'The name must not exceed 255 characters',
            'name.unique' => 'A material with this name already exists',
        ];
    }

    public function codes(): array
    {
        return [
            'name.required' => 'MAT-0204-0001',
            'name.string' => 'MAT-0204-0002',
            'name.max' => 'MAT-0204-0003',
            'name.unique' => 'MAT-0204-0004',
        ];
    }

    /**
     * Provide descriptions and examples for the request body parameters.
     */
    public function bodyParameters(): array
    {
        return [
            'name' => [
                'description' => 'The updated name of the material',
                'example' => 'Rathalos Ruby',
            ],
        ];
    }
}
