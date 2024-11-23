<?php
namespace Model\visiteur;
use Model\Db;

class Profil extends Db
{
    public function getUserProfile($userId)
    {
        $sql = "SELECT * FROM utilisateur WHERE id_utilisateur = :userId";
        return $this->query($sql, [':userId' => $userId])->fetch();
    }
}
