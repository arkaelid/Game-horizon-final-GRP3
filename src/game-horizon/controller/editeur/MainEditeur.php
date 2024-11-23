<?php 
namespace Controller\editeur;
use \Model\MenuEditeur;

use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class MainEditeur {

   static public $view;
   static public $mail;
   static public $logger;

   static public function init() {
    self::$view = new \Controller\View('twig');
    $menu= new MenuEditeur();
        $menus = $menu->getMenu();
        self::$view->menus = $menus;
        self::$logger = new Logger('gh_log');
        self::$logger->pushHandler(new StreamHandler(DIR_BASE.'private/logs/gh.log',Level::Warning));
   }

    public function __construct()
    {
        self::Init();
    }
}

?>