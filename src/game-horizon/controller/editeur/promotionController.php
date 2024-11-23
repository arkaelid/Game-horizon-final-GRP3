<?php

namespace Controller\editeur;
use Model\editeur\Promotion;
use Model\Jeu;

class promotionController extends sessionEditeur {
function afficherFormPromotion() {
        parent::checkConnected();
        
        $jeuModel = new Jeu();
        MainEditeur::$view->jeux = $jeuModel->getjeuxEditeurEnLigne($_SESSION['nom_societe']);
        
        MainEditeur::$view->Display("/editeur/addPromotion");
    }
    
    function ajouterPromotion() {
        parent::checkConnected();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $promotionModel = new Promotion();
            
            // Pour une promotion unique
            if (isset($_POST['jeu_id'])) {
                $result = $promotionModel->ajouterPromotion(
                    htmlspecialchars($_POST['jeu_id']),
                    htmlspecialchars($_POST['reduction']),
                    htmlspecialchars($_POST['date_debut']),
                    htmlspecialchars($_POST['date_fin'])
                );
            }
            // Pour des promotions multiples
            else if (isset($_POST['jeux_ids'])) {
                $result = $promotionModel->ajouterPromotionsMultiples(
                    array_map('htmlspecialchars', $_POST['jeux_ids']),
                    htmlspecialchars($_POST['reduction']),
                    htmlspecialchars($_POST['date_debut']),
                    htmlspecialchars($_POST['date_fin'])
                );
            }
            
            if ($result) {
                header('Location: /jeuxenligne?success=1');
            } else {
                header('Location: /jeuxenlignes?error=1');
            }
            exit();
        }
    }
}