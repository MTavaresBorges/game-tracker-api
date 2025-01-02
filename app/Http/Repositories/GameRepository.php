<?php

namespace App\Http\Repositories;

use App\Models\Game;
use App\Models\Genre;
use App\Models\Company;
use App\Models\Library;
use App\Models\Platform;
use App\Models\GameImage;
use Illuminate\Support\Facades\DB;

class GameRepository
{
    public function create(array $data, Library $library) {
        return DB::transaction(function () use ($data, $library) {
            $game = Game::updateOrCreate($data['game']);
            $game->libraries()->sync([
                $library->id => [
                    'status' => $data['pivot']['status'],
                    'beaten_at' => $data['pivot']['beaten_at']
                ]
            ]);

            foreach($data['images'] as $image){
                $image = GameImage::updateOrCreate([
                    'game_id' => $game->id,
                    'url' => $image['url'],
                    'order' => $image['order'],
                ]);
            }

            foreach($data['genres'] as $genre){
                $genre = Genre::updateOrCreate(['name' => $genre['name']]);
                $game->genres()->sync([$genre->id]);
            }

            foreach($data['companies'] as $company){
                $company = Company::updateOrCreate([
                    'name' => $company['name'],
                    'type' => $company['type'],
                ]);
                $game->companies()->sync([$company->id]);
            }

            foreach($data['platforms'] as $platform){
                $platform = Platform::updateOrCreate([
                    'name' => $platform['name'],
                ]);
                $game->platforms()->sync([$platform->id]);
            }

            return response()->json($game, 201);
        });
    }
}