<?php

namespace App\Http\Requests;

use App\Enums\QuestOutcome;
use App\Traits\FormatValidationFailure;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class QuestUpdate extends FormRequest
{
    use FormatValidationFailure;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $campaignId = $this->input('campaignId', $this->route('quest')?->campaignId);

        return [
            'campaignId' => 'sometimes|uuid|exists:campaigns,id',
            'monsterId' => 'sometimes|uuid|exists:monsters,id',
            'hunterIds' => 'sometimes|array',
            'hunterIds.*' => [
                'required',
                'uuid',
                Rule::exists('hunters', 'id')->where('campaignId', $campaignId),
            ],
            'outcome' => ['sometimes', 'nullable', 'in:' . implode(',', array_column(QuestOutcome::cases(), 'value'))],
            'completedAt' => 'sometimes|nullable|date',
        ];
    }

    public function messages(): array
    {
        return [
            'campaignId.uuid' => 'The campaign ID must be a valid UUID.',
            'campaignId.exists' => 'The specified campaign was not found.',
            'monsterId.uuid' => 'The monster ID must be a valid UUID.',
            'monsterId.exists' => 'The specified monster was not found.',
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
            'campaignId.uuid' => 'QST-0204-0001',
            'campaignId.exists' => 'QST-0204-0002',
            'monsterId.uuid' => 'QST-0204-0003',
            'monsterId.exists' => 'QST-0204-0004',
            'hunterIds.array' => 'QST-0204-0005',
            'hunterIds.*.uuid' => 'QST-0204-0006',
            'hunterIds.*.exists' => 'QST-0204-0007',
            'outcome.in' => 'QST-0204-0008',
            'completedAt.date' => 'QST-0204-0009',
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'campaignId' => ['description' => 'UUID of the campaign this quest belongs to.', 'example' => '9d8e7f6a-1234-5678-abcd-ef0123456789'],
            'monsterId' => ['description' => 'UUID of the monster targeted in this quest.', 'example' => '1a2b3c4d-5678-90ab-cdef-012345678901'],
            'hunterIds' => ['description' => 'Array of hunter UUIDs. Replaces the current participant list. All hunters must belong to the campaign.', 'example' => []],
            'outcome' => ['description' => 'Quest result: success, failure, or abandoned.', 'example' => 'failure'],
            'completedAt' => ['description' => 'Date and time when the quest was completed.', 'example' => '2026-03-29T20:00:00Z'],
        ];
    }
}
