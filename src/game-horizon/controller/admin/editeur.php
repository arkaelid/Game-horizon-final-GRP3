<?php
namespace Controller\admin;

class editeur extends MainAdmin
{
    public function editeur()
    {
        try {
            $editeurModel = new \Model\admin\editeur();
            $editeurs = $editeurModel->getEditeurProfiles();
            
            $this->view->Display('admin/editeur', [
                'editeurs' => $editeurs,
                'success' => $_GET['success'] ?? null,
                'error' => $_GET['error'] ?? null
            ]);
        } catch (\Exception $e) {
            error_log("Erreur dans editeur->editeur: " . $e->getMessage());
            $this->view->Display('admin/editeur', [
                'editeurs' => [],
                'error' => 'Une erreur est survenue lors du chargement des éditeurs.'
            ]);
        }
    }

    public function edit_editeur($vars)
    {
        $userId = $vars["id"] ?? null;
        if (!$userId) {
            $this->redirect('/editeur');
        }

        $editeurModel = new \Model\admin\editeur();
        $shopModel = new \Model\visiteur\Shop();
        
        $editeur = $editeurModel->getEditeurProfiles($userId)[0] ?? null;
        if (!$editeur) {
            $this->redirect('/editeur');
        }

        // Récupérer les jeux de l'éditeur
        $jeux = $shopModel->getGamesByIDByEditeur($userId);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? 'update';
            
            if ($action === 'reset_image') {
                // Réinitialiser l'image de profil
                $data = ['chemin_img_editeur' => '/img/utilisateurs/user.png'];
                $editeurModel->updateEditeur($userId, $data);
                $this->redirect('/editeur/edit_editeur/' . $userId);
            } else {
                // Mise à jour normale
                $data = [
                    'nom_societe' => $_POST['pseudo'] ?? '',
                    'mail_editeur' => $_POST['mail'] ?? '',
                    'adresse_editeur' => $_POST['adresse'] ?? '',
                    'siret' => $_POST['siret'] ?? '',
                    'chemin_img_editeur' => $editeur['chemin_img_editeur'] // Garder l'image actuelle
                ];
                $editeurModel->updateEditeur($userId, $data);
                $this->redirect('/editeur');
            }
        }

        $this->view->title = 'Modifier l\'éditeur';
        $this->view->Display('admin/edit_editeur', [
            'editeur' => $editeur,
            'jeux' => $jeux
        ]);
    }

    public function deleteEditeur($vars)
    {
        $editeurId = $vars["id"] ?? null;
        if (!$editeurId) {
            $this->redirect('/editeur?error=Éditeur non trouvé');
            return;
        }
    
        try {
            $editeurModel = new \Model\admin\editeur();
            $editeurModel->deleteEditeur($editeurId);
            $this->redirect('/editeur?success=L\'éditeur a été supprimé avec succès');
        } catch (\Exception $e) {
            $this->redirect('/editeur?error=Erreur lors de la suppression : ' . $e->getMessage());
        }
    }
    
    public function addEditeur()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $editeurModel = new \Model\admin\editeur();

            $data = [
                'nom_societe' => $_POST['nom_societe'] ?? '',
                'login_editeur' => $_POST['login_editeur'] ?? '',
                'password_editeur' => $_POST['password'] ?? '',
                'mail_editeur' => $_POST['mail'] ?? '',
                'adresse_editeur' => $_POST['adresse'] ?? '',
                'siret' => $_POST['siret'] ?? '',
                'chemin_img_editeur' => '/img/utilisateurs/user.png'
            ];
    
            try {
                $editeurModel->addEditeur($data);
                $this->redirect('/editeur?success=L\'éditeur a été ajouté avec succès');
            } catch (\Exception $e) {
                $this->view->Display('admin/add_editeur', [
                    'error' => 'Erreur lors de l\'ajout de l\'éditeur : ' . $e->getMessage()
                ]);
                return;
            }
        }
    
        $this->view->title = 'Ajouter un éditeur';
        $this->view->Display('admin/add_editeur');
    }
}
