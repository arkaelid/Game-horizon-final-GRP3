<?php
namespace Model\admin;
use Model\Db;

class proposition extends Db {
    public function getPendingGames()
    {
        $sql = "SELECT j.*, e.nom_societe, c.libelle_categorie, g.libelle_genre,
                GROUP_CONCAT(DISTINCT t.libelle_type ORDER BY t.libelle_type SEPARATOR ' | ') AS types
                FROM jeu j
                LEFT JOIN editeur e ON j.id_editeur = e.id_editeur
                LEFT JOIN categorie c ON j.id_categorie = c.id_categorie
                LEFT JOIN genre g ON j.id_genre = g.id_genre
                LEFT JOIN categoriser_type ct ON j.id_jeu = ct.id_jeu
                LEFT JOIN type t ON ct.id_type = t.id_type
                WHERE j.validation = 0
                GROUP BY j.id_jeu";
        
        return $this->query($sql)->fetchAll();
    }

    public function getPendingGamesCount()
    {
        $sql = "SELECT COUNT(*) as count FROM jeu WHERE validation = 0";
        $result = $this->query($sql)->fetch();
        return $result['count'];
    }

    public function validateGame($gameId)
    {
        $sql = "UPDATE jeu 
                SET validation = 1, 
                    mise_en_ligne = 1,
                    date_miseEnLigne = NOW() 
                WHERE id_jeu = :gameId";
                
        return $this->query($sql, [':gameId' => $gameId]);
    }

    public function rejectGame($gameId)
    {
        // Supprimer d'abord les relations
        $this->query("DELETE FROM categoriser_type WHERE id_jeu = :id", [':id' => $gameId]);
        $this->query("DELETE FROM media WHERE id_jeu = :id", [':id' => $gameId]);
        
        // Puis supprimer le jeu
        $sql = "DELETE FROM jeu WHERE id_jeu = :id";
        return $this->query($sql, [':id' => $gameId]);
    }

    public function getGameById($gameId)
    {
        $sql = "SELECT j.*, e.nom_societe, c.libelle_categorie, g.libelle_genre,
                GROUP_CONCAT(DISTINCT t.libelle_type ORDER BY t.libelle_type SEPARATOR ' | ') AS types
                FROM jeu j
                LEFT JOIN editeur e ON j.id_editeur = e.id_editeur
                LEFT JOIN categorie c ON j.id_categorie = c.id_categorie
                LEFT JOIN genre g ON j.id_genre = g.id_genre
                LEFT JOIN categoriser_type ct ON j.id_jeu = ct.id_jeu
                LEFT JOIN type t ON ct.id_type = t.id_type
                WHERE j.id_jeu = :gameId
                GROUP BY j.id_jeu";
        
        return $this->query($sql, [':gameId' => $gameId])->fetch();
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
