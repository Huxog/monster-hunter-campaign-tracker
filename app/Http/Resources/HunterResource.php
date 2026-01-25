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
            'helmetId' => $this->helmetId,
            'vestId' => $this->vestId,
            'trousersId' => $this->trousersId,
            'campaign' => new CampaignResource($this->whenLoaded('campaign')),
            'helmet' => new EquipmentResource($this->whenLoaded('helmet')),
            'vest' => new EquipmentResource($this->whenLoaded('vest')),
            'trousers' => new EquipmentResource($this->whenLoaded('trousers')),
        ];
    }
}
