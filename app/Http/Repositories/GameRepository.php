<?php

namespace App\Http\Repositories;

use App\Models\Game;

class GameRepository
{
    public function updateOrCreate(array $data) {
        return Game::updateOrCreate($data);
    }
}