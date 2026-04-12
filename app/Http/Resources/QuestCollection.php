<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class QuestCollection extends ResourceCollection
{
    public $collects = QuestResource::class;
}
