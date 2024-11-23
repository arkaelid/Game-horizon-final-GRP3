<?php
namespace Controller\visiteur;

class Register extends MainVisiteur
{
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $login = $_POST['pseudo_utilisateur'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';
            $email = $_POST['email'] ?? '';

            if ($password !== $confirmPassword) {
                self::$View->error = "Les mots de passe ne correspondent pas.";
            } else {
                $registerModel = new \Model\visiteur\Register();
                
                if ($registerModel->userExists($login, $email)) {
                    self::$View->error = "Ce nom d'utilisateur ou cette adresse email existe déjà.";
                } else {
                    $hashedPassword = password_hash($password, PASSWORD_ARGON2ID);
                    if ($registerModel->createUser($login, $hashedPassword, $email)) {
                        header('Location: /loginvisiteur?registered=1');
                        exit;
                    } else {
                        self::$View->error = "Une erreur est survenue lors de l'inscription.";
                    }
                }
            }
        }

        self::$View->title = 'Inscription';
        self::$View->Display('visiteur/register');
    }
}
