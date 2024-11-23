<?php
namespace Model\visiteur;
use Model\Db;

class biblio extends Db
{
    public function getUserGames($userId)
    {
        $sql = "SELECT j.*, p.date_achat, 
                g.libelle_genre,
                GROUP_CONCAT(DISTINCT c.libelle_categorie ORDER BY c.libelle_categorie SEPARATOR ' | ') AS categories
                FROM posseder p
                JOIN jeu j ON p.id_jeu = j.id_jeu
                LEFT JOIN genre g ON j.id_genre = g.id_genre
                LEFT JOIN categorie c ON j.id_categorie = c.id_categorie
                WHERE p.id_utilisateur = :userId
                GROUP BY j.id_jeu
                ORDER BY p.date_achat DESC";

        return $this->query($sql, [':userId' => $userId])->fetchAll();
    }

    public function getGameInfo($gameId, $userId)
    {
        try {
            // Vérifier d'abord si l'utilisateur possède le jeu
            $checkSql = "SELECT COUNT(*) as count 
                        FROM posseder 
                        WHERE id_utilisateur = :userId 
                        AND id_jeu = :gameId";
            
            $result = $this->query($checkSql, [
                ':userId' => $userId,
                ':gameId' => $gameId
            ])->fetch();
            
            if ($result['count'] == 0) {
                return false; // L'utilisateur ne possède pas ce jeu
            }

            // Si l'utilisateur possède le jeu, récupérer les informations
            $sql = "SELECT j.*, p.date_achat
                    FROM posseder p
                    JOIN jeu j ON p.id_jeu = j.id_jeu
                    WHERE p.id_utilisateur = :userId
                    AND p.id_jeu = :gameId";

            return $this->query($sql, [
                ':userId' => $userId,
                ':gameId' => $gameId
            ])->fetch();
        } catch (\PDOException $e) {
            error_log("Erreur SQL dans getGameInfo : " . $e->getMessage());
            return false;
        }
    }

    public function getGamesWithRefundStatus($userId)
    {
        $sql = "SELECT j.*, 
                c.date_heure_transaction as date_achat,
                g.libelle_genre,
                GROUP_CONCAT(DISTINCT cat.libelle_categorie ORDER BY cat.libelle_categorie SEPARATOR ' | ') AS categories,
                CASE 
                    WHEN r.id_remboursement IS NOT NULL THEN true 
                    ELSE false 
                END as demande_remboursement
                FROM jeu j
                INNER JOIN contenir co ON j.id_jeu = co.id_jeu
                INNER JOIN commande c ON co.id_transaction = c.id_transaction
                LEFT JOIN genre g ON j.id_genre = g.id_genre
                LEFT JOIN categorie cat ON j.id_categorie = cat.id_categorie
                LEFT JOIN remboursement r ON j.id_jeu = r.id_jeu AND r.id_utilisateur = :userId
                WHERE c.id_utilisateur = :userId
                AND (r.statut IS NULL OR r.statut != 'accepte')
                GROUP BY j.id_jeu, c.date_heure_transaction, r.id_remboursement";
        
        return $this->query($sql, [':userId' => $userId])->fetchAll();
    }

    public function createRefundRequest($userId, $gameId, $reason)
    {
        // Vérifier si une demande existe déjà
        $checkSql = "SELECT COUNT(*) FROM remboursement 
                    WHERE id_utilisateur = :userId AND id_jeu = :gameId";
        
        $exists = $this->query($checkSql, [
            ':userId' => $userId,
            ':gameId' => $gameId
        ])->fetchColumn();

        if ($exists > 0) {
            return false;
        }

        // Récupérer l'ID de la transaction
        $transactionSql = "SELECT c.id_transaction 
                          FROM commande c 
                          INNER JOIN contenir co ON c.id_transaction = co.id_transaction 
                          WHERE c.id_utilisateur = :userId AND co.id_jeu = :gameId 
                          ORDER BY c.date_heure_transaction DESC LIMIT 1";
        
        $transactionId = $this->query($transactionSql, [
            ':userId' => $userId,
            ':gameId' => $gameId
        ])->fetchColumn();

        // Créer la demande de remboursement
        $sql = "INSERT INTO remboursement (id_utilisateur, id_jeu, raison, id_transaction) 
                VALUES (:userId, :gameId, :reason, :transactionId)";
        
        return $this->query($sql, [
            ':userId' => $userId,
            ':gameId' => $gameId,
            ':reason' => $reason,
            ':transactionId' => $transactionId
        ]);
    }
}
