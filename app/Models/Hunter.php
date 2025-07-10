<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Hunter extends Model
{
    /** @use HasFactory<\Database\Factories\HunterFactory> */
    use HasFactory, SoftDeletes;

    /** @var string table used to store the model */
    protected $table = 'hunters';

    /** @var string The primary key associated with the table */
    protected $primaryKey = 'id';

    /** @var array Attributes that are mass assignable */
    protected $fillable = [
        'playerName',
        'hunterName',
        'campaignId',
    ];

    /**
     * Campaing related to this hunter
     *
     **/
    public function campaign(): BelongsTo
    {
        return self::belongsTo(Campaign::class, 'campaignId', 'id');
    }
}
