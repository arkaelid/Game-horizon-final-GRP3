<?php 
namespace Controller\editeur;
use Controller\editeur\MainEditeur;

class sessionEditeur Extends MainEditeur {

    static function checkConnected()
    {
        if(!isset($_SESSION['id_editeur']))
        {
            header('location: /loginediteur');
            exit();
        }
        MainEditeur::$view->session= $_SESSION;
        MainEditeur::$view->post= $_POST;
    }

    public function verifieEditeur(int $IdEditeurPosseseur) {
        self::checkConnected();
        $IdEditeurActuel = $_SESSION['id_editeur'];
        if ($IdEditeurPosseseur !== $IdEditeurActuel) {
            $this->view->error = "accès interdit !.";
      
        }
      }
    
}



?>