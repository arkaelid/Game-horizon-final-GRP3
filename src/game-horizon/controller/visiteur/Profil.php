<?php
namespace Controller\visiteur;

class Profil extends MainVisiteur
{
    public function index()
    {

        if (!$this->isUserLoggedIn()) {
            header('Location: /loginvisiteur');
            exit;
        }
        $session = $this->getUserSession();
        $profilModel = new \Model\visiteur\Profil();
        $userProfile = $profilModel->getUserProfile($session['id_utilisateur']);

        self::$View->userProfile = $userProfile;
        self::$View->title = 'Profil Utilisateur';
        self::$View->Display('visiteur/profilUser');
    }
}
