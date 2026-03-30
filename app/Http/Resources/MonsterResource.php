<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MonsterResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'stars' => $this->stars,
            'elementalWeaknesses' => $this->elementalWeaknesses,
            'ailmentWeaknesses' => $this->ailmentWeaknesses,
            'imagePath' => $this->imagePath,
            'materials' => MaterialResource::collection($this->whenLoaded('materials')),
            'quests' => QuestResource::collection($this->whenLoaded('quests')),
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];
    }
}
