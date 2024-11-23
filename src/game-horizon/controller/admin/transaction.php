<?php
namespace Controller\admin;

class transaction extends MainAdmin {
    private $transactionModel;

    public function __construct() {
        parent::__construct();
        $this->transactionModel = new \Model\admin\transaction();
    }

    public function index() {
        try {
            // Récupération individuelle des données avec vérification
            $totalVentes = $this->transactionModel->getTotalVentes();
            error_log("Controller - Total ventes: " . var_export($totalVentes, true));

            $ventesMois = $this->transactionModel->getVentesDuMois();
            error_log("Controller - Ventes mois: " . var_export($ventesMois, true));

            $ventesJour = $this->transactionModel->getVentesDuJour();
            error_log("Controller - Ventes jour: " . var_export($ventesJour, true));

            $meilleursJeux = $this->transactionModel->getMeilleursJeux();
            error_log("Controller - Meilleurs jeux: " . var_export($meilleursJeux, true));

            $derniersAchats = $this->transactionModel->getDerniersAchats(10);
            error_log("Controller - Derniers achats: " . var_export($derniersAchats, true));

            // Construction du tableau de statistiques
            $stats = [
                'total_ventes' => floatval($totalVentes),
                'ventes_mois' => floatval($ventesMois),
                'ventes_jour' => floatval($ventesJour),
                'meilleurs_jeux' => $meilleursJeux,
                'derniers_achats' => $derniersAchats
            ];

            error_log("Controller - Stats finales: " . var_export($stats, true));
            
            $this->view->title = 'Tableau de bord des ventes';
            $this->view->Display('admin/transaction', $stats);
            
        } catch (\Exception $e) {
            error_log("Erreur dans transaction->index: " . $e->getMessage());
            error_log("Stack trace: " . $e->getTraceAsString());
            
            $this->view->Display('admin/transaction', [
                'error' => 'Une erreur est survenue lors du chargement des statistiques.',
                'total_ventes' => 0,
                'ventes_mois' => 0,
                'ventes_jour' => 0,
                'meilleurs_jeux' => [],
                'derniers_achats' => []
            ]);
        }
    }
}