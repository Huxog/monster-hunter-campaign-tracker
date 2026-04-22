<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MaterialResource extends JsonResource
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
            'quantity' => $this->whenPivotLoaded('loot', fn () => $this->pivot->quantity,
                fn () => $this->whenPivotLoaded('recipes', fn () => $this->pivot->quantity,
                    fn () => $this->when(
                        array_key_exists('quantity', $this->resource->getAttributes()),
                        fn () => (int) $this->quantity
                    )
                )
            ),
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
            'hunters' => HunterResource::collection($this->whenLoaded('hunters')),
            'weapons' => WeaponResource::collection($this->whenLoaded('weapons')),
            'equipment' => EquipmentResource::collection($this->whenLoaded('equipment')),
            'monsters' => MonsterResource::collection($this->whenLoaded('monsters')),
        ];
    }
}
