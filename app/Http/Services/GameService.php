<?php

namespace App\Http\Services;

use App\Http\Repositories\GameRepository;

class GameService
{
    protected $gameRepository;
    public function __construct(GameRepository $gameRepository)
    {
        $this->gameRepository = $gameRepository;
    }

    public function create(array $data) {
        return $this->gameRepository->create($data);
    }
}