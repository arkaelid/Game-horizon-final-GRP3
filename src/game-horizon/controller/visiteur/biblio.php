<?php

namespace Controller\visiteur;
use \Model\visiteur\Biblio as BiblioModel;

class biblio extends MainVisiteur
{
    public function index()
    {
        if (!isset($_SESSION['pseudo_utilisateur'])) {
            header('Location: /loginvisiteur');
            exit;
        }

        $biblioModel = new \Model\visiteur\Biblio();
        self::$View->games = $biblioModel->getGamesWithRefundStatus($_SESSION['id_utilisateur']);
        self::$View->Display('visiteur/biblio');
    }

    public function downloadGame($params)
    {
        if(!$this->isUserLoggedIn()) {
            header("Location:/loginvisiteur");
            exit();
        }

        $gameId = $params['id'];
        $user = $this->getUserSession();
        
        $biblioModel = new BiblioModel();
        $game = $biblioModel->getGameInfo($gameId, $user['id_utilisateur']);

        if(!$game) {
            $_SESSION['error'] = "Vous n'avez pas accès à ce jeu.";
            header("Location:/bibliotheque");
            exit();
        }

        $file = $_SERVER['DOCUMENT_ROOT'] . '/img/' . $game['image_card'];
        
        if(file_exists($file)) {
            $allowedTypes = ['jpg', 'jpeg', 'png'];
            $fileExtension = strtolower(pathinfo($game['image_card'], PATHINFO_EXTENSION));
            
            if(!in_array($fileExtension, $allowedTypes)) {
                $_SESSION['error'] = "Type de fichier non autorisé.";
                header("Location:/bibliotheque");
                exit();
            }

            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $game['nom_jeu'] . '.' . $fileExtension . '"');
            header('Content-Length: ' . filesize($file));
            readfile($file);
            exit();
        }
        
        $_SESSION['error'] = "Le fichier n'existe pas.";
        header("Location:/bibliotheque");
        exit();
    }

    public function remboursement()
    {
        if (!isset($_SESSION['pseudo_utilisateur'])) {
            header('Location: /loginvisiteur');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $gameId = $_POST['id_jeu'] ?? null;
            $reason = $_POST['raison'] ?? null;
            
            if ($gameId && $reason) {
                $biblioModel = new \Model\visiteur\Biblio();
                $result = $biblioModel->createRefundRequest(
                    $_SESSION['id_utilisateur'],
                    $gameId,
                    $reason
                );
                
                if ($result) {
                    $_SESSION['success'] = "Votre demande de remboursement a été enregistrée.";
                } else {
                    $_SESSION['error'] = "Une demande de remboursement existe déjà pour ce jeu.";
                }
            }
        }
        
        header('Location: /bibliotheque');
        exit();
    }
}