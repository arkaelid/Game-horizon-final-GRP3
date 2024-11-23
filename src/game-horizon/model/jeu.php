<?php

namespace Model;
use \Controller\Error;

class Jeu extends DB {

    function getjeuxEditeurEnLigne($nomEditeur){
        return $this->query("SELECT 
          j.id_jeu, 
            j.nom_jeu, 
            j.prix, 
            j.resume, 
            j.date_sortie, 
            j.validation, 
            j.gif, 
            j.image_banniere, 
            p.reduction,
            CASE 
                WHEN p.reduction IS NOT NULL 
                THEN ROUND(j.prix * (1 - p.reduction / 100), 2)
                ELSE j.prix 
            END AS prix_final,
            CASE 
                WHEN p.reduction IS NOT NULL 
                THEN CONCAT(p.reduction, '%')
                ELSE 'Pas de promotion en cours'
            END AS statut_promotion
        FROM jeu j
        JOIN editeur e ON j.id_editeur = e.id_editeur
        LEFT JOIN (
            SELECT 
                id_jeu, 
                reduction, 
                date_debut, 
                date_fin
            FROM promotion
            WHERE CURRENT_DATE BETWEEN date_debut AND date_fin
            GROUP BY id_jeu
            ORDER BY date_fin DESC
        ) p ON j.id_jeu = p.id_jeu
        WHERE e.nom_societe = :nomEditeur 
        AND j.validation = 1
    ",[':nomEditeur' => $nomEditeur]);
    }

    function getjeuxEditeurEnAttente($nomEditeur){
        return $this->query("SELECT id_jeu,nom_jeu,prix,resume,date_sortie,validation,gif,image_banniere,date_miseEnLigne FROM jeu JOIN editeur ON jeu.id_editeur = editeur.id_editeur WHERE editeur.nom_societe = :nomEditeur AND validation=0",[':nomEditeur' => $nomEditeur])-> fetchAll();
    }

    function soumettreJeu($typeJeu, $idJeuParent,$nomJeu, $prix, $resume, $dateSortie, $gif, $imageCard, $imageBanniere, $idGenre, $idCategorie,$controlleurs = [] ) {
        $this->query(
            "INSERT INTO jeu (
                nom_jeu, 
                prix, 
                resume, 
                date_sortie, 
                validation, 
                gif, 
                image_card, 
                image_banniere, 
                mise_en_ligne, 
                date_miseEnLigne, 
                id_editeur, 
                id_genre, 
                id_categorie, 
                type_jeu, 
                id_jeu_parent
            ) VALUES (
                :nomJeu, 
                :prix, 
                :resume, 
                :dateSortie, 
                :validation, 
                :gif, 
                :imageCard, 
                :imageBanniere, 
                :miseEnLigne, 
                :dateMiseEnLigne, 
                :idEditeur, 
                :idGenre, 
                :idCategorie, 
                :typeJeu, 
                :idJeuParent
            )",
            [
                ':nomJeu' => $nomJeu,
                ':prix' => $prix,
                ':resume' => $resume,
                ':dateSortie' => $dateSortie,
                ':validation' => 0, 
                ':gif' => $gif,
                ':imageCard' => $imageCard,
                ':imageBanniere' => $imageBanniere,
                ':miseEnLigne' => 0, 
                ':dateMiseEnLigne' => date('Y-m-d'), 
                ':idEditeur' => $_SESSION['id_editeur'], 
                ':idGenre' => $idGenre,
                ':idCategorie' => $idCategorie,
                ':typeJeu' => $typeJeu, 
                ':idJeuParent' => $idJeuParent 
        ]);
    

    $idJeu = $this->lastId();

        foreach ($controlleurs as $idControlleur) {
            $this->query("INSERT INTO adapter (id_jeu, id_controlleurs) VALUES (:idJeu, :idControlleur)", [
                ':idJeu' => $idJeu,
                ':idControlleur' => $idControlleur
            ]);
    }

    $this->query(
        "INSERT INTO notif (date_heure_notif, objet, contenu, etat) VALUES (:dateNotif, :objet, :contenu, :etat)",
        [
            ':dateNotif' => date('Y-m-d H:i:s'),
            ':objet' => 'Nouveau jeu soumis',
            ':contenu' => "Un nouveau jeu nommé '$nomJeu' a été soumis.",
            ':etat' => 0 
        ]
    );

    $idNotif = $this->lastId();

    $admins = $this->query("SELECT login FROM admin");

    foreach ($admins as $admin) {
        $this->query(
            "INSERT INTO recevoir_admin (login, id_notif) VALUES (:login, :idNotif)",
            [
                ':login' => $admin['login'],
                ':idNotif' => $idNotif
            ]
        );
    }

}
    function getGenres() {
        return $this->query("SELECT * FROM genre ORDER BY libelle_genre");
    }

    function getCategories() {
        return $this->query("SELECT * FROM categorie ORDER BY libelle_categorie ASC");
    }

    function getControlleurs() {
        return $this->query("SELECT * FROM controlleur");
    }


   function getjeuById($id){

     return $this->query("SELECT 
            j.id_jeu, 
            j.nom_jeu, 
            j.prix, 
            j.resume, 
            j.date_sortie, 
            j.validation, 
            j.gif, 
            j.image_banniere,
            j.id_editeur, 
            p.reduction,
            CASE 
                WHEN p.reduction IS NOT NULL 
                THEN ROUND(j.prix * (1 - p.reduction / 100), 2)
                ELSE j.prix 
            END AS prix_final,
            CASE 
                WHEN p.reduction IS NOT NULL 
                THEN CONCAT(p.reduction, '%')
                ELSE 'Pas de promotion en cours'
            END AS statut_promotion
        FROM jeu j
        LEFT JOIN (
            SELECT 
                id_jeu, 
                reduction, 
                date_debut, 
                date_fin
            FROM promotion
            WHERE CURRENT_DATE BETWEEN date_debut AND date_fin
            GROUP BY id_jeu
            ORDER BY date_fin DESC
        ) p ON j.id_jeu = p.id_jeu
        WHERE j.id_jeu = :id" , [':id'=>$id])->fetch();
 
    } 



       function updateJeu($nomJeu,$prix,$resume,$dateSortie,$idJeu) {
            $this->query("UPDATE jeu SET nom_jeu = :nomJeu, prix = :prix, resume = :resume, date_sortie = :dateSortie WHERE id_jeu = :idJeu",
            [
            ':nomJeu'=> $nomJeu,
            ':prix' => $prix,
            ':resume' => $resume,
            ':dateSortie' => $dateSortie,     
            ':idJeu'=> $idJeu   
            ]);
       }


     

    
}





