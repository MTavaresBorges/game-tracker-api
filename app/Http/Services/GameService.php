<?php

namespace App\Http\Services;

use App\Models\Library;
use App\Http\Repositories\GameRepository;

class GameService
{
    protected $gameRepository;
    public function __construct(GameRepository $gameRepository)
    {
        $this->gameRepository = $gameRepository;
    }

    public function create(array $data) {
        if($data['pivot']['isMain'] === 1){
            $library = Library::where('user_id', auth()->user()->id)->where('is_main', 1)->first();
            return $this->gameRepository->create($data, $library);
        }
    }
}