<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    protected $table = 'libraries';

    protected $fillable = ['user_id', 'name', 'description', 'is_main', 'img_path'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function games() {
        return $this->belongsToMany(Game::class);
    }
}
