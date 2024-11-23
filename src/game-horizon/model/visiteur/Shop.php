<?php
namespace Model\visiteur;
use Model\Db;
class Shop extends Db
{
    function getGames($categoryId = null, $genreId = null)
    {
        try {
            $params = [];
            $sql = "SELECT jeu.id_jeu, jeu.nom_jeu, jeu.prix, jeu.resume, jeu.date_sortie, jeu.gif, jeu.image_card,
                    genre.libelle_genre,
                    GROUP_CONCAT(DISTINCT categorie.libelle_categorie ORDER BY categorie.libelle_categorie SEPARATOR ' | ') AS categories,
                    GROUP_CONCAT(DISTINCT type.libelle_type ORDER BY type.libelle_type SEPARATOR ' | ') AS types
                    FROM jeu
                    LEFT JOIN categorie ON jeu.id_categorie = categorie.id_categorie
                    LEFT JOIN genre ON jeu.id_genre = genre.id_genre
                    LEFT JOIN categoriser_type ON jeu.id_jeu = categoriser_type.id_jeu
                    LEFT JOIN type ON categoriser_type.id_type = type.id_type
                    WHERE mise_en_ligne = 1 AND validation = 1";
 
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
 
    function getNewGames($categoryId = null)
    {
        try {
            $params = [];
            $sql = "SELECT j.id_jeu, j.nom_jeu, j.prix, j.resume, j.date_sortie, j.gif, j.image_card,
                    g.libelle_genre,
                    GROUP_CONCAT(DISTINCT c.libelle_categorie ORDER BY c.libelle_categorie SEPARATOR ' | ') AS categories,
                    GROUP_CONCAT(DISTINCT t.libelle_type ORDER BY t.libelle_type SEPARATOR ' | ') AS types,
                    p.reduction,
                    CASE
                        WHEN p.reduction IS NOT NULL
                        THEN ROUND(j.prix * (1 - p.reduction/100), 2)
                        ELSE j.prix
                    END as prix_final
                    FROM jeu j
                    LEFT JOIN categorie c ON j.id_categorie = c.id_categorie
                    LEFT JOIN genre g ON j.id_genre = g.id_genre
                    LEFT JOIN categoriser_type ct ON j.id_jeu = ct.id_jeu
                    LEFT JOIN type t ON ct.id_type = t.id_type
                    LEFT JOIN promotion p ON j.id_jeu = p.id_jeu
                        AND CURRENT_DATE BETWEEN p.date_debut AND p.date_fin
                    WHERE j.date_miseEnLigne >= DATE_SUB(CURRENT_DATE, INTERVAL 30 DAY)
                    AND j.date_sortie <= CURRENT_DATE
                    AND j.mise_en_ligne = 1 
                    AND j.validation = 1";

            if ($categoryId) {
                $sql .= " AND j.id_categorie = :categoryId";
                $params[':categoryId'] = $categoryId;
            }

            $sql .= " GROUP BY j.id_jeu
                    ORDER BY j.date_miseEnLigne DESC";

            return $this->query($sql, $params)->fetchAll();
        } catch (\PDOException $e) {
            error_log("SQL Error: " . $e->getMessage());
            return null;
        }
    }
 
    function getUpComingGames($categoryId = null)
    {
        try {
            $params = [];
            $sql = "SELECT j.id_jeu, j.nom_jeu, j.prix, j.resume, j.date_sortie, j.gif, j.image_card,
                    g.libelle_genre,
                    GROUP_CONCAT(DISTINCT c.libelle_categorie ORDER BY c.libelle_categorie SEPARATOR ' | ') AS categories,
                    GROUP_CONCAT(DISTINCT t.libelle_type ORDER BY t.libelle_type SEPARATOR ' | ') AS types,
                    p.reduction,
                    CASE
                        WHEN p.reduction IS NOT NULL
                        THEN ROUND(j.prix * (1 - p.reduction/100), 2)
                        ELSE j.prix
                    END as prix_final
                    FROM jeu j
                    LEFT JOIN categorie c ON j.id_categorie = c.id_categorie
                    LEFT JOIN genre g ON j.id_genre = g.id_genre
                    LEFT JOIN categoriser_type ct ON j.id_jeu = ct.id_jeu
                    LEFT JOIN type t ON ct.id_type = t.id_type
                    LEFT JOIN promotion p ON j.id_jeu = p.id_jeu
                        AND CURRENT_DATE BETWEEN p.date_debut AND p.date_fin
                    WHERE j.date_sortie > CURRENT_DATE
                    AND j.mise_en_ligne = 1 AND j.validation = 1";

            if ($categoryId) {
                $sql .= " AND j.id_categorie = :categoryId";
                $params[':categoryId'] = $categoryId;
            }

            $sql .= " GROUP BY j.id_jeu
                    ORDER BY j.date_sortie ASC";

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
 
 
    function getGamesByIds($ids)
    {
        if (empty($ids)) {
            return [];
        }

        try {
            $placeholders = str_repeat('?,', count($ids) - 1) . '?';
            $sql = "SELECT j.id_jeu, j.nom_jeu, j.prix, j.date_sortie, j.image_card,
                    g.libelle_genre,
                    GROUP_CONCAT(DISTINCT c.libelle_categorie ORDER BY c.libelle_categorie SEPARATOR ' | ') AS categories,
                    p.reduction,
                    CASE
                        WHEN p.reduction IS NOT NULL
                        THEN ROUND(j.prix * (1 - p.reduction/100), 2)
                        ELSE j.prix
                    END as prix_final
                    FROM jeu j
                    LEFT JOIN categorie c ON j.id_categorie = c.id_categorie
                    LEFT JOIN genre g ON j.id_genre = g.id_genre
                    LEFT JOIN promotion p ON j.id_jeu = p.id_jeu
                        AND CURRENT_DATE BETWEEN p.date_debut AND p.date_fin
                    WHERE j.id_jeu IN ($placeholders)
                    GROUP BY j.id_jeu";

            return $this->query($sql, array_values($ids))->fetchAll();
        } catch (\PDOException $e) {
            error_log("SQL Error: " . $e->getMessage());
            return [];
        }
    }
 
    public function getGameById($id)
    {
        try {
            $sql = "SELECT
                    j.*,
                    e.nom_societe as editeur,
                    c.libelle_categorie
                    FROM jeu j
                    LEFT JOIN editeur e ON j.id_editeur = e.id_editeur
                    LEFT JOIN categorie c ON j.id_categorie = c.id_categorie
                    WHERE j.id_jeu = :id";
           
            return $this->query($sql, [':id' => $id])->fetch();
        } catch (\PDOException $e) {
            error_log("SQL Error: " . $e->getMessage());
            return null;
        }
    }
 
    public function updateGame($id, $data)
    {
        try {
            $sql = "UPDATE jeu SET
                    nom_jeu = :nom_jeu,
                    prix = :prix,
                    date_sortie = :date_sortie,
                    id_editeur = :id_editeur,
                    id_categorie = :id_categorie,
                    resume = :resume
                    WHERE id_jeu = :id";
 
            return $this->query($sql, [
                ':id' => $id,
                ':nom_jeu' => $data['nom_jeu'],
                ':prix' => $data['prix'],
                ':date_sortie' => $data['date_sortie'],
                ':id_editeur' => $data['id_editeur'],
                ':id_categorie' => $data['id_categorie'],
                ':resume' => $data['resume']
            ]);
        } catch (\PDOException $e) {
            error_log("SQL Error: " . $e->getMessage());
            return false;
        }
    }
    public function getEditeurs()
{
    try {
        $sql = "SELECT id_editeur, nom_societe FROM editeur ORDER BY nom_societe";
        return $this->query($sql)->fetchAll();
    } catch (\PDOException $e) {
        error_log("SQL Error: " . $e->getMessage());
        return [];
    }
    }
 
    public function getGamesByIDByEditeur($editeurId)
{
    try {
        $sql = "SELECT
                j.id_jeu,
                j.nom_jeu,
                j.prix,
                j.date_sortie,
                j.image_card,
                CASE
                    WHEN p.reduction IS NOT NULL
                    THEN ROUND(j.prix * (1 - p.reduction/100), 2)
                    ELSE j.prix
                END as prix_final,
                p.reduction
                FROM jeu j
                LEFT JOIN promotion p ON j.id_jeu = p.id_jeu
                    AND CURRENT_DATE BETWEEN p.date_debut AND p.date_fin
                WHERE j.id_editeur = :editeurId
                ORDER BY j.date_sortie DESC";
       
        return $this->query($sql, [':editeurId' => $editeurId])->fetchAll();
    } catch (\PDOException $e) {
        error_log("SQL Error: " . $e->getMessage());
        return [];
    }
}
 
public function deleteGame($gameId) {
    try {
        $this->query("DELETE FROM promotion WHERE id_jeu = :id", [':id' => $gameId]);
        $this->query("DELETE FROM contenir WHERE id_jeu = :id", [':id' => $gameId]);
        $this->query("DELETE FROM categoriser_type WHERE id_jeu = :id", [':id' => $gameId]);
        $this->query("DELETE FROM media WHERE id_jeu = :id", [':id' => $gameId]);
        $sql = "DELETE FROM jeu WHERE id_jeu = :id";
        $params = [':id' => $gameId];
       
        return $this->query($sql, $params);
       
    } catch (\PDOException $e) {
        error_log("SQL Error dans deleteGame: " . $e->getMessage());
        return false;
    }
}
 
function getGamesByID($categoryId = null, $editeurId = null, $id_jeu = null)
{
    try {
        $params = [];
        $sql = "SELECT
                j.id_jeu,
                j.nom_jeu,
                j.prix,
                j.date_sortie,
                j.image_card,
                j.image_banniere,
                j.resume,
                j.gif,
                e.nom_societe as editeur,
                c.libelle_categorie,
                g.libelle_genre,
                GROUP_CONCAT(DISTINCT cat.libelle_categorie ORDER BY cat.libelle_categorie SEPARATOR ' | ') AS categories,
                GROUP_CONCAT(DISTINCT t.libelle_type ORDER BY t.libelle_type SEPARATOR ' | ') AS types,
                p.reduction,
                CASE
                    WHEN p.reduction IS NOT NULL
                    THEN ROUND(j.prix * (1 - p.reduction/100), 2)
                    ELSE j.prix
                END as prix_final
                FROM jeu j
                LEFT JOIN editeur e ON j.id_editeur = e.id_editeur
                LEFT JOIN categorie c ON j.id_categorie = c.id_categorie
                LEFT JOIN genre g ON j.id_genre = g.id_genre
                LEFT JOIN categoriser_type ct ON j.id_jeu = ct.id_jeu
                LEFT JOIN type t ON ct.id_type = t.id_type
                LEFT JOIN categorie cat ON j.id_categorie = cat.id_categorie
                LEFT JOIN promotion p ON j.id_jeu = p.id_jeu
                    AND CURRENT_DATE BETWEEN p.date_debut AND p.date_fin
                WHERE mise_en_ligne = 1 AND validation = 1";

        if ($id_jeu) {
            $sql .= " AND j.id_jeu = :id_jeu";
            $params[':id_jeu'] = $id_jeu;
        }
        if ($categoryId) {
            $sql .= " AND j.id_categorie = :categoryId";
            $params[':categoryId'] = $categoryId;
        }
        if ($editeurId) {
            $sql .= " AND j.id_editeur = :editeurId";
            $params[':editeurId'] = $editeurId;
        }

        $sql .= " GROUP BY j.id_jeu";

        $result = $this->query($sql, $params);
        if ($result === false) {
            error_log("Erreur dans l'execution de la requête");
            return null;
        }

        return $id_jeu ? $result->fetch() : $result->fetchAll();

    } catch (\PDOException $e) {
        error_log("Erreur SQL : " . $e->getMessage());
        error_log("Code erreur : " . $e->getCode());
        return null;
    }
}
}