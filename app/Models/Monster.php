<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Monster extends Model
{
    /** @use HasFactory<\Database\Factories\MonsterFactory> */
    use HasFactory, HasUuids, SoftDeletes;

    /** @var string The table associated with the model */
    protected $table = 'monsters';

    /** @var string The primary key associated with the table */
    protected $primaryKey = 'id';

    /** @var array<string> Attributes that are mass assignable */
    protected $fillable = [
        'name',
        'description',
        'stars',
        'elementalWeaknesses',
        'ailmentWeaknesses',
        'imagePath',
    ];

    /** @var array<string, string> Attribute casts */
    protected $casts = [
        'stars' => 'integer',
        'elementalWeaknesses' => 'array',
        'ailmentWeaknesses' => 'array',
    ];

    /**
     * Materials this monster can drop
     *
     * @return BelongsToMany<Material>
     */
    public function materials(): BelongsToMany
    {
        return $this->belongsToMany(Material::class, 'drops', 'monsterId', 'materialId')
            ->withTimestamps();
    }

    /**
     * Quests in which this monster is the target
     *
     * @return HasMany<Quest>
     */
    public function quests(): HasMany
    {
        return $this->hasMany(Quest::class, 'monsterId', 'id');
    }
}
