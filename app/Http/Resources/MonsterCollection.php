<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MonsterCollection extends ResourceCollection
{
    public $collects = MonsterResource::class;

    public function toArray(Request $request): array
    {
        return [
            'metadata' => [],
            'data' => $this->collection,
        ];
    }
}
