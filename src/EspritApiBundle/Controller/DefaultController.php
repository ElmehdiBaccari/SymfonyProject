<?php

namespace EspritApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EspritApiBundle:Default:index.html.twig');
    }
}
