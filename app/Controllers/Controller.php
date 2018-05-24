<?php
namespace Auth\Controllers;



class Controller
{
    protected $twig;

    protected function twigRender($templates, $values=array())
    {
        $loader = new \Twig_Loader_Filesystem(PATH.'/app/view');
        $this->twig = new \Twig_Environment($loader);

        echo $this->twig->render($templates, $values);
    }
}