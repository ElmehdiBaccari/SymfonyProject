<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SecurityControllerController extends Controller
{
    /**
     * @Route("/Add_user")
     */
    public function AddAction()
    {
        return $this->render('AppBundle:SecurityController:add.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/home")
     */
    public function redirectAction()
    {
        $authChecker = $this->container->get('security.authorization_checker');
        if ($authChecker->isGranted('ROLE_ADMIN'))
        {
            return $this->forward('ademBundle:User:list');
        }
        else if($authChecker->isGranted('ROLE_USER'))
        {
            return $this->render('@adem/Default/front.html.twig');
        }
        else
        {
            return $this->redirectToRoute('fos_user_security_login');
        }

    }

}
