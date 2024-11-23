<?php
namespace Controller\admin;
use Controller\View;

class MainAdmin
{
    protected $view;

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->view = new View();

        // Vérifier si l'utilisateur est connecté, sauf pour la page de login
        if (!$this->isLoginPage() && !$this->isUserLoggedIn()) {
            header('Location: /logchoice');
            exit;
        }

        // Récupérer le nombre de jeux en attente pour la notification
        if ($this->isUserLoggedIn()) {
            $propositionModel = new \Model\admin\proposition();
            $pendingGamesCount = $propositionModel->getPendingGamesCount();
            $this->view->pending_games_count = $pendingGamesCount;
        }

        $this->view->session = $_SESSION;
    }

    protected function isLoginPage()
    {
        $allowedPages = ['/loginadmin', '/logchoice'];
        return in_array($_SERVER['REQUEST_URI'], $allowedPages);
    }

    protected function isUserLoggedIn()
    {
        return isset($_SESSION['login']);
    }

    protected function redirect($url)
    {
        header("Location: $url");
        exit;
    }
}