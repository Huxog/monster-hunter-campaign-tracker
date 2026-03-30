<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'campaignId' => $this->campaignId,
            'monsterId' => $this->monsterId,
            'outcome' => $this->outcome,
            'completedAt' => $this->completedAt,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
            'campaign' => new CampaignResource($this->whenLoaded('campaign')),
            'monster' => new MonsterResource($this->whenLoaded('monster')),
            'hunters' => HunterResource::collection($this->whenLoaded('hunters')),
        ];
    }
}
