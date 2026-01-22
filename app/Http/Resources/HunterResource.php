<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HunterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'playerName' => $this->playerName,
            'hunterName' => $this->hunterName,
            'campaignId' => $this->campaignId,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
            'campaign' => new CampaignResource($this->whenLoaded('campaign')),
        ];
    }
}
