<?php
namespace Controller\admin;

class proposition extends MainAdmin
{
    public function index()
    {
        $propositionModel = new \Model\admin\proposition();
        $pendingGames = $propositionModel->getPendingGames();
        
        $this->view->title = 'Propositions de jeux';
        $this->view->Display('admin/proposition', [
            'pendingGames' => $pendingGames
        ]);
    }

    public function viewGame($vars)
    {
        $gameId = $vars["id"] ?? null;
        if (!$gameId) {
            $this->redirect('/proposition');
        }

        $propositionModel = new \Model\admin\proposition();
        $game = $propositionModel->getGameById($gameId);

        if (!$game) {
            $this->redirect('/proposition');
        }

        $this->view->title = 'Vérification du jeu';
        $this->view->Display('admin/edit_proposition', [
            'game' => $game
        ]);
    }

    public function validateGame($vars)
    {
        $gameId = $vars["id"] ?? null;
        if (!$gameId) {
            $this->redirect('/proposition?error=Jeu non trouvé');
        }

        try {
            $propositionModel = new \Model\admin\proposition();
            $propositionModel->validateGame($gameId);
            $this->redirect('/proposition?success=Le jeu a été validé avec succès');
        } catch (\Exception $e) {
            $this->redirect('/proposition?error=Erreur lors de la validation : ' . $e->getMessage());
        }
    }

    public function rejectGame($vars)
    {
        $gameId = $vars["id"] ?? null;
        if (!$gameId) {
            $this->redirect('/proposition?error=Jeu non trouvé');
        }

        try {
            $propositionModel = new \Model\admin\proposition();
            $propositionModel->rejectGame($gameId);
            $this->redirect('/proposition?success=Le jeu a été rejeté');
        } catch (\Exception $e) {
            $this->redirect('/proposition?error=Erreur lors du rejet : ' . $e->getMessage());
        }
    }

    public function getMedia($vars=[])
    {
        if (!isset($vars['id'])) {
            \Controller\Error::HttpError(404);
            return;
        }

        $id_jeu = $vars['id'];
        $mediaModel = new \Model\Admin\proposition();
        $medias = $mediaModel->getMedia($id_jeu);

        if (!$medias) {
            \Controller\Error::HttpError(404);
            return;
        }

        $this->view->title = 'Détail du jeu';
        $this->view->h1_title = 'Catalogue de jeux';
        $this->view->media = $medias;
        $this->view->Display('admin/edit_proposition');
    }
}
