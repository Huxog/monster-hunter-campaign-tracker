<?php

namespace App\Models;

use App\Enums\QuestOutcome;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quest extends Model
{
    /** @use HasFactory<\Database\Factories\QuestFactory> */
    use HasFactory, HasUuids, SoftDeletes;

    /** @var string The table associated with the model */
    protected $table = 'quests';

    /** @var string The primary key associated with the table */
    protected $primaryKey = 'id';

    /** @var array<string> Attributes that are mass assignable */
    protected $fillable = [
        'campaignId',
        'monsterId',
        'outcome',
        'completedAt',
    ];

    /** @var array<string, string> Attribute casts */
    protected $casts = [
        'outcome' => QuestOutcome::class,
        'completedAt' => 'datetime',
    ];

    /**
     * Campaign this quest belongs to
     *
     * @return BelongsTo<Campaign, Quest>
     */
    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class, 'campaignId', 'id');
    }

    /**
     * Monster targeted in this quest
     *
     * @return BelongsTo<Monster, Quest>
     */
    public function monster(): BelongsTo
    {
        return $this->belongsTo(Monster::class, 'monsterId', 'id');
    }

    /**
     * Hunters participating in this quest
     *
     * @return BelongsToMany<Hunter>
     */
    public function hunters(): BelongsToMany
    {
        return $this->belongsToMany(Hunter::class, 'quest_hunters', 'questId', 'hunterId')
            ->withTimestamps();
    }
}
