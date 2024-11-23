<?php
namespace Model;

class Contenir extends Db
{
    public function addJeuCommande($data)
    {
        $sql = "INSERT INTO contenir (id_jeu, id_transaction, prix) 
                VALUES (:id_jeu, :id_transaction, :prix)";
        
        $params = [
            ':id_jeu' => $data['id_jeu'],
            ':id_transaction' => $data['id_transaction'],
            ':prix' => $data['prix'],
        ];
        $this->query($sql, $params);
        return $this->lastInsertId();
    }
}