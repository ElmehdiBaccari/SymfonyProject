<?php

namespace ademBundle\Controller;

use ademBundle\Entity\Demande;
use ademBundle\Entity\Salle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
class SalleController extends Controller
{
    public function ajouter_SalleAction(Request $request)
    {
        $salle =new Salle();
        $formSalle = $this->createForm('ademBundle\Form\SalleType',$salle);
        $formSalle->handleRequest($request);
        if($formSalle->isSubmitted() && $formSalle->isValid())
        {
            $em = $this->getDoctrine()->getManager();

            $em->persist($salle);
            $em->flush();
            return $this->redirectToRoute('afficher_salle');

        }
        return $this->render('@adem/Salle/ajouter.salle.html.twig', array(
            'formSalle' => $formSalle->createView()
        ));
    }

    public function modifier_SalleAction(Request $request , Salle $salle)
    {
        $editFormsalle = $this->createForm('ademBundle\Form\SalleType',$salle);
        $editFormsalle->handleRequest($request);
        if ($editFormsalle->isSubmitted() && $editFormsalle->isValid())
        {
            $salle->setDateUpdate(new \DateTime('now'));
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('afficher_salle');
        }

        return $this->render('@adem/Salle/modifier.salle.html.twig', array(
            'salle'    => $salle,
            'formsalle'    => $editFormsalle->createView(),
        ));
    }

    public function supprimer_SalleAction($id)
    {
        $salle =new Salle();
        $doctrine= $this->getDoctrine();
        $repository = $doctrine->getRepository(  'ademBundle:Salle');
        $salle = $repository->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($salle);
        $em->flush();
        return $this->forward('ademBundle:Salle:afficher_Salle');
    }

    public function afficher_SalleAction()
    {
        $doctrine= $this->getDoctrine();
        $repository = $doctrine->getRepository('ademBundle:Salle');
        $Salles = $repository->findAll();
        return $this->render('@adem/Salle/afficher.salle.html.twig',
            array(
                'salles'=>$Salles,

            ));
    }


    public function afficherSalleFrontAction(Request $request ,Salle $salle = null )
    {

        $demande =new Demande();
        $demandeForm = $this->createForm('ademBundle\Form\DemandeType',$demande);
        $demandeForm->handleRequest($request);
        /*var_dump($salle);
        die();*/
        if ($demandeForm->isSubmitted() && $demandeForm->isValid())
        {
            $user=$this->getUser();
            $demande->setIduser($user);

            $demande->setIdsalle($salle);
            $demande->setEtat('actif');
            $em = $this->getDoctrine()->getManager();

            $em->persist($demande);
            $em->flush();
            return $this->redirectToRoute('afficher_salle_front');
        }
        $demande =new Demande();
        $demandeForm = $this->createForm('ademBundle\Form\DemandeType',$demande);
        $doctrine= $this->getDoctrine();
        $repository = $doctrine->getRepository('ademBundle:Salle');
        $salles = $repository->findAll();
        return $this->render('@adem/Salle/afficher.salle.front.html.twig',
            array(
                'salle'=>$salles,
                'demandeform'=>$demandeForm->createView(),

            ));
    }

}
