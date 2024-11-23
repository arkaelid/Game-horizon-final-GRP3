<?php
namespace Model\admin;
use Model\Db;

class transaction extends Db {
    
    public function getTotalVentes() {
        $sql = "SELECT COALESCE(SUM(CAST(cmd.total_transaction AS DECIMAL(10,2))), 0) as total 
                FROM commande cmd 
                WHERE cmd.etat_transaction = 'Terminée'";
        error_log("SQL getTotalVentes: " . $sql);
        $result = $this->query($sql);
        $data = $result->fetch();
        error_log("Résultat getTotalVentes: " . print_r($data, true));
        return $data['total'] ?? 0;
    }

    public function getVentesDuMois() {
        $sql = "SELECT COALESCE(SUM(CAST(cmd.total_transaction AS DECIMAL(10,2))), 0) as total 
                FROM commande cmd 
                WHERE MONTH(cmd.date_heure_transaction) = MONTH(CURRENT_DATE) 
                AND YEAR(cmd.date_heure_transaction) = YEAR(CURRENT_DATE)
                AND cmd.etat_transaction = 'Terminée'";
        error_log("SQL getVentesDuMois: " . $sql);
        $result = $this->query($sql);
        $data = $result->fetch();
        error_log("Résultat getVentesDuMois: " . print_r($data, true));
        return $data['total'] ?? 0;
    }

    public function getVentesDuJour() {
        $sql = "SELECT COALESCE(SUM(CAST(cmd.total_transaction AS DECIMAL(10,2))), 0) as total 
                FROM commande cmd 
                WHERE DATE(cmd.date_heure_transaction) = CURRENT_DATE
                AND cmd.etat_transaction = 'Terminée'";
        error_log("SQL getVentesDuJour: " . $sql);
        $result = $this->query($sql);
        $data = $result->fetch();
        error_log("Résultat getVentesDuJour: " . print_r($data, true));
        return $data['total'] ?? 0;
    }

    public function getMeilleursJeux() {
        $sql = "SELECT 
                    j.nom_jeu,
                    COUNT(DISTINCT c.id_transaction) as nb_ventes,
                    COALESCE(SUM(CAST(cmd.total_transaction AS DECIMAL(10,2))), 0) as total_ventes
                FROM jeu j
                JOIN contenir c ON c.id_jeu = j.id_jeu
                JOIN commande cmd ON cmd.id_transaction = c.id_transaction
                WHERE cmd.etat_transaction = 'Terminée'
                GROUP BY j.id_jeu, j.nom_jeu
                ORDER BY nb_ventes DESC, total_ventes DESC
                LIMIT 5";
        error_log("SQL getMeilleursJeux: " . $sql);
        $result = $this->query($sql);
        $data = $result->fetchAll();
        error_log("Résultat getMeilleursJeux: " . print_r($data, true));
        return $data;
    }

    public function getDerniersAchats($limit = 10) {
        try {
            $sql = "SELECT 
                        cmd.id_transaction,
                        cmd.date_heure_transaction,
                        u.pseudo_utilisateur,
                        GROUP_CONCAT(j.nom_jeu SEPARATOR ', ') as jeux,
                        SUM(
                            CASE 
                                WHEN p.reduction IS NOT NULL 
                                    AND cmd.date_heure_transaction BETWEEN p.date_debut AND p.date_fin
                                THEN c.prix * (1 - p.reduction/100)
                                ELSE c.prix
                            END
                        ) as total_transaction
                    FROM commande cmd
                    JOIN utilisateur u ON u.id_utilisateur = cmd.id_utilisateur
                    JOIN contenir c ON c.id_transaction = cmd.id_transaction
                    JOIN jeu j ON j.id_jeu = c.id_jeu
                    LEFT JOIN promotion p ON p.id_jeu = j.id_jeu
                    WHERE cmd.etat_transaction = 'Terminée'
                    GROUP BY cmd.id_transaction, cmd.date_heure_transaction, u.pseudo_utilisateur
                    ORDER BY cmd.date_heure_transaction DESC
                    LIMIT :limit";
            
            error_log("Model - SQL getDerniersAchats: " . $sql);
            
            $stmt = $this->prepare($sql);
            $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll();
            
            error_log("Model - Résultat getDerniersAchats: " . var_export($result, true));
            return $result;
            
        } catch (\PDOException $e) {
            error_log("Erreur PDO dans getDerniersAchats: " . $e->getMessage());
            throw $e;
        }
    }
}