<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Equipment extends Model
{
    /** @use HasFactory<\Database\Factories\EquipmentFactory> */
    use HasFactory, SoftDeletes;

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
        'elementalResistance',
        'elementalResistanceValue',
        'class',
    ];
}
