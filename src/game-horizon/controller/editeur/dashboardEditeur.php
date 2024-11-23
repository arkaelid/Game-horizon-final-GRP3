<?php 
namespace Controller\editeur;

use Controller\editeur\sessionEditeur;
use Model\editeur\Editeur;

class dashboardEditeur extends sessionEditeur
{
    function getLogin()
    {
        if(isset($_POST['login-editeur']))
        {
            $this->postLogin();
        }
        
        /*MainEditeurEditeur::$view->title = 'Dashboard Editeur Beta de la Beta';
        MainEditeur::$view->h1_title = 'Editeur';*/

        MainEditeur::$view->Display('editeur/connexionEditeur');

        MainEditeur::$logger->warning(message: 'ConnexionEditeur Visualisée');

    }

    function dashboardEditeurIndex() {
        parent::checkConnected();
        
        MainEditeur::$view->Display("/editeur/dashboardIndex");

    }





    function postLogin() {
        $login = htmlspecialchars($_POST['login-editeur'], ENT_QUOTES, 'UTF-8');
        $password = htmlspecialchars($_POST['password-editeur'], ENT_QUOTES, 'UTF-8');
        $bisPassword = htmlspecialchars($_POST['bis-password-editeur'], ENT_QUOTES, 'UTF-8');
    
        // Check if passwords match
        if ($password !== $bisPassword) {
            echo "<p class='logError'>Tapez le même mot de passe dans les 2 champs prévus à cet effet </p>";
            return;
        }
    
        $editeurObject = new Editeur();
        $editeur = $editeurObject->getEditeurByUsername($login);
    
        // Check if the editor with the given login exists
        if (!$editeur || $login !== $editeur["login_editeur"]) {
            echo "<p class='logError'> Login incorrect </p>" ;
            return;
        }
    
        if (password_verify($password, $editeur['password_editeur'])) {
            $_SESSION["id_editeur"] = htmlspecialchars($editeur["id_editeur"], ENT_QUOTES, 'UTF-8');
            $_SESSION["nom_societe"] = htmlspecialchars($editeur["nom_societe"], ENT_QUOTES, 'UTF-8');
            $_SESSION["login_editeur"] = htmlspecialchars($editeur["login_editeur"], ENT_QUOTES, 'UTF-8');
            $_SESSION["siret"] = htmlspecialchars($editeur["siret"], ENT_QUOTES, 'UTF-8');
            $_SESSION["mail_editeur"] = htmlspecialchars($editeur["mail_editeur"], ENT_QUOTES, 'UTF-8');
            $_SESSION["adresse_editeur"] = htmlspecialchars($editeur["adresse_editeur"], ENT_QUOTES, 'UTF-8');
            $_SESSION["chemin_img_editeur"] = htmlspecialchars($editeur["chemin_img_editeur"], ENT_QUOTES, 'UTF-8');

            header(header: 'Location: /dashboardediteur');
            exit();
        } else {
            echo "<p class='logError'> Mot de passe incorrect </p>";
        }
    }

    function logoutEditeur() {
        session_unset();
        session_destroy();
        header('Location: /logchoice');
        exit();
    }

    function profilEditeur() {
        parent::checkConnected();
        MainEditeur::$view->Display("/editeur/profilEditeur");

    }

    function updateProfilEditeur() {
        parent::checkConnected();
    
        $mail = htmlspecialchars($_POST['mail-editeur'], ENT_QUOTES, 'UTF-8');
        $login = htmlspecialchars($_POST['login-editeur'], ENT_QUOTES, 'UTF-8');
        $password = htmlspecialchars($_POST['password-editeur'], ENT_QUOTES, 'UTF-8');
        $bisPassword = htmlspecialchars($_POST['bis-password-editeur'], ENT_QUOTES, 'UTF-8');


        if ($password !== $bisPassword) {
            echo "Tapez le même mot de passe dans les 2 champs prévus à cet effet";
            return;
        }

        $id = $_SESSION['id_editeur'];
        $editeurObject = new Editeur();
    
        if (empty($mail) || empty($login)) {
            die("Ne laissez pas de champs vide !");
        }
    
        $password_hashed = !empty($password) ? password_hash($password, PASSWORD_ARGON2ID) : null;
    
        if ($password_hashed) {
            $editeurObject->updateEditeurPassword( $login, $password_hashed, $mail, $id);
        } else {
            $editeurObject->updateEditeur( $login, $mail,$id);
        }
    
       
        $_SESSION["login_editeur"] = $login;
        $_SESSION["mail_editeur"] = $mail;
    
        header('Location: /votreprofilediteur?update=success');
        exit();
    }




    }
















?>