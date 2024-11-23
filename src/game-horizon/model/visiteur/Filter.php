<?php
namespace Model\visiteur;
use Model\Db;
class Filter extends Db
{
    function getFilteredGames($categoryId = null, $genreId = null)
    {
        try {
            $params = [];
            $sql = "SELECT jeu.id_jeu, jeu.nom_jeu, jeu.prix, jeu.resume, jeu.date_sortie, jeu.gif, jeu.image_card, 
                    genre.libelle_genre,
                    GROUP_CONCAT(DISTINCT categorie.libelle_categorie ORDER BY categorie.libelle_categorie SEPARATOR ' | ') AS categories,
                    GROUP_CONCAT(DISTINCT type.libelle_type ORDER BY type.libelle_type SEPARATOR ' | ') AS types
                    FROM jeu
                    LEFT JOIN posseder_2 ON jeu.id_jeu = posseder_2.id_jeu
                    LEFT JOIN categorie ON posseder_2.id_categorie = categorie.id_categorie
                    LEFT JOIN genre ON jeu.id_genre = genre.id_genre
                    LEFT JOIN categoriser_4 ON jeu.id_jeu = categoriser_4.id_jeu
                    LEFT JOIN type ON categoriser_4.id_type = type.id_type";

            if ($categoryId || $genreId) {
                $conditions = [];
                if ($categoryId) {
                    $conditions[] = "posseder_2.id_categorie = :categoryId";
                    $params[':categoryId'] = $categoryId;
                }
                if ($genreId) {
                    $conditions[] = "jeu.id_genre = :genreId";
                    $params[':genreId'] = $genreId;
                }
                $sql .= " WHERE " . implode(" AND ", $conditions);
            }

            $sql .= " GROUP BY jeu.id_jeu, jeu.nom_jeu, jeu.prix, jeu.resume, jeu.date_sortie, jeu.gif, jeu.image_banniere, genre.libelle_genre";
            
            return $this->query($sql, $params)->fetchAll();
        } catch (\PDOException $e) {
            error_log("SQL Error: " . $e->getMessage());
            return null;
        }
    }

    public function searchGames($query)
    {
        $query = '%' . strtolower($query) . '%';
        return $this->query(
            "SELECT * FROM jeux WHERE LOWER(nom_jeu) LIKE :query OR LOWER(resume) LIKE :query",
            [':query' => $query]
        )->fetchAll();
    }

    public function getSearchSuggestions($query)
    {
        $query = '%' . strtolower($query) . '%';
        try {
            return $this->query(
                "SELECT jeu.id_jeu, jeu.nom_jeu, jeu.image_card 
                 FROM jeu 
                 WHERE LOWER(nom_jeu) LIKE :query 
                 LIMIT 5",
                [':query' => $query]
            )->fetchAll();
        } catch (\PDOException $e) {
            error_log("SQL Error: " . $e->getMessage());
            return [];
        }
    }

    public function getCategories()
    {
        try {
            return $this->query(
                "SELECT DISTINCT id_categorie, libelle_categorie 
                 FROM categorie 
                 ORDER BY libelle_categorie"
            )->fetchAll();
        } catch (\PDOException $e) {
            error_log("SQL Error: " . $e->getMessage());
            return [];
        }
    }

    public function getGenres()
    {
        try {
            return $this->query(
                "SELECT DISTINCT id_genre, libelle_genre 
                 FROM genre 
                 ORDER BY libelle_genre"
            )->fetchAll();
        } catch (\PDOException $e) {
            error_log("SQL Error: " . $e->getMessage());
            return [];
        }
    }
}