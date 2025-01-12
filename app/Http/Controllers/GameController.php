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
        $game = $this->gameService->createGameWithRelations($request->all());
        return response()->json($game, 201);
    }

    public function destroy($id){
        $this->gameService->deleteGameAttachment($id);
        return response()->json($id, 200);
    }
}
