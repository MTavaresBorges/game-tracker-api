<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\GameService;

class GameController extends Controller
{
    protected $gameService;
    public function __construct(GameService $gameService){
        $this->gameService = $gameService;
    }

    public function store(Request $request){
        $game = $this->gameService->create($request->all());
    }
}
