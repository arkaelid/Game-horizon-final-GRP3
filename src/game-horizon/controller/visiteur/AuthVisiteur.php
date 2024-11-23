<?php
namespace Controller\visiteur;
use Controller\visiteur\MainVisiteur;

class AuthVisiteur extends MainVisiteur
{
    public function loginVisiteur() 
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        error_log("Début loginVisiteur - Method: " . $_SERVER['REQUEST_METHOD']);
        error_log("Session actuelle : " . print_r($_SESSION, true));
        
        if ($this->isUserLoggedIn()) {
            error_log("Utilisateur connecté, redirection vers profilUser");
            header('Location: /profilUser');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $login = $_POST['login'] ?? '';
            $password = $_POST['password'] ?? '';

            error_log("Tentative de connexion pour l'utilisateur: " . $login);

            $userModel = new \Model\visiteur\AuthVisiteur();
            $user = $userModel->getVisiteurByUsername($login);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['pseudo_utilisateur'] = $user['pseudo_utilisateur'];
                $_SESSION['id_utilisateur'] = $user['id_utilisateur'];
                
                error_log("Connexion réussie - Session définie : " . print_r($_SESSION, true));
                if(isset($_SESSION['from']) && $_SESSION['from'] =='commande')
                {
                    $_SESSION['from'] = '';
                    header('Location: /commande');
                    exit();
                }
                header('Location: /profilUser');
                exit();
            } else {
                self::$View->error = "Nom d'utilisateur et / ou mot de passe incorrect.";
            }
        }
        
        self::$View->title = 'Connexion';
        self::$View->Display('visiteur/loginVisiteur');
    }
    
    public function logoutUser()
    {
        session_destroy();
        header('Location: /');
        exit;
    }

    
}

