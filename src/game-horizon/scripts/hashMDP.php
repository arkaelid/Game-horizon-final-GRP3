<?php
// Demande à l'utilisateur d'entrer le mot de passe à hasher
echo "Entrez le mot de passe à hasher : ";
$motDePasse = trim(fgets(STDIN));

// Hachage du mot de passe avec bcrypt (par défaut)
$hash = password_hash($motDePasse, PASSWORD_ARGON2ID);

// Affichage du mot de passe hashé
echo "Mot de passe hashé : " . $hash . PHP_EOL;
?>