<?php
namespace Controller\visiteur;
use \Model\visiteur\Shop;

class Basket extends MainVisiteur
{
    public function index()
    {
        $panier = isset($_SESSION['panier']) && is_array($_SESSION['panier']) ? $_SESSION['panier'] : [];

        if(isset($_POST['id_jeu']))
        {
            $panier[$_POST['id_jeu']] = $_POST['id_jeu'];
        }
        else if(isset($_POST['del_jeu']) && isset($panier[$_POST['del_jeu']]))
        {
            unset($panier[$_POST['del_jeu']]);
        }

        $shopModel = new Shop();
        $games = $shopModel->getGamesByIds($panier);

        $_SESSION['panier'] = $panier;

        self::$View->title = 'Panier';
        self::$View->games = $games;
        return self::$View->Display('visiteur/basket');
    }
}
