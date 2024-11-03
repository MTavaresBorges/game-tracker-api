<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class State extends Model
{
    protected $fillable = [
        'name',
        'uf'
    ];

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }
}
