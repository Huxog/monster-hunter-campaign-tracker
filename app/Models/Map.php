<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Map extends Model
{
    /** @use HasFactory<\Database\Factories\MapFactory> */
    use HasFactory, HasUuids, SoftDeletes;

    /** @var string table used to store the model */
    protected $table = 'maps';

    /** @var string The primary key asosciated with the table */
    protected $primaryKey = 'id';

    /** @var array Attributes that are mass assignable */
    protected $fillable = [
        'name',
    ];

    /**
     * Campaigns on this maps
     *
     * @return HasMany<Campaign>
     **/
    public function campaigns(): HasMany
    {
        return $this->hasMany(Campaign::class, 'mapId', 'id');
    }
}
