<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WeaponResource extends JsonResource
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
            'class' => $this->class,
            'element' => $this->element,
            'damage' => $this->damage,
            'imagePath' => $this->imagePath,
            'hunter' => new HunterResource($this->whenLoaded('hunter')),
            'materials' => MaterialResource::collection($this->whenLoaded('materials')),
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];
    }
}
