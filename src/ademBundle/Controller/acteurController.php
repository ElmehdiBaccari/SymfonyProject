<?php

namespace ademBundle\Controller;

use ademBundle\Entity\Acteur;
use ademBundle\Entity\Film;
use ademBundle\Entity\Realisation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
class acteurController extends Controller
{
    public function ajouter_acteurAction(Request $request)
    {
        $acteur =new Acteur();
        $formacteur = $this->createForm('ademBundle\Form\ActeurType',$acteur);
        $formacteur->handleRequest($request);
        if($formacteur->isSubmitted() && $formacteur->isValid())
        {
            $em = $this->getDoctrine()->getManager();

            $em->persist($acteur);
            $em->flush();
            return $this->redirectToRoute('afficher_acteur');

        }
        return $this->render('@adem/acteur/ajouter.acteur.html.twig', array(
            'formacteur' => $formacteur->createView()
        ));
    }

    public function modifier_acteurAction(Request $request , Acteur $acteur)
    {
        $editFormacteur = $this->createForm('ademBundle\Form\ActeurType',$acteur);
        $editFormacteur->handleRequest($request);
        if ($editFormacteur->isSubmitted() && $editFormacteur->isValid())
        {
            $acteur->setDateUpdate(new \DateTime('now'));
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('afficher_acteur');
        }

        return $this->render('@adem/acteur/modifier.acteur.html.twig', array(
            'acteur'    => $acteur,
            'formacteur'    => $editFormacteur->createView(),
        ));
    }

    public function supprimer_acteurAction($id)
    {
        $acteur =new Acteur();
        $doctrine= $this->getDoctrine();
        $repository = $doctrine->getRepository(  'ademBundle:Acteur');
        $acteur = $repository->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($acteur);
        $em->flush();
        return $this->forward('ademBundle:acteur:afficher_acteur');
    }

    public function afficher_acteurAction()
    {
        $doctrine= $this->getDoctrine();
        $repository = $doctrine->getRepository('ademBundle:Acteur');
        $acteur = $repository->findAll();
        return $this->render('@adem/acteur/afficher.acteur.html.twig',
            array(
                'acteur'=>$acteur,

            ));
    }

    public function ajouter_realisationAction(Request $request,Acteur $acteur)
    {
        $realisation =new Realisation();
        $formrealisation = $this->createForm('ademBundle\Form\RealisationType',$realisation);
        $formrealisation->handleRequest($request);
        if($formrealisation->isSubmitted() && $formrealisation->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $realisation->setIdacteur($acteur);
            $em->persist($realisation);
            $em->flush();
            return $this->redirectToRoute('afficher_acteur');

        }
        return $this->render('@adem/acteur/ajouter.realisation.html.twig', array(
            'formrealisation' => $formrealisation->createView()
        ));
    }

    public function afficher_realisationAction()
    {
        $doctrine= $this->getDoctrine();
        $repository = $doctrine->getRepository('ademBundle:Realisation');
        $realisation = $repository->getRealisation();
        return $this->render('ademBundle:acteur:afficher.realisation.html.twig',
            array(
                'realisations'=>$realisation,

            ));
    }

    public function supprimer_realisationAction($id)
    {

        $doctrine= $this->getDoctrine();
        $repository = $doctrine->getRepository(  'ademBundle:Realisation');
        $realisation = $repository->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($realisation);
        $em->flush();
        return $this->forward('ademBundle:acteur:afficher_realisation');
    }

}
