<?php

namespace Model\editeur;
use \Controller\Error;
use Model\Db;


class Promotion extends DB {
    
    function ajouterPromotion($idJeu, $reduction, $dateDebut, $dateFin) {
        return $this->query(
            "INSERT INTO promotion (id_jeu, reduction, date_debut, date_fin) 
             VALUES (:idJeu, :reduction, :dateDebut, :dateFin)",
            [
                ':idJeu' => $idJeu,
                ':reduction' => $reduction,
                ':dateDebut' => $dateDebut,
                ':dateFin' => $dateFin
            ]
        );
    }

    function ajouterPromotionsMultiples($jeuxIds, $reduction, $dateDebut, $dateFin) {
        $success = true;
        foreach ($jeuxIds as $idJeu) {
            $result = $this->ajouterPromotion($idJeu, $reduction, $dateDebut, $dateFin);
            if (!$result) {
                $success = false;
            }
        }
        return $success;
    }
}