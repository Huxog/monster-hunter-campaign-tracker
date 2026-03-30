<?php

namespace App\Http\Requests;

use App\Traits\FormatValidationFailure;
use Illuminate\Foundation\Http\FormRequest;

class MonsterStore extends FormRequest
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
            'description' => 'nullable|string',
            'stars' => 'required|integer|min:1|max:7',
            'elementalWeaknesses' => 'nullable|array',
            'elementalWeaknesses.Fire' => 'nullable|integer|min:0|max:3',
            'elementalWeaknesses.Water' => 'nullable|integer|min:0|max:3',
            'elementalWeaknesses.Thunder' => 'nullable|integer|min:0|max:3',
            'elementalWeaknesses.Ice' => 'nullable|integer|min:0|max:3',
            'elementalWeaknesses.Dragon' => 'nullable|integer|min:0|max:3',
            'ailmentWeaknesses' => 'nullable|array',
            'ailmentWeaknesses.Poison' => 'nullable|integer|min:0|max:3',
            'ailmentWeaknesses.Paralysis' => 'nullable|integer|min:0|max:3',
            'ailmentWeaknesses.Sleep' => 'nullable|integer|min:0|max:3',
            'ailmentWeaknesses.Stun' => 'nullable|integer|min:0|max:3',
            'ailmentWeaknesses.Blast' => 'nullable|integer|min:0|max:3',
            'imagePath' => 'nullable|string',
            'materials' => 'nullable|array',
            'materials.*' => 'required|uuid|exists:materials,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The monster name is required.',
            'name.string' => 'The monster name must be a string.',
            'name.max' => 'The monster name may not exceed 255 characters.',
            'stars.required' => 'The difficulty stars rating is required.',
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
            'name.required' => 'MON-0202-0001',
            'name.string' => 'MON-0202-0002',
            'name.max' => 'MON-0202-0003',
            'stars.required' => 'MON-0202-0004',
            'stars.integer' => 'MON-0202-0005',
            'stars.min' => 'MON-0202-0006',
            'stars.max' => 'MON-0202-0007',
            'elementalWeaknesses.array' => 'MON-0202-0008',
            'elementalWeaknesses.*' => 'MON-0202-0009',
            'ailmentWeaknesses.array' => 'MON-0202-0010',
            'ailmentWeaknesses.*' => 'MON-0202-0011',
            'materials.array' => 'MON-0202-0012',
            'materials.*.exists' => 'MON-0202-0013',
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
