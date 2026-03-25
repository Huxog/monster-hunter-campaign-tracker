<?php

namespace App\Models;

use App\Enums\EquipmentType;
use App\Enums\WeaponClass;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Equipment extends Model
{
    /** @use HasFactory<\Database\Factories\EquipmentFactory> */
    use HasFactory, HasUuids, SoftDeletes;

    /** @var string table used to store the model */
    protected $table = 'equipment';

    /** @var string The primary key associated with the table */
    protected $primaryKey = 'id';

    /** @var array Attributes that are mass assignable */
    protected $fillable = [
        'name',
        'effect',
        'type',
        'armor',
        'elementalResistances',
        'class',
    ];

    /** @var array Attribute casting */
    protected $casts = [
        'type' => EquipmentType::class,
        'class' => WeaponClass::class,
        'elementalResistances' => 'array',
    ];

    /**
     * Materials required to craft this equipment piece
     *
     * @return MorphToMany<Material>
     **/
    public function materials(): MorphToMany
    {
        return $this->morphToMany(Material::class, 'craftable', 'recipes', null, 'materialId')
            ->withPivot('quantity')
            ->withTimestamps();
    }
}
