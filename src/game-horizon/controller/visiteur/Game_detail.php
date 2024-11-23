<?php
namespace Controller\visiteur;

class Game_detail extends MainVisiteur
{
    public function getGame($vars=[])
    {
        if (!isset($vars['id'])) {
            \Controller\Error::HttpError(404);
            return;
        }

        $id_jeu = $vars['id'];
        $gameModel = new \Model\visiteur\Game_detail();
        $game = $gameModel->getGame($id_jeu);
        $medias = $gameModel->getMedia($id_jeu);

        if (!$game) {
            \Controller\Error::HttpError(404);
            return;
        }

        self::$View->title = 'Détail du jeu';
        self::$View->h1_title = 'Catalogue de jeux';
        self::$View->game = $game;
        self::$View->medias = $medias;
        return self::$View->Display('visiteur/game_detail');
    }

    public function getMedia($vars=[])
    {
        if (!isset($vars['id'])) {
            \Controller\Error::HttpError(404);
            return;
        }

        $id_jeu = $vars['id'];
        $mediaModel = new \Model\visiteur\Game_detail();
        $medias = $mediaModel->getMedia($id_jeu);

        if (!$medias) {
            \Controller\Error::HttpError(404);
            return;
        }

        self::$View->title = 'Détail du jeu';
        self::$View->h1_title = 'Catalogue de jeux';
        self::$View->media = $medias;
        return self::$View->Display('visiteur/game_detail');
    }
}