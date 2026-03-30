<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hunter extends Model
{
    /** @use HasFactory<\Database\Factories\HunterFactory> */
    use HasFactory, HasUuids, SoftDeletes;

    /** @var string table used to store the model */
    protected $table = 'hunters';

    /** @var string The primary key associated with the table */
    protected $primaryKey = 'id';

    /** @var array Attributes that are mass assignable */
    protected $fillable = [
        'playerName',
        'hunterName',
        'campaignId',
        'helmetId',
        'vestId',
        'trousersId',
        'weaponId',
        'class',
    ];

    /**
     * Campaing related to this hunter
     *
     * @return BelongsTo<Campaign>
     **/
    public function campaign(): BelongsTo
    {
        return self::belongsTo(Campaign::class, 'campaignId', 'id');
    }

    /**
     * Currently equipped helmet
     *
     * @return BelongsTo<Equipment>
     **/
    public function helmet(): BelongsTo
    {
        return self::belongsTo(Equipment::class, 'helmetId', 'id');
    }

    /**
     * Currently equipped vest
     *
     * @return BelongsTo<Equipment>
     **/
    public function vest(): BelongsTo
    {
        return self::belongsTo(Equipment::class, 'vestId', 'id');
    }

    /**
     * Currently equipped trousers
     *
     * @return BelongsTo<Equipment>
     **/
    public function trousers(): BelongsTo
    {
        return self::belongsTo(Equipment::class, 'trousersId', 'id');
    }

    /** Currently equipped weapon
     *
     * @return BelongsTo<Weapon>
     **/
    public function weapon(): BelongsTo
    {
        return $this->belongsTo(Weapon::class, 'weaponId', 'id');
    }

    /**
     * Materials looted by this hunter
     *
     * @return BelongsToMany<Material>
     **/
    public function loot(): BelongsToMany
    {
        return $this->belongsToMany(Material::class, 'loot', 'hunterId', 'materialId')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    /**
     * Weapons owned by this hunter
     *
     * @return MorphToMany<Weapon>
     **/
    public function inventoryWeapons(): MorphToMany
    {
        return $this->morphedByMany(Weapon::class, 'inventoryable', 'inventory', 'hunterId')
            ->withTimestamps();
    }

    /**
     * Equipment pieces owned by this hunter
     *
     * @return MorphToMany<Equipment>
     **/
    public function inventoryEquipment(): MorphToMany
    {
        return $this->morphedByMany(Equipment::class, 'inventoryable', 'inventory', 'hunterId')
            ->withTimestamps();
    }

    /**
     * Quests this hunter has participated in
     *
     * @return BelongsToMany<Quest>
     **/
    public function quests(): BelongsToMany
    {
        return $this->belongsToMany(Quest::class, 'quest_hunters', 'hunterId', 'questId')
            ->withTimestamps();
    }
}
