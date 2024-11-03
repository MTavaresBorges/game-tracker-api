<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GameImage extends Model
{
    protected $fillable = [
        'game_id',
        'url',
        'alt_text',
        'order',
    ];

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }
}
