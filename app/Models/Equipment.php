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

    /**
     * Get the hunter who owns the equipment
     */
    public function hunter(): belongsto
    {
        switch  ($this->type) {
            case 'Helmet':
                return $this->belongsTo(Hunter::class,'helmet', 'id');
            case 'Vest':
                return $this->belongsTo(Hunter::class,'vest', 'id');
            case 'Trousers':
                return $this->belongsTo(Hunter::class,'trousers', 'id');
            default:
                throw new \Exception("Invalid equipment type");
        }
    }

}
