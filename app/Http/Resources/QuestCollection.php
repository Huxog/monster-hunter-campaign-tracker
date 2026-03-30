<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class QuestCollection extends ResourceCollection
{
    public $collects = QuestResource::class;

    public function toArray(Request $request): array
    {
        return [
            'metadata' => [],
            'data' => $this->collection,
        ];
    }
}
