<?php

namespace App\Http\Requests;

use App\Traits\FormatValidationFailure;
use Illuminate\Foundation\Http\FormRequest;

class MonsterUpdate extends FormRequest
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
            'description' => 'sometimes|nullable|string',
            'stars' => 'sometimes|integer|min:1|max:7',
            'elementalWeaknesses' => 'sometimes|nullable|array',
            'elementalWeaknesses.Fire' => 'nullable|integer|min:0|max:3',
            'elementalWeaknesses.Water' => 'nullable|integer|min:0|max:3',
            'elementalWeaknesses.Thunder' => 'nullable|integer|min:0|max:3',
            'elementalWeaknesses.Ice' => 'nullable|integer|min:0|max:3',
            'elementalWeaknesses.Dragon' => 'nullable|integer|min:0|max:3',
            'ailmentWeaknesses' => 'sometimes|nullable|array',
            'ailmentWeaknesses.Poison' => 'nullable|integer|min:0|max:3',
            'ailmentWeaknesses.Paralysis' => 'nullable|integer|min:0|max:3',
            'ailmentWeaknesses.Sleep' => 'nullable|integer|min:0|max:3',
            'ailmentWeaknesses.Stun' => 'nullable|integer|min:0|max:3',
            'ailmentWeaknesses.Blast' => 'nullable|integer|min:0|max:3',
            'imagePath' => 'sometimes|nullable|string',
            'materials' => 'sometimes|nullable|array',
            'materials.*' => 'required|uuid|exists:materials,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.string' => 'The monster name must be a string.',
            'name.max' => 'The monster name may not exceed 255 characters.',
            'stars.integer' => 'The difficulty stars must be an integer.',
            'stars.min' => 'The difficulty stars must be at least 1.',
            'stars.max' => 'The difficulty stars may not exceed 7.',
            'elementalWeaknesses.array' => 'Elemental weaknesses must be an object.',
            'elementalWeaknesses.*' => 'Elemental weakness ratings must be integers between 0 and 3.',
            'ailmentWeaknesses.array' => 'Ailment weaknesses must be an object.',
            'ailmentWeaknesses.*' => 'Ailment weakness ratings must be integers between 0 and 3.',
            'materials.array' => 'Materials must be an array.',
            'materials.*.exists' => 'One or more materials were not found.',
        ];
    }

    public function codes(): array
    {
        return [
            'name.string' => 'MON-0204-0001',
            'name.max' => 'MON-0204-0002',
            'stars.integer' => 'MON-0204-0003',
            'stars.min' => 'MON-0204-0004',
            'stars.max' => 'MON-0204-0005',
            'elementalWeaknesses.array' => 'MON-0204-0006',
            'elementalWeaknesses.*' => 'MON-0204-0007',
            'ailmentWeaknesses.array' => 'MON-0204-0008',
            'ailmentWeaknesses.*' => 'MON-0204-0009',
            'materials.array' => 'MON-0204-0010',
            'materials.*.exists' => 'MON-0204-0011',
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'name' => ['description' => 'The name of the monster.', 'example' => 'Rathalos'],
            'description' => ['description' => 'A description of the monster.', 'example' => 'The King of the Skies.'],
            'stars' => ['description' => 'Difficulty rating from 1 to 7.', 'example' => 4],
            'elementalWeaknesses' => [
                'description' => 'Elemental weakness ratings (0 = none, 1 = weak, 2 = very weak, 3 = extreme). Keys: Fire, Water, Thunder, Ice, Dragon.',
                'example' => ['Fire' => 0, 'Water' => 1, 'Thunder' => 3, 'Ice' => 2, 'Dragon' => 1],
            ],
            'ailmentWeaknesses' => [
                'description' => 'Ailment weakness ratings (0 = none, 1 = weak, 2 = very weak, 3 = extreme). Keys: Poison, Paralysis, Sleep, Stun, Blast.',
                'example' => ['Poison' => 2, 'Paralysis' => 1, 'Sleep' => 3, 'Stun' => 0, 'Blast' => 1],
            ],
            'imagePath' => ['description' => 'S3 key for the monster image.', 'example' => 'monsters/rathalos.png'],
            'materials' => ['description' => 'Array of material UUIDs this monster drops.', 'example' => []],
        ];
    }
}
