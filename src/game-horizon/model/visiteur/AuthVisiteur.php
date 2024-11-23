<?php
namespace Model\visiteur;
use Model\Db;

class AuthVisiteur extends Db
{
    public function getVisiteurByUsername($login)
    {
        try {
            $sql = "SELECT * FROM utilisateur WHERE pseudo_utilisateur = :pseudo_utilisateur";
            $stmt = $this->query($sql, [':pseudo_utilisateur' => $login]);
            $result = $stmt->fetch();
            error_log("Utilisateur trouvé dans la BDD : " . ($result ? 'oui' : 'non'));
            return $result;
        } catch (\PDOException $e) {
            error_log("Erreur de connexion à la BDD : " . $e->getMessage());
            return false;
        }
    }

    public function verifyPassword($password, $hashedPassword)
    {
        return password_verify($password, $hashedPassword);
    }
}
