<?php

namespace App\Http\Repositories;

use App\Models\Game;
use Illuminate\Support\Facades\DB;

class GameRepository
{
    public function create(array $data) {
        return DB::transaction(function () use ($data) {
            $game = Game::create($data);
        });
    }
}