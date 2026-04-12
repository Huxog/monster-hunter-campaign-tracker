<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class MonsterCollection extends ResourceCollection
{
    public $collects = MonsterResource::class;
}
