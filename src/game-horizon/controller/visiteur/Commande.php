<?php
namespace Controller\visiteur;
use \Model\visiteur\Shop;
use \Model\Commande as CommandeModel;
use \Model\Contenir;
use \Model\visiteur\Posseder;

class Commande extends MainVisiteur
{
    public function index()
    {
        if(!$this->isUserLoggedIn())
        {
            $_SESSION['from'] = 'commande';
            header("Location:/loginvisiteur");
        }
        $panier = isset($_SESSION['panier']) && is_array($_SESSION['panier']) ? $_SESSION['panier'] : [];

        $shopModel = new Shop();
        $games = $shopModel->getGamesByIds($panier);
        $total = 0;
        foreach($games as $game)
        {
            $total += isset($game['prix_final']) ? $game['prix_final'] : $game['prix'];
        }
        if(isset($_POST['choixPaiement']) && !empty($_POST['choixPaiement']))
        {
            $user = $this->getUserSession();
            
            $commandeModel = new CommandeModel();
            $id_transaction = $commandeModel->addCommande([
            'total_transaction' => $total,
            'moyen_paiement' => $_POST['choixPaiement'],
            'id_utilisateur' => $user['id_utilisateur'],
            ]);
            
            $possederModel = new Posseder();
            
            foreach($games as $game)
            {
                 $ligneCommande = new Contenir();
                 $ligneCommande->addJeuCommande(
                    [
                        'id_jeu'=>$game['id_jeu'],
                        'id_transaction'=>$id_transaction,
                        'prix'=>isset($game['prix_final']) ? $game['prix_final'] : $game['prix'],
                    ]
                 );
                 
                 $possederModel->addGameToLibrary([
                    'id_utilisateur' => $user['id_utilisateur'],
                    'id_jeu' => $game['id_jeu'],
                    'date_achat' => date('Y-m-d H:i:s')
                ]);
            }
            unset($_SESSION['panier']);
            header("location:/confirmcommande");
            exit();
        }


        self::$View->title = 'Passer la commande';
        self::$View->total = $total;
        self::$View->games = $games;


        return self::$View->Display('visiteur/commande');
    }

    public function confirmCommande()
    {
        if(!$this->isUserLoggedIn()) {
            header("Location:/loginvisiteur");
            exit();
        }

        // Récupérer les détails de la dernière commande
        $user = $this->getUserSession();
        $commandeModel = new CommandeModel();
        $lastOrder = $commandeModel->getLastOrder($user['id_utilisateur']);

        if(!$lastOrder) {
            header("Location:/");
            exit();
        }

        self::$View->title = 'Confirmation de commande';
        self::$View->games = $lastOrder['games'];
        self::$View->total = $lastOrder['total'];

        return self::$View->Display('visiteur/confirm_commande');
    }
}


