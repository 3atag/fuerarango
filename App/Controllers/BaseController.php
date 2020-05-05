<?php

namespace App\Controllers;

require_once '../config/parameters.php';

use Laminas\Diactoros\Response\HtmlResponse;


class BaseController
{
    

    protected $templateEngine;

       public function __construct()
    {

        $loader = new \Twig\Loader\FilesystemLoader('../views/');

        $this->templateEngine = new \Twig\Environment($loader, [
            'cache' => false,
            'debug' => true
        ]);
    }

    public function renderHTML($fileName, $data = [])
    {
        return new HtmlResponse ($this->templateEngine->render($fileName, $data));
    }
    
}
