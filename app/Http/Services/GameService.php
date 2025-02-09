<?php

namespace App\Http\Services;

use App\Models\Game;
use App\Models\Genre;
use App\Models\Company;
use App\Models\Library;
use App\Models\Platform;
use App\Models\GameImage;
use Illuminate\Support\Facades\DB;
use App\Http\Repositories\GameRepository;
use App\Http\Repositories\LibraryRepository;
use App\Http\Services\LibraryService;

class GameService
{
    protected $gameRepository;
    protected $libraryRepository;
    protected $libraryService;
    public function __construct(GameRepository $gameRepository, LibraryRepository $libraryRepository, LibraryService $libraryService)
    {
        $this->gameRepository = $gameRepository;
        $this->libraryRepository = $libraryRepository;
        $this->libraryService = $libraryService;
    }
    
    public function createGameWithRelations(array $data) {
        if($data['pivot']['isMain'] === 1){
            $library = $this->libraryRepository->findMain();
        }else{
            $library = $this->libraryService->getById($data['pivot']['library_id']);
        }
        return DB::transaction(function () use ($data, $library) {
            $game = $this->gameRepository->updateOrCreate($data['game']);
            $this->syncRelations($game, $data, $library);
            return $game;
        });
    }

    protected function syncRelations(Game $game, array $data, Library $library) {
        $game->libraries()->attach([
            $library->id => [
                'status' => $data['pivot']['status'],
                'beaten_at' => $data['pivot']['beaten_at'],
            ],
        ]);

        foreach ($data['images'] as $image) {
            GameImage::updateOrCreate([
                'game_id' => $game->id,
                'url' => $image['url'],
                'order' => $image['order'],
            ]);
        }

        $this->syncGenres($game, $data['genres']);
        $this->syncCompanies($game, $data['companies']);
        $this->syncPlatforms($game, $data['platforms']);
    }

    protected function syncGenres(Game $game, array $genres) {
        $genreIds = [];
        foreach ($genres as $genreData) {
            $genre = Genre::updateOrCreate(['name' => $genreData['name']]);
            $genreIds[] = $genre->id;
        }
        $game->genres()->sync($genreIds);
    }

    protected function syncCompanies(Game $game, array $companies) {
        $companyIds = [];
        foreach ($companies as $companyData) {
            $company = Company::updateOrCreate([
                'name' => $companyData['name'],
                'type' => $companyData['type'],
            ]);
            $companyIds[] = $company->id;
        }
        $game->companies()->sync($companyIds);
    }

    protected function syncPlatforms(Game $game, array $platforms) {
        $platformIds = [];
        foreach ($platforms as $platformData) {
            $platform = Platform::updateOrCreate(['name' => $platformData['name']]);
            $platformIds[] = $platform->id;
        }
        $game->platforms()->sync($platformIds);
    }

    public function deleteGameAttachment($gameId, $libraryId) {
        $library = Library::find($libraryId);
        $game = Game::find($gameId);
        
        $library->games()->detach($game);

        return response()->json($game, 200);
    }
}