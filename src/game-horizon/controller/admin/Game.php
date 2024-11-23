<?php
namespace Controller\admin;
use Controller\admin\MainAdmin;

class Game extends MainAdmin
{
    public function index()
    {
        $gameModel = new \Model\visiteur\Shop();
        $games = $gameModel->getGamesByID();
        
        $this->view->title = 'Gestion des jeux';
        $this->view->Display('admin/admin_game', ['games' => $games]);
    }
    public function editGame($vars)
{
    $gameId = $vars["id"] ?? null;
    if (!$gameId) {
        $this->redirect('/admin/games');
    }

    $gameModel = new \Model\visiteur\Shop();
    $game = $gameModel->getGameById($gameId);
    
    if (!$game) {
        $this->redirect('/admin/games');
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'nom_jeu' => $_POST['nom_jeu'] ?? '',
            'prix' => floatval($_POST['prix']),
            'date_sortie' => $_POST['date_sortie'],
            'id_editeur' => intval($_POST['editeur']),
            'id_categorie' => intval($_POST['categorie']),
            'resume' => $_POST['resume'] ?? ''
        ];

        if ($gameModel->updateGame($gameId, $data)) {
            $this->redirect('/admin/games?success=Le jeu a été modifié avec succès');
        } else {
            $this->view->Display('admin/edit_admin_game', [
                'game' => $game,
                'categories' => $gameModel->getCategories(),
                'editeurs' => $gameModel->getEditeurs(),
                'error' => 'Erreur lors de la modification du jeu'
            ]);
            return;
        }
    }

    $this->view->title = 'Modifier le jeu';
    $this->view->Display('admin/edit_admin_game', [
        'game' => $game,
        'categories' => $gameModel->getCategories(),
        'editeurs' => $gameModel->getEditeurs()
    ]);
}
public function deleteGame($vars)
{
    $gameId = $vars["id"] ?? null;
    if (!$gameId) {
        $this->redirect('/admin/games?error=Jeu non trouvé');
        return;
    }

    try {
        $gameModel = new \Model\visiteur\Shop();
        
        // Vérifier si le jeu existe avant de le supprimer
        $game = $gameModel->getGameById($gameId);
        if (!$game) {
            throw new \Exception("Jeu non trouvé");
        }
        
        if ($gameModel->deleteGame($gameId)) {
            $this->redirect('/admin/games?success=Le jeu a été supprimé avec succès');
        } else {
            throw new \Exception("Erreur lors de la suppression du jeu");
        }
    } catch (\Exception $e) {
        $this->redirect('/admin/games?error=' . urlencode($e->getMessage()));
    }
}
}
