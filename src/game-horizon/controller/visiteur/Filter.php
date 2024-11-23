<?php
namespace Controller\visiteur;

class Filter extends MainVisiteur
{
    public function getFilteredGames($vars=[])
    {
        $gameModel = new \Model\visiteur\filter();
        
        $categoryId = $_GET['category'] ?? null;
        $genreId = $_GET['genre'] ?? null;
        
        $games = $gameModel->getFilteredGames($categoryId, $genreId);
        $categories = $gameModel->getCategories();
        $genres = $gameModel->getGenres();

        self::$View->title = 'Liste des jeux';
        self::$View->games = $games;
        self::$View->categories = $categories;
        self::$View->genres = $genres;
        self::$View->selectedCategory = $categoryId;
        self::$View->selectedGenre = $genreId;

        return self::$View->Display('visiteur/filter_shop');
    }

    public function search()
    {
        $query = $_GET['q'] ?? '';
        $gameModel = new \Model\visiteur\Filter();
        $games = $gameModel->searchGames($query);

        self::$View->games = $games;
        self::$View->query = $query;
        return self::$View->Display('visiteur/filter_shop');
    }

    public function searchSuggestions()
    {
        $query = $_GET['q'] ?? '';
        $gameModel = new \Model\visiteur\Filter();
        $suggestions = $gameModel->getSearchSuggestions($query);
        header('Content-Type: application/json');
        echo json_encode($suggestions);
        exit;
    }
}
