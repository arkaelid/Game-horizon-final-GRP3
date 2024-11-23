<?php
namespace Controller;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class View
{
    private $twig;
    private $data = [];

    static private $template_params = [];
    static private $template_engine_object = null;
    static private $template_engine = 'twig';

    function __construct($engine=null)
    {   
        if(!is_null($engine))
        {
            self::$template_engine = $engine;
        }

        $loader = new \Twig\Loader\FilesystemLoader(DIR_VIEW);

        self::$template_engine_object = new \Twig\Environment($loader, [
            // 'cache' => DIR_VIEW . 'cache/',
            'debug'=>true
        ]);
        $this->twig = self::$template_engine_object;

        self::$template_engine_object->addExtension(new \Twig\Extension\DebugExtension());

        $filter = new \Twig\TwigFilter('truncate', function ($string,$length=10) {
            $len = strlen($string);
            $return = ($len>$length) ? substr($string,0,$length)." ...":$string;
            return $return;
        });
        
        self::$template_engine_object->addFilter($filter);
    }

    public function Display($template, $additionalData = [])
    {
        $data = array_merge($this->data, $additionalData, [
            'session' => $_SESSION ?? [], // Utilisation de l'opérateur de fusion null
            'title' => $this->data['title'] ?? 'Game Horizon'
        ]);
        echo $this->twig->render($template . '.twig', $data);
    }

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function __get($name)
    {
        return $this->data[$name] ?? null;
    }
}
