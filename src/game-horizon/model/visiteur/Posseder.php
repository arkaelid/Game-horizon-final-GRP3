<?php
namespace Model\visiteur;
use Model\Db;

class Posseder extends Db
{
    public function addGameToLibrary($data)
    {
        $sql = "INSERT INTO posseder (id_utilisateur, id_jeu, date_achat) 
                VALUES (:id_utilisateur, :id_jeu, :date_achat)";
        
        $params = [
            ':id_utilisateur' => $data['id_utilisateur'],
            ':id_jeu' => $data['id_jeu'],
            ':date_achat' => $data['date_achat']
        ];
        
        return $this->query($sql, $params);
    }
}