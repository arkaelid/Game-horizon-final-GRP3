<?php
namespace Controller;
use Controller\admin\MainAdmin;

class Auth extends MainAdmin
{
    
    public function login()
    {
        error_log("Méthode login appelée");
        
        if ($this->isUserLoggedIn()) {
            error_log("Redirection vers /index (utilisateur déjà connecté)");
            header('Location: /index');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $login = $_POST['login'] ?? '';
            $password = $_POST['password'] ?? '';

            $userModel = new \Model\Auth();
            $user = $userModel->getAdmin($login);

            if ($user && $userModel->verifyMySQLPassword($password, $user['password'])) {
                $_SESSION['login'] = $user['login'];
                $_SESSION['user_id'] = $user['login'];
                header('Location: /index');
                exit;
            } else {
                $this->view->error = "Nom d'utilisateur ou mot de passe incorrect.";
            }
        }

        error_log("Affichage du formulaire de connexion");
        $this->view->title = 'Connexion';
        $this->view->Display('admin/loginAdmin');
    }

    private function verifyMySQLPassword($password, $hashedPassword)
    {
        // Vérification spécifique pour les mots de passe hachés avec MySQL PASSWORD()
        $userModel = new \Model\Auth();
        return $userModel->verifyMySQLPassword($password, $hashedPassword);
    }

    


    public function logout()
    {
        session_destroy();
        header('Location: /logchoice');
        exit;
    }
    public function logChoice()
{
    if ($this->isUserLoggedIn()) {
        header('Location: /index');
        exit;
    }
    
    $this->view->title = 'Choix de connexion';
    $this->view->Display('logChoice');
}
}
