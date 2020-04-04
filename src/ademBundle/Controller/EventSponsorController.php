<?php

namespace ademBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EventSponsorController extends Controller
{
    public function ajouter_evenSponsorAction()
    {
        return $this->render('ademBundle:EventSponsor:ajouter.even_sponsor.html.twig', array(
            // ...
        ));
    }

    public function modifier_eventSponsorAction()
    {
        return $this->render('ademBundle:EventSponsor:modifier.event_sponsor.html.twig', array(
            // ...
        ));
    }

    public function supprimer_eventSponsorAction()
    {
        return $this->render('ademBundle:EventSponsor:supprimer.event_sponsor.html.twig', array(
            // ...
        ));
    }

    public function afficher_eventSponsorAction()
    {
        return $this->render('ademBundle:EventSponsor:afficher.event_sponsor.html.twig', array(
            // ...
        ));
    }

}
