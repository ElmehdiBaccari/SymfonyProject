<?php

namespace ademBundle\Controller;


use ademBundle\Entity\Evenement;
use ademBundle\Entity\EvenementUser;
use FOS\UserBundle\Event\UserEvent;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class EvenementController extends Controller
{
    public function ajouterEvenementAction(Request $request)
    {
        $Evenements=new Evenement();
        $formEvenement = $this->createForm('ademBundle\Form\EvenementType',$Evenements);
        $formEvenement->handleRequest($request);
        if($formEvenement->isSubmitted() && $formEvenement->isValid())
        {
            $em = $this->getDoctrine()->getManager();

            $em->persist($Evenements);
            $em->flush();
            return $this->redirectToRoute('afficher_evenement');

        }
        return $this->render('@adem/Evenement/ajouter_evenement.html.twig', array(
            'formEvenement' => $formEvenement->createView()
        ));
    }

    public function modifierEvenementAction(Request $request , Evenement $Evenements)
    {
        $editFormEvenement = $this->createForm('ademBundle\Form\EvenementType',$Evenements);
        $editFormEvenement->handleRequest($request);
        if ($editFormEvenement->isSubmitted() && $editFormEvenement->isValid())
        {
            $Evenements->setDateUpdate(new \DateTime('now'));
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('afficher_evenement');
        }

        return $this->render('@adem/Evenement/modifier_evenement.html.twig', array(
            'Evenement'    => $Evenements,
            'formEvenement'    => $editFormEvenement->createView(),
        ));
    }

    public function supprimerEvenementAction($idevent)
    {
        $Evenements =new Evenement();
        $doctrine= $this->getDoctrine();
        $repository = $doctrine->getRepository(  'ademBundle:Evenement');
        $Evenements = $repository->find($idevent);
        $em = $this->getDoctrine()->getManager();
        $em->remove($Evenements);
        $em->flush();
        return $this->forward('ademBundle:Evenement:afficherEvenement');
    }

    public function afficherEvenementAction()
    {
        $doctrine= $this->getDoctrine();
        $repository = $doctrine->getRepository('ademBundle:Evenement');
        $evenements = $repository->findAll();
        return $this->render('@adem/Evenement/afficher_evenement.html.twig',
            array(
                'evenements'=>$evenements,

            ));
    }

    public function afficherEvenementFrontAction()
    {

        $doctrine= $this->getDoctrine();
        $repository = $doctrine->getRepository('ademBundle:Evenement');
        $evenements = $repository->findAll();
        return $this->render('@adem/Evenement/afficher_evenement_front.html.twig',
            array(
                'evenements'=>$evenements,


            ));
    }


    public function afficherEvenementDetailAction(Request $request ,  Evenement $evenement)
    {
       /* $evenement= new Evenement();*/
//        $evenement= $this->getDoctrine()->getRepository('ademBundle:Evenement');
        $doctrine= $this->getDoctrine();
        $repository = $doctrine->getRepository('ademBundle:Eventsponsor');
        $sponsorisation = $repository->getSponsorisation();

        $doctrine= $this->getDoctrine();
        $repository = $doctrine->getRepository(  'ademBundle:EvenementUser');
        $participation = $repository->getParticipation($evenement->idevent ,$this->getUser());

        $openWeather = $this->get('dwr_open_weather');
        $weather = $openWeather->setType('Weather')->getByCityName('Gouvernorat de Tunis');



        return $this->render('@adem/Evenement/afficher_evenement_detail.html.twig',
            array(
                'evenement'=>$evenement,
                'sponsorisation'=>$sponsorisation,
                'participation'=>$participation,
                'weather'=>$weather,

            ));

    }

    public function ajouter_participationAction(  Evenement $event )
    {
        $particapation =new EvenementUser();

            $em = $this->getDoctrine()->getManager();
            $particapation->setIdevenement($event);
            $particapation->setIduser($this->getUser());
            $em->persist($particapation);
            $em->flush();
            return $this->redirectToRoute('afficherEvenementDetail', [
                'id'  => $event->getIdevent(),
            ]);



    }


    public function supprimer_participationAction($id)
    {

        $doctrine= $this->getDoctrine();
        $repository = $doctrine->getRepository(  'ademBundle:EvenementUser');
        $participation = $repository->getParticipation($id ,$this->getUser());


        $em = $this->getDoctrine()->getManager();
        $em->remove($participation[0]);
        $em->flush();
        return $this->redirectToRoute('afficherEvenementDetail', [
            'id'  => $id,
        ]);
    }







}
