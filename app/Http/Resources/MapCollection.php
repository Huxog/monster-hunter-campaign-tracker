<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class MapCollection extends ResourceCollection
{
    public $collects = MapResource::class;
}
