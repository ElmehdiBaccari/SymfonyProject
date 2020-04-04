<?php

namespace ademBundle\Controller;

use ademBundle\Entity\Demande;
use ademBundle\Entity\Salle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DemandeController extends Controller
{
    public function AjouterDemandeAction(Request $request ,Salle $salle )
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
            $demande->setEtat('en cours');
            $em = $this->getDoctrine()->getManager();

            $em->persist($demande);
            $em->flush();
            return $this->redirectToRoute('afficher_salle_front');
        }
        $demande =new Demande();
        $demandeForm = $this->createForm('ademBundle\Form\DemandeType',$demande);

        return $this->render('@adem/Demande/ajouter_demande.html.twig',
            array(
                'demandeform'=>$demandeForm->createView(),
                'salle'=>$salle,

            ));



    }

    public function GererDemandeAction(Demande $demande,$token)
    {

        if($token=='Accepte')
        {
            $demande->setEtat('Accepté');
        }
        else
        {
            $demande->setEtat('Refusé');
        }
        $em = $this->getDoctrine()->getManager();

        $em->persist($demande);
        $em->flush();
        return $this->redirectToRoute('_afficher_demande');
    }

    public function AfficherDemandeAction()
    {


        $doctrine= $this->getDoctrine();
        $repository = $doctrine->getRepository('ademBundle:Demande');
        $demande = $repository->getDemande();
        return $this->render('ademBundle:Demande:afficher_demande.html.twig', array(
            'demande'=>$demande,
        ));
    }

    public function AfficherDemandeFrontAction()
    {
        return $this->render('ademBundle:Demande:afficher_demande.html.twig', array(
            // ...
        ));
    }

}
