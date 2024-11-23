<?php
namespace Model;

class Commande extends Db
{
    public function addCommande($data)
    {
        try {
            $sql = "INSERT INTO commande (
                        total_transaction, 
                        moyen_paiement, 
                        id_utilisateur, 
                        date_heure_transaction,
                        etat_transaction
                    ) 
                    VALUES (
                        :total_transaction, 
                        :moyen_paiement, 
                        :id_utilisateur, 
                        NOW(),
                        'Terminée'
                    )";
            
            $params = [
                ':total_transaction' => $data['total_transaction'],
                ':moyen_paiement' => $data['moyen_paiement'],
                ':id_utilisateur' => $data['id_utilisateur']
            ];
            
            $this->query($sql, $params);
            return $this->lastInsertId();
        } catch (\PDOException $e) {
            error_log("Erreur SQL lors de l'ajout de la commande : " . $e->getMessage());
            return false;
        }
    }

    public function getLastOrder($userId)
    {
        try {
            $sql = "SELECT c.id_transaction, c.total_transaction, c.date_heure_transaction,
                    c.moyen_paiement,
                    j.id_jeu, j.nom_jeu, j.image_card, j.prix,
                    p.reduction,
                    CASE
                        WHEN p.reduction IS NOT NULL
                        THEN ROUND(j.prix * (1 - p.reduction/100), 2)
                        ELSE j.prix
                    END as prix_final
                    FROM commande c
                    JOIN contenir co ON c.id_transaction = co.id_transaction
                    JOIN jeu j ON co.id_jeu = j.id_jeu
                    LEFT JOIN promotion p ON j.id_jeu = p.id_jeu
                        AND CURRENT_DATE BETWEEN p.date_debut AND p.date_fin
                    WHERE c.id_utilisateur = :userId
                    ORDER BY c.date_heure_transaction DESC
                    LIMIT 1";
            
            $result = $this->query($sql, [':userId' => $userId]);
            $order = $result->fetchAll();
            
            if(empty($order)) {
                return null;
            }
            
            return [
                'games' => $order,
                'total' => $order[0]['total_transaction'],
                'moyen_paiement' => $order[0]['moyen_paiement'],
                'date' => $order[0]['date_heure_transaction']
            ];
        } catch (\PDOException $e) {
            error_log("SQL Error: " . $e->getMessage());
            return null;
        }
    }

}

// $_SESSION['id_utilisateur']