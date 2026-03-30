<?php

namespace App\Models;

use App\Enums\ElementalType;
use App\Enums\WeaponClass;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Weapon extends Model
{
    /** @use HasFactory<\Database\Factories\WeaponFactory> */
    use HasFactory, HasUuids, SoftDeletes;

    /** @var string table used to store the model */
    protected $table = 'weapons';

    /** @var string The primary key associated with the table */
    protected $primaryKey = 'id';

    /** @var array Attributes that are mass assignable */
    protected $fillable = [
        'name',
        'class',
        'element',
        'damage',
    ];

    /** @var array Attribute casting */
    protected $casts = [
        'class' => WeaponClass::class,
        'element' => ElementalType::class,
        'damage' => 'array',
    ];

    public function hunter(): HasOne
    {
        return $this->hasOne(Hunter::class, 'weaponId', 'id');
    }

    /**
     * Materials required to craft this weapon
     *
     * @return MorphToMany<Material>
     **/
    public function materials(): MorphToMany
    {
        return $this->morphToMany(Material::class, 'craftable', 'recipes', null, 'materialId')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    /**
     * Hunters who own this weapon in their inventory
     *
     * @return MorphToMany<Hunter>
     **/
    public function hunters(): MorphToMany
    {
        return $this->morphToMany(Hunter::class, 'inventoryable', 'inventory', null, 'hunterId')
            ->withTimestamps();
    }
}
