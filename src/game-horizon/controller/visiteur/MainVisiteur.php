<?php
namespace Controller\visiteur;

class MainVisiteur
{
    static public $View;
    
    static function Init()
    {
        self::$View = new \Controller\View('twig');

        $menu = new \Model\Menu();
        $menus = $menu->getMenu();

        $filteredMenus = array_filter($menus, function($item) {
            if ($item['visible'] === 'always') {
                return true;
            }
            if ($item['visible'] === 'logged_in') {
                return isset($_SESSION['pseudo_utilisateur']);
            }
            return false;
        });

        self::$View->menus = array_values($filteredMenus);
        self::$View->copyright = COPYRIGHT;
    }
    
    public function __construct()
    {
        self::Init();
    }

    protected function isUserLoggedIn()
    {
        return isset($_SESSION['pseudo_utilisateur']);
    }

    protected function getUserSession()
    {
        if($this->isUserLoggedIn()){
            return $_SESSION;
        }
        return null;
    }
}