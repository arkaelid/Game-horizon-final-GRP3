<?php
namespace Model\visiteur;
use Model\Db;
class Game_detail extends Db
{
    function getGame($id_jeu)
    {
        try {
            $shopModel = new Shop();
            return $shopModel->getGamesByID(null, null, $id_jeu);
        } catch (\PDOException $e) {
            error_log("SQL Error: " . $e->getMessage());
            return null;
        }
    }

    function getMedia($id_jeu)
    {
        try {
            $stmt = $this->query(
                "SELECT media.chemin_media, jeu.id_jeu
                FROM media
                LEFT JOIN jeu ON media.id_jeu = jeu.id_jeu 
                WHERE jeu.id_jeu = :id
                GROUP BY media.chemin_media",
                [':id' => $id_jeu]
            );
            
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("SQL Error: " . $e->getMessage());
            return null;
        }
    }
}