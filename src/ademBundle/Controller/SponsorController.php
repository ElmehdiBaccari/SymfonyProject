<?php

namespace ademBundle\Controller;

use ademBundle\Entity\Evenement;
use ademBundle\Entity\Eventsponsor;
use ademBundle\Entity\Sponsor;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SponsorController extends Controller
{
    public function ajouter_SponsorAction(Request $request)
    {
        $Sponsors=new Sponsor();
        $formSponsor = $this->createForm('ademBundle\Form\SponsorType',$Sponsors);
        $formSponsor->handleRequest($request);
        if($formSponsor->isSubmitted() && $formSponsor->isValid())
        {
            $em = $this->getDoctrine()->getManager();

            $em->persist($Sponsors);
            $em->flush();
            return $this->redirectToRoute('ajouter_sponsor');

        }
        return $this->render('@adem/Sponsor/ajouter.sponsor.html.twig', array(
            'formSponsor' => $formSponsor->createView()
        ));
    }

    public function modifier_SponsorAction(Request $request , Sponsor $Sponsors)
    {
        $editFormSponsor = $this->createForm('ademBundle\Form\SponsorType',$Sponsors);
        $editFormSponsor->handleRequest($request);
        if ($editFormSponsor->isSubmitted() && $editFormSponsor->isValid())
        {
            $Sponsors->setDateUpdate(new \DateTime('now'));
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('afficher_sponsor');
        }

        return $this->render('@adem/Sponsor/modifier.sponsor.html.twig', array(
            'Sponsor'    => $Sponsors,
            'formSponsor'    => $editFormSponsor->createView(),
        ));
    }

    public function supprimer_SponsorAction($idsponsors)
    {
        $Sponsors=new Sponsor();
        $doctrine= $this->getDoctrine();
        $repository = $doctrine->getRepository(  'ademBundle:Sponsor');
        $Sponsors = $repository->find($idsponsors);
        $em = $this->getDoctrine()->getManager();
        $em->remove($Sponsors);
        $em->flush();
        return $this->forward('ademBundle:Sponsor:afficher_Sponsor');
    }

    public function afficher_SponsorAction()
    {
        $doctrine= $this->getDoctrine();
        $repository = $doctrine->getRepository('ademBundle:Sponsor');
        $Sponsors = $repository->findAll();

        return $this->render('@adem/Sponsor/afficher.sponsor.html.twig',
            array(
                'Sponsor'=>$Sponsors,
            ));
    }

    public function ajouter_SponsorisationAction(Request $request , Sponsor $sponsor )
    {
        $sponsorisation =new Eventsponsor();
        $formsponsorisation = $this->createForm('ademBundle\Form\EventsponsorType',$sponsorisation);
        $formsponsorisation->handleRequest($request);
        if($formsponsorisation->isSubmitted() && $formsponsorisation->isValid())
        {


            $event = $sponsorisation->getIdEvent();
            $em = $this->getDoctrine()->getManager();
            $sponsorisation->setIdSponsors($sponsor);
            $sponsorisation->setIdevenement($event);
            $em->persist($sponsorisation);
            $em->flush();
            return $this->redirectToRoute('afficher_sponsor');

        }
        return $this->render('@adem/Sponsor/ajouter_sponsorisation.html.twig', array(
            'formsponsorisation' => $formsponsorisation->createView()
        ));
    }

    public function afficher_SponsorisationAction()
    {
        $doctrine= $this->getDoctrine();
        $repository = $doctrine->getRepository('ademBundle:Eventsponsor');
        $sponsorisation = $repository->getSponsorisation();
        return $this->render('@adem/Sponsor/afficher_sponsorisation.html.twig',
            array(
                'sponsorisation'=>$sponsorisation,

            ));
    }

    public function supprimer_SponsorisationAction($id)
    {

        $doctrine= $this->getDoctrine();
        $repository = $doctrine->getRepository(  'ademBundle:Eventsponsor');
        $sponsorisation = $repository->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($sponsorisation);
        $em->flush();
        return $this->forward('ademBundle:Sponsor:afficher_Sponsorisation');
    }



}
