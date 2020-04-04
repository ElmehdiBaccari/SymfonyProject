<?php

namespace ademBundle\Controller;

use ademBundle\Entity\Utilisateur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    public function listAction()
    {
        $User =new Utilisateur();
        $form= $this->createForm('ademBundle\Form\UtilisateurType',$User,array('action'=>$this->generateUrl('_add')));
        $doctrine= $this->getDoctrine();
        $repository = $doctrine->getRepository('ademBundle:Utilisateur');
        $personnes = $repository->findAll();
        return $this->render('@adem/User/list.html.twig',
            array(
                'personnes'=>$personnes,
                'form'=>$form->createView()
        ));
    }

    public function AddAction(Request $request)
    {
        $User =new Utilisateur();
        $formUser = $this->createForm('ademBundle\Form\UtilisateurType',$User);
        $formUser->handleRequest($request);
        if($formUser->isSubmitted() && $formUser->isValid())
        {
            $em = $this->getDoctrine()->getManager();

            $em->persist($User);
            $em->flush();
            return $this->redirectToRoute('list');

        }
        return $this->render('@adem/User/add.html.twig', array(
            'formUser' => $formUser->createView()
        ));

    }

    public function DeleteAction($id)
    {
        $User =new Utilisateur();
        $doctrine= $this->getDoctrine();
        $repository = $doctrine->getRepository(  'ademBundle:Utilisateur');
        $User = $repository->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($User);
        $em->flush();
        return $this->forward('ademBundle:User:list');
    }

    public function UpdateAction(Request $request , Utilisateur $utilisateur)
    {
        $editFormuser = $this->createForm('ademBundle\Form\UtilisateurType',$utilisateur);
        $editFormuser->handleRequest($request);
        if ($editFormuser->isSubmitted() && $editFormuser->isValid())
        {
            $utilisateur->setDateUpdate(new \DateTime('now'));
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('list');
        }

        return $this->render('@adem/User/update.html.twig', array(
            'user'    => $utilisateur,
            'formuser'    => $editFormuser->createView(),
        ));
    }




}
