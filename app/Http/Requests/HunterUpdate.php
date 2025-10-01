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
            'playerName' => 'required|string|max:255',
            'hunterName' => 'required|string|max:255',
            'campaignId' => 'required|numeric|exists:campaigns,id,deleted_at,NULL',
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
            'playerName.required' => 'You must specify a name for the hunter',
            'playerName.string' => 'The player name must be a string',
            'playerName.max' => 'The player name must not exceed 255 characters',
            'hunterName.required' => 'You must specify a name for the hunter',
            'hunterName.string' => 'The hunter name must be a string',
            'hunterName.max' => 'The hunter name must not exceed 255 characters',
            'campaignId.required' => 'You must specify a campaign for the hunter',
            'campaignId.numeric' => 'The campaign ID must be a number',
        ];
    }

    public function codes(): array
    {
        return [
            'playerName.required' => 'HUN-0204-0001',
            'playerName.string' => 'HUN-0204-0002',
            'playerName.max' => 'HUN-0204-0003',
            'hunterName.required' => 'HUN-0204-0004',
            'hunterName.string' => 'HUN-0204-0005',
            'hunterName.max' => 'HUN-0204-0006',
            'campaignId.required' => 'HUN-0204-0007',
            'campaignId.numeric' => 'HUN-0204-0008',
            'campaignId.exists' => 'HUN-0204-0009',
        ];
    }

    /**
     * Provide descriptions and examples for the request body parameters.
     */
    public function bodyParameters(): array
    {
        return [
            'playerName' => [
                'description' => 'The name of the player controlling the hunter',
                'example' => 'Volovin Volovan',
            ],
            'hunterName' => [
                'description' => 'The name of the hunter',
                'example' => 'Geralt of Rivia',
            ],
            'campaignId' => [
                'description' => 'The ID of the campaign the hunter belongs to',
                'example' => 1,
            ],

        ];
    }
}
