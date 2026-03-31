<?php

namespace App\Http\Requests;

use App\Traits\FormatValidationFailure;
use Illuminate\Foundation\Http\FormRequest;

class HunterUpdate extends FormRequest
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
            'playerName' => 'sometimes|string|max:255',
            'hunterName' => 'sometimes|string|max:255',
            'helmetId' => 'nullable|uuid|exists:equipment,id,deleted_at,NULL,type,helmet',
            'vestId' => 'nullable|uuid|exists:equipment,id,deleted_at,NULL,type,vest',
            'trousersId' => 'nullable|uuid|exists:equipment,id,deleted_at,NULL,type,trouser',
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
            'playerName.string' => 'The player name must be a string',
            'playerName.max' => 'The player name must not exceed 255 characters',
            'hunterName.string' => 'The hunter name must be a string',
            'hunterName.max' => 'The hunter name must not exceed 255 characters',
            'helmetId.uuid' => 'The helmet ID must be a valid UUID',
            'helmetId.exists' => 'The specified helmet does not exist or is not a helmet',
            'vestId.uuid' => 'The vest ID must be a valid UUID',
            'vestId.exists' => 'The specified vest does not exist or is not a vest',
            'trousersId.uuid' => 'The trousers ID must be a valid UUID',
            'trousersId.exists' => 'The specified trousers do not exist or are not trousers',
        ];
    }

    public function codes(): array
    {
        return [
            'playerName.string' => 'HUN-0204-0001',
            'playerName.max' => 'HUN-0204-0002',
            'hunterName.string' => 'HUN-0204-0003',
            'hunterName.max' => 'HUN-0204-0004',
            'helmetId.uuid' => 'HUN-0204-0005',
            'helmetId.exists' => 'HUN-0204-0006',
            'vestId.uuid' => 'HUN-0204-0007',
            'vestId.exists' => 'HUN-0204-0008',
            'trousersId.uuid' => 'HUN-0204-0009',
            'trousersId.exists' => 'HUN-0204-0010',
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'playerName' => ['description' => 'The real name of the player', 'example' => 'John Doe'],
            'hunterName' => ['description' => 'The in-game name of the hunter', 'example' => 'Artian'],
            'helmetId' => ['description' => 'UUID of the equipped helmet (must be type helmet)', 'example' => null],
            'vestId' => ['description' => 'UUID of the equipped vest (must be type vest)', 'example' => null],
            'trousersId' => ['description' => 'UUID of the equipped trousers (must be type trouser)', 'example' => null],
        ];
    }
}
