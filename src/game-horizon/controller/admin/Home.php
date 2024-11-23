<?php
namespace Controller\admin;

class Home extends MainAdmin
{
    function index($vars=[])
    {
        error_log("Méthode index du contrôleur Home appelée");
        $this->view->title = 'Accueil';
        $this->view->Display('admin/index');
    }
    public function accueil()
    {
        $userModel = new \Model\User();
        $editeurModel = new \Model\admin\editeur();
        $CategoryModel = new \Model\Category();
        $totalUsers = $userModel->getTotalUsersCount();

        
       
        $bannedUsers = $userModel->getBannedUsersCount();

        $totalEditeurs = $editeurModel->getTotalEditeurcount();
        $totalCategory = $CategoryModel->getTotalCategorycount();

        $this->view->title = 'Tableau de bord administrateur';
        $this->view->Display('admin/index', [
            'total_users' => $totalUsers,
            'banned_users' => $bannedUsers,
            'total_editeurs' => $totalEditeurs,
            'total_category' => $totalCategory,
        ]);
    }
}
