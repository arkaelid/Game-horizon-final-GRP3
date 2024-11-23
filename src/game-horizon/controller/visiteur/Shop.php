<?php
namespace Controller\visiteur;
use Controller\visiteur\MainVisiteur;

class Shop extends MainVisiteur
{
    public function getGames($vars=[])
    {
        $gameModel = new \Model\visiteur\Shop();
        
        $categoryId = $_GET['category'] ?? null;
        $genreId = $_GET['genre'] ?? null;
        
        $games = $gameModel->getGamesByID($categoryId);
        $categories = $gameModel->getCategories();
        $genres = $gameModel->getGenres();
        
        $NEWgames = $gameModel->getNewGames($categoryId);
        $UCgames = $gameModel->getUpComingGames($categoryId);

        self::$View->title = 'Liste des jeux';
        self::$View->games = $games;
        self::$View->categories = $categories;
        self::$View->genres = $genres;
        self::$View->selectedCategory = $categoryId;
        self::$View->selectedGenre = $genreId;
        self::$View->NEWgames = $NEWgames;
        self::$View->UCgames = $UCgames;

        return self::$View->Display('visiteur/shop');
    }


    public function search()
    {
        $query = $_GET['q'] ?? '';
        $gameModel = new \Model\visiteur\Shop();
        $games = $gameModel->searchGames($query);

        self::$View->games = $games;
        self::$View->query = $query;
        return self::$View->Display('visiteur/shop');
    }

    public function searchSuggestions()
    {
        $query = $_GET['q'] ?? '';
        $gameModel = new \Model\visiteur\Shop();
        $suggestions = $gameModel->getSearchSuggestions($query);
        header('Content-Type: application/json');
        echo json_encode($suggestions);
        exit;
    }
}
