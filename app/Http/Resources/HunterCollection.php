<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class HunterCollection extends ResourceCollection
{
    public $collects = HunterResource::class;
}
