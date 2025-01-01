<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';

    protected $fillable = [
        'name', 
        'type'
    ];

    public function games()
    {
        return $this->belongsToMany(Game::class);
    }
}
