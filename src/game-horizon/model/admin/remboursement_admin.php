<?php
namespace Model\admin;
use Model\Db;

class remboursement_admin extends Db
{
    public function getAllRefundRequests()
    {
        try {
            $sql = "SELECT r.*, j.nom_jeu, j.image_card, u.pseudo_utilisateur, 
                    DATE_FORMAT(r.date_demande, '%d/%m/%Y') as date_formatee,
                    DATE_FORMAT(r.date_traitement, '%d/%m/%Y') as date_traitement_formatee,
                    c.total_transaction as montant_total
                    FROM remboursement r
                    JOIN jeu j ON r.id_jeu = j.id_jeu
                    JOIN utilisateur u ON r.id_utilisateur = u.id_utilisateur
                    JOIN commande c ON r.id_transaction = c.id_transaction
                    ORDER BY 
                        CASE 
                            WHEN r.statut = 'en_attente' THEN 1
                            ELSE 2
                        END,
                        r.date_demande DESC";
            
            error_log("SQL getAllRefundRequests: " . $sql);
            $result = $this->query($sql);
            $data = $result->fetchAll();
            error_log("Résultat getAllRefundRequests: " . print_r($data, true));
            return $data;
            
        } catch (\PDOException $e) {
            error_log("Erreur PDO dans getAllRefundRequests: " . $e->getMessage());
            throw $e;
        }
    }

    public function getPendingRefundsCount()
    {
        try {
            $sql = "SELECT COUNT(*) as count FROM remboursement WHERE statut = 'en_attente'";
            error_log("SQL getPendingRefundsCount: " . $sql);
            $result = $this->query($sql);
            $data = $result->fetch();
            error_log("Résultat getPendingRefundsCount: " . print_r($data, true));
            return $data['count'] ?? 0;
            
        } catch (\PDOException $e) {
            error_log("Erreur PDO dans getPendingRefundsCount: " . $e->getMessage());
            throw $e;
        }
    }

    public function acceptRefund($refundId)
    {
        try {
            // Récupérer les informations du remboursement
            $checkSql = "SELECT r.*, j.nom_jeu, u.pseudo_utilisateur 
                        FROM remboursement r
                        JOIN jeu j ON r.id_jeu = j.id_jeu
                        JOIN utilisateur u ON r.id_utilisateur = u.id_utilisateur
                        WHERE r.id_remboursement = :refundId 
                        AND r.statut = 'en_attente'";
            
            $refund = $this->query($checkSql, [':refundId' => $refundId])->fetch();
            
            if (!$refund) {
                error_log("Remboursement non trouvé ou déjà traité: " . $refundId);
                return false;
            }

            // Mettre à jour le statut du remboursement
            $updateSql = "UPDATE remboursement 
                         SET statut = 'accepte', 
                             date_traitement = NOW() 
                         WHERE id_remboursement = :refundId";
            
            error_log("SQL acceptRefund: " . $updateSql);
            $this->query($updateSql, [':refundId' => $refundId]);
            
            // Supprimer le jeu de la bibliothèque de l'utilisateur
            $deleteSql = "DELETE FROM posseder 
                         WHERE id_utilisateur = :userId 
                         AND id_jeu = :gameId";
            
            error_log("SQL delete from posseder: " . $deleteSql);
            error_log("Suppression du jeu {$refund['nom_jeu']} de la bibliothèque de l'utilisateur {$refund['pseudo_utilisateur']}");
            
            $this->query($deleteSql, [
                ':userId' => $refund['id_utilisateur'],
                ':gameId' => $refund['id_jeu']
            ]);
            
            return true;
            
        } catch (\PDOException $e) {
            error_log("Erreur PDO dans acceptRefund: " . $e->getMessage());
            throw $e;
        }
    }

    public function rejectRefund($refundId)
    {
        try {
            $sql = "UPDATE remboursement 
                    SET statut = 'refuse', 
                        date_traitement = NOW() 
                    WHERE id_remboursement = :refundId";
            
            error_log("SQL rejectRefund: " . $sql);
            return $this->query($sql, [':refundId' => $refundId]);
            
        } catch (\PDOException $e) {
            error_log("Erreur PDO dans rejectRefund: " . $e->getMessage());
            throw $e;
        }
    }

    public function getRefundById($refundId)
    {
        try {
            $sql = "SELECT r.*, j.nom_jeu, j.image_card, u.pseudo_utilisateur,
                    DATE_FORMAT(r.date_demande, '%d/%m/%Y') as date_formatee,
                    c.total_transaction as montant_total
                    FROM remboursement r
                    JOIN jeu j ON r.id_jeu = j.id_jeu
                    JOIN utilisateur u ON r.id_utilisateur = u.id_utilisateur
                    JOIN commande c ON r.id_transaction = c.id_transaction
                    WHERE r.id_remboursement = :refundId";
            
            error_log("SQL getRefundById: " . $sql);
            $result = $this->query($sql, [':refundId' => $refundId]);
            $data = $result->fetch();
            error_log("Résultat getRefundById: " . print_r($data, true));
            return $data;
            
        } catch (\PDOException $e) {
            error_log("Erreur PDO dans getRefundById: " . $e->getMessage());
            throw $e;
        }
    }
}
