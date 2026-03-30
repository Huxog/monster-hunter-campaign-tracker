<?php

namespace App\Http\Requests;

use App\Enums\QuestOutcome;
use App\Traits\FormatValidationFailure;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class QuestStore extends FormRequest
{
    use FormatValidationFailure;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'campaignId' => 'required|uuid|exists:campaigns,id',
            'monsterId' => 'required|uuid|exists:monsters,id',
            'hunterIds' => 'required|array',
            'hunterIds.*' => [
                'required',
                'uuid',
                Rule::exists('hunters', 'id')->where('campaignId', $this->input('campaignId')),
            ],
            'outcome' => ['nullable', 'in:' . implode(',', array_column(QuestOutcome::cases(), 'value'))],
            'completedAt' => 'nullable|date',
        ];
    }

    public function messages(): array
    {
        return [
            'campaignId.required' => 'The campaign ID is required.',
            'campaignId.uuid' => 'The campaign ID must be a valid UUID.',
            'campaignId.exists' => 'The specified campaign was not found.',
            'monsterId.required' => 'The monster ID is required.',
            'monsterId.uuid' => 'The monster ID must be a valid UUID.',
            'monsterId.exists' => 'The specified monster was not found.',
            'hunterIds.required' => 'At least one hunter is required.',
            'hunterIds.array' => 'Hunter IDs must be an array.',
            'hunterIds.*.uuid' => 'Each hunter ID must be a valid UUID.',
            'hunterIds.*.exists' => 'One or more hunters were not found or do not belong to the specified campaign.',
            'outcome.in' => 'The outcome must be one of: success, failure, abandoned.',
            'completedAt.date' => 'The completion date must be a valid date.',
        ];
    }

    public function codes(): array
    {
        return [
            'campaignId.required' => 'QST-0202-0001',
            'campaignId.uuid' => 'QST-0202-0002',
            'campaignId.exists' => 'QST-0202-0003',
            'monsterId.required' => 'QST-0202-0004',
            'monsterId.uuid' => 'QST-0202-0005',
            'monsterId.exists' => 'QST-0202-0006',
            'hunterIds.required' => 'QST-0202-0007',
            'hunterIds.array' => 'QST-0202-0008',
            'hunterIds.*.uuid' => 'QST-0202-0009',
            'hunterIds.*.exists' => 'QST-0202-0010',
            'outcome.in' => 'QST-0202-0011',
            'completedAt.date' => 'QST-0202-0012',
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'campaignId' => ['description' => 'UUID of the campaign this quest belongs to.', 'example' => '9d8e7f6a-1234-5678-abcd-ef0123456789'],
            'monsterId' => ['description' => 'UUID of the monster targeted in this quest.', 'example' => '1a2b3c4d-5678-90ab-cdef-012345678901'],
            'hunterIds' => ['description' => 'Array of hunter UUIDs participating in this quest. All hunters must belong to the specified campaign.', 'example' => []],
            'outcome' => ['description' => 'Quest result: success, failure, or abandoned. Null while the quest is in progress.', 'example' => 'success'],
            'completedAt' => ['description' => 'Date and time when the quest was completed. Null while the quest is in progress.', 'example' => '2026-03-29T20:00:00Z'],
        ];
    }
}
