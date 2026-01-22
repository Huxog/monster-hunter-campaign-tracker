<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CampaignResource extends JsonResource
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
            'name' => $this->name,
            'teamName' => $this->teamName,
            'mapId' => $this->mapId,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
            'map' => new MapResource($this->whenLoaded('map')),
            'hunters' => HunterResource::collection($this->whenLoaded('hunters')),
        ];
    }
}
