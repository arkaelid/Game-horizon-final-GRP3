<?php 

namespace Model\editeur;
use Model\Db;

class Editeur extends DB {

    public function getEditeurByUsername($login) 
    {

       return $this->query("SELECT * FROM editeur WHERE login_editeur = :login", [':login' => $login])->fetch();
    }

    public function updateEditeur($login,$mail,$id){
        return $this->query("UPDATE editeur SET login_editeur=:login, mail_editeur=:mail WHERE id_editeur=:id",
        [
            ':login' => $login,
            ':mail' => $mail,
            ':id' => $id
    ]);
}
    public function updateEditeurPassword($login,$password,$mail,$id){
        return $this->query("UPDATE editeur SET login_editeur=:login,password_editeur =:password, mail_editeur=:mail WHERE id_editeur=:id",
        [
            ':login' => $login,
            ':password' => $password,  
            ':mail' => $mail,
            ':id' => $id
    ]);
    }
}