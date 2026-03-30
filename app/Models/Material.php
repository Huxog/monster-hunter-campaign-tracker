<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Material extends Model
{
    /** @use HasFactory<\Database\Factories\MaterialFactory> */
    use HasFactory, HasUuids, SoftDeletes;

    /** @var string table used to store the model */
    protected $table = 'materials';

    /** @var string The primary key asosciated with the table */
    protected $primaryKey = 'id';

    /** @var array Attributes that are mass assignable */
    protected $fillable = [
        'name',
    ];

    /**
     * Monsters that drop this material
     *
     * @return BelongsToMany<Monster>
     **/
    public function monsters(): BelongsToMany
    {
        return $this->belongsToMany(Monster::class, 'drops', 'materialId', 'monsterId')
            ->withTimestamps();
    }

    /**
     * Hunters that have looted this material
     *
     * @return BelongsToMany<Hunter>
     **/
    public function hunters(): BelongsToMany
    {
        return $this->belongsToMany(Hunter::class, 'loot', 'materialId', 'hunterId')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    /**
     * Weapons that require this material to craft
     *
     * @return MorphToMany<Weapon>
     **/
    public function weapons(): MorphToMany
    {
        return $this->morphedByMany(Weapon::class, 'craftable', 'recipes', 'materialId')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    /**
     * Equipment pieces that require this material to craft
     *
     * @return MorphToMany<Equipment>
     **/
    public function equipment(): MorphToMany
    {
        return $this->morphedByMany(Equipment::class, 'craftable', 'recipes', 'materialId')
            ->withPivot('quantity')
            ->withTimestamps();
    }
}
