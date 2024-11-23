<?php
$routes = 
[
    '/'=>[
        'method'=>'GET',
        'controller'=>['Controller\visiteur\Shop','getGames'],
    ],
    '/filter'=>[
        'method'=>'GET',
        'controller'=>['Controller\visiteur\Filter','getFilteredGames'],
    ],
    '/game/{id}'=>[
        'method'=>'GET',
        'controller'=>['Controller\visiteur\Game_detail','getGame'],
    ],
    '/search'=>[
        'method'=>'GET',
        'controller'=>['Controller\visiteur\Shop','search'],
    ],
    '/api/search'=>[
        'method'=>'GET',
        'controller'=>['Controller\visiteur\Shop','searchSuggestions'],
    ],
    '/loginvisiteur' => [
        'method' => ['GET','POST'],
        'controller' => ['Controller\visiteur\AuthVisiteur', 'loginVisiteur']
    ],
    '/loginuser' => [
        'method' => 'POST',
        'controller' => ['Controller\visiteur\AuthVisiteur', 'loginVisiteur']
    ],
    '/profilUser'=>[
        'method'=>'GET',
        'controller'=>['Controller\visiteur\Profil','index'],
    ],
    '/register' => [
        'method' => ['GET','POST'],
        'controller' => ['Controller\visiteur\Register', 'register']
    ],
    '/logoutUser'=>[
        'method'=>'GET',
        'controller'=>['Controller\visiteur\AuthVisiteur','logoutUser'],
    ],
    '/choixPaiement/{id}'=>[
        'method'=>'GET',
        'controller'=>['Controller\visiteur\Game_detail','getGame'],
    ],
    '/panier' => [
        'method' => ['GET','POST'],
        'controller' => ['Controller\visiteur\Basket', 'index']
    ],
    '/commande' => [
        'method' => ['GET','POST'],
        'controller' => ['Controller\visiteur\Commande', 'index']
    ],
    '/confirmcommande' => [
        'method' => 'GET',
        'controller' => ['Controller\visiteur\Commande', 'confirmCommande']
    ],

    '/bibliotheque' => [
    'method' => 'GET',
    'controller' => ['Controller\visiteur\Biblio', 'index']
],
'/bibliotheque/download/{id}' => [
    'method' => 'GET',
    'controller' => ['Controller\visiteur\Biblio', 'downloadGame']
],

'/admin/remboursement' => [
    'method' => 'GET',
    'controller' => ['Controller\admin\remboursement_admin', 'index']
],
'/admin/remboursement/view/{id}' => [
    'method' => 'GET',
    'controller' => ['Controller\admin\remboursement_admin', 'viewRefund']
],
'/admin/remboursement/accept/{id}' => [
    'method' => 'GET',
    'controller' => ['Controller\admin\remboursement_admin', 'acceptRefund']
],
'/admin/remboursement/reject/{id}' => [
    'method' => 'GET',
    'controller' => ['Controller\admin\remboursement_admin', 'rejectRefund']
],
// Ajouter cette route pour le remboursement
'/bibliotheque/remboursement' => [
    'method' => 'POST',
    'controller' => ['Controller\visiteur\biblio', 'remboursement']
],
// Routes pour les remboursements admin

    
    //ADMIN

    '/index'=>[
        'method'=>'GET', 'POST',
        'controller'=>['Controller\admin\Home','accueil'],
    ],
    '/loginadmin'=>[
        'method'=>['GET', 'POST'],
        'controller'=>['Controller\Auth','login'],
    ],
    '/logout'=>[
        'method'=>'GET',
        'controller'=>['Controller\Auth','logout'],
    ],
    '/user'=>[
        'method'=>'GET',
        'controller'=>['Controller\admin\User','index'],
    ],
    '/user/edit_user/{id}'=>[
        'method'=>['GET', 'POST'],
        'controller'=>['Controller\admin\User','edit_user'],
    ],
    '/user/ban_user/{id}'=>[
        'method'=>['GET', 'POST'],
        'controller'=>['Controller\admin\User','ban_user'],
    ],
    '/user/unban/{id}' => [
        'method' => ['POST'], 
        'controller' => ['Controller\admin\User', 'unban'],
    ],
    '/category'=>[
        'method'=>'GET',
        'controller'=>['Controller\admin\Cat','category'],
    ],
    '/category/add'=>[
        'method'=>['GET', 'POST'],
        'controller'=>['Controller\admin\Cat','addCategory'],
    ],
    '/category/edit/{id}'=>[
        'method'=>['GET', 'POST'],
        'controller'=>['Controller\admin\Cat','editCategory'],
    ],
    '/category/delete/{id}'=>[
        'method'=>'POST',
        'controller'=>['Controller\admin\Cat','deleteCategory'],
    ],
    '/editeur'=>[
        'method'=>'GET',
        'controller'=>['Controller\admin\editeur','editeur'],
    ],
    '/editeur/edit_editeur/{id}'=>[
        'method'=>['GET', 'POST'],
        'controller'=>['Controller\admin\editeur','edit_editeur'],
    ],
    '/editeur/add'=>[
        'method'=>['GET', 'POST'],
        'controller'=>['Controller\admin\editeur','addEditeur'],
    ],
    '/editeur/delete/{id}'=>[
        'method'=>'POST',
        'controller'=>['Controller\admin\editeur','deleteEditeur'],
    ],
    '/logchoice'=>[
        'method'=>['GET'],
        'controller'=>['Controller\Auth','logChoice'],
    ],

    //EDITEUR

    '/loginediteur' =>[
        'method'=> ['GET','POST'],
        'controller'=>['Controller\editeur\dashboardEditeur','getLogin'],
    ],
    '/logoutediteur' =>[
        'method'=> 'POST',
        'controller'=>['Controller\editeur\dashboardEditeur','logoutEditeur'],
    ],
    '/dashboardediteur'=>[
        'method'=>'GET',
        'controller'=>['Controller\editeur\dashboardEditeur','dashboardEditeurIndex'],
    ],
     '/jeuxenligne'=>[
        'method'=> 'GET',
        'controller' =>['Controller\editeur\jeu','getjeuxEditeurEnLigne']
     ],
     '/jeu/{id}'=>[
        'method'=>'GET',
        'controller'=>['Controller\editeur\jeu','getjeu']
    ],
    '/jeuxenattente'=>[
        'method'=> 'GET',
        'controller' =>['Controller\editeur\jeu','getjeuxEditeurEnAttente']
     ],
     '/soumettrejeu'=>[
        'method'=> 'GET',
        'controller' =>['Controller\editeur\jeu','soumettreJeuView']
     ],
     '/soumettre'=>[
        'method'=> 'POST',
        'controller' =>['Controller\editeur\jeu','soumettreJeu']
     ],

     '/modificationjeu/{id}'=>[
        'method'=>'GET',
        'controller'=>['Controller\editeur\jeu','updateJeuView']
    ],
    '/updatejeu'=>[
        'method'=>'POST',
        'controller'=>['Controller\editeur\jeu','updateJeu']
    ],
    '/votreprofilediteur'=>[
        'method'=>'GET',
        'controller'=>['Controller\editeur\dashboardEditeur','profilEditeur']
    ],
    '/updateprofilediteur'=>[
        'method'=>'POST',
        'controller'=>['Controller\editeur\dashboardEditeur','updateProfilEditeur']
    ],

    '/ajouterpromotion'=>[
        'method'=>'GET',
        'controller'=>['Controller\editeur\promotionController','afficherFormPromotion']
    ],

    '/promotionajout'=>[
        'method'=>'POST',
        'controller'=>['Controller\editeur\promotionController','ajouterPromotion']
    ],
    '/admin/games' => [
    'method' => 'GET',
    'controller' => ['Controller\admin\Game', 'index'],
    ],
        '/admin/games/edit/{id}' => [
        'method' => ['GET', 'POST'],
        'controller' => ['Controller\admin\Game', 'editGame'],
    ],
        '/admin/transaction' => [
        'method' => 'GET',
        'controller' => ['Controller\admin\transaction', 'index'], // Minuscule 'transaction' au lieu de 'Transaction'
    ],
    '/admin/games/delete/{id}' => [
        'method' => 'POST',
        'controller' => ['Controller\admin\Game', 'deleteGame'],
    ],
    '/proposition' => [
        'method' => 'GET',
        'controller' => ['Controller\admin\proposition', 'index'],
    ],
    '/proposition/view/{id}' => [
        'method' => 'GET',
        'controller' => ['Controller\admin\proposition', 'viewGame'],
    ],
    '/proposition/validate/{id}' => [
        'method' => 'POST',
        'controller' => ['Controller\admin\proposition', 'validateGame'],
    ],
    '/proposition/reject/{id}' => [
        'method' => 'POST',
        'controller' => ['Controller\admin\proposition', 'rejectGame'],
    ],
    ];


error_log("Routes définies : " . print_r($routes, true));