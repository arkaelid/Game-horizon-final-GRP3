<?php
namespace Model\visiteur;
use Model\Db;

class Register extends Db
{
    public function userExists($login, $email)
    {
        $sql = "SELECT COUNT(*) FROM utilisateur WHERE pseudo_utilisateur = :pseudo_utilisateur OR mail = :email";
        $count = $this->query($sql, [':pseudo_utilisateur' => $login, ':email' => $email])->fetchColumn();
        return $count > 0;
    }

    public function createUser($login, $password, $email)
    {
        try {
            $sql = "INSERT INTO utilisateur (pseudo_utilisateur, password, mail, chemin_img_user) 
                    VALUES (:pseudo_utilisateur, :password, :email, '/img/utilisateurs/user.png')";
            
            $this->query($sql, [
                ':pseudo_utilisateur' => $login,
                ':password' => $password,
                ':email' => $email,
            ]);
            
            return true;
        } catch (\PDOException $e) {
            error_log("Erreur lors de la création de l'utilisateur : " . $e->getMessage());
            return false;
        }
    }
}
