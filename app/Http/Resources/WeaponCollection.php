<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class WeaponCollection extends ResourceCollection
{
    public $collects = WeaponResource::class;
}
