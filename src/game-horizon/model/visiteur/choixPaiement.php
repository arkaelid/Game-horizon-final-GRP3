<?php
namespace Model\visiteur;
use Model\Db;
class Game_detail extends Db
{
    function getGame($id_jeu)
    {
        try {
            $stmt = $this->query(
                "SELECT jeu.id_jeu, jeu.nom_jeu, jeu.prix, jeu.resume, jeu.date_sortie, jeu.gif, jeu.image_card, jeu.image_banniere, 
                genre.libelle_genre, editeur.nom_societe,
                GROUP_CONCAT(DISTINCT categorie.libelle_categorie ORDER BY categorie.libelle_categorie SEPARATOR ' | ') AS categories,
                FROM jeu
                LEFT JOIN categorie ON jeu.id_categorie = categorie.id_categorie
                LEFT JOIN genre ON jeu.id_genre = genre.id_genre
                LEFT JOIN categoriser_type ON jeu.id_jeu = categoriser_type.id_jeu
                LEFT JOIN type ON categoriser_type.id_type = type.id_type
                LEFT JOIN editeur ON jeu.id_editeur = editeur.id_editeur
                WHERE jeu.id_jeu = :id
                GROUP BY jeu.id_jeu, jeu.nom_jeu, jeu.prix, jeu.resume, jeu.date_sortie, jeu.gif, jeu.image_banniere, genre.libelle_genre",
                [':id' => $id_jeu]
            );
            
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("SQL Error: " . $e->getMessage());
            return null;
        }
    }
}