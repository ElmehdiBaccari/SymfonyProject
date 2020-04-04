<?php

namespace ademBundle\Controller;

use ademBundle\Entity\Collection;
use ademBundle\Entity\Utilisateur;
use Swift_Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Swift_Attachment;

class CollectionController extends Controller
{
    public function ajouterCollectionAction(Request $request)
    {
        $collection=new Collection();
        $formCollection = $this->createForm('ademBundle\Form\CollectionType',$collection);
        $formCollection->handleRequest($request);
        if($formCollection->isSubmitted() && $formCollection->isValid())
        {
            $em = $this->getDoctrine()->getManager();

            $em->persist($collection);
            $em->flush();
            return $this->redirectToRoute('afficher_collection');

        }
        return $this->render('@adem/Collection/ajouter_collection.html.twig', array(
            'formCollection' => $formCollection->createView()
        ));
    }

    public function modifierCollectionAction(Request $request , Collection $collection)
    {
        $editFormCollection = $this->createForm('ademBundle\Form\CollectionType',$collection);
        $editFormCollection->handleRequest($request);
        if ($editFormCollection->isSubmitted() && $editFormCollection->isValid())
        {
            $collection->setDateUpdate(new \DateTime('now'));
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('afficher_collection');
        }

        return $this->render('@adem/Collection/modifier_collection.html.twig', array(
            'Collection'    => $collection,
            'formCollection'    => $editFormCollection->createView(),
        ));
    }

    public function supprimerCollectionAction($num_collection)
    {
        $Collections =new Collection();
        $doctrine= $this->getDoctrine();
        $repository = $doctrine->getRepository(  'ademBundle:Collection');
        $Collections = $repository->find($num_collection);
        $em = $this->getDoctrine()->getManager();
        $em->remove($Collections);
        $em->flush();
        return $this->forward('ademBundle:Collection:afficherCollection');
    }

    public function afficherCollectionAction()
    {

        $doctrine= $this->getDoctrine();
        $repository = $doctrine->getRepository('ademBundle:Collection');
        $Collections = $repository->findAll();
        return $this->render('@adem/Collection/afficher_collection.html.twig',
            array(
                'Collections'=>$Collections,

            ));
    }

    public function afficherCollectionFrontAction()
    {

        $doctrine= $this->getDoctrine();
        $repository = $doctrine->getRepository('ademBundle\Entity\Collection');
        $Collections = $repository->findAll();
        return $this->render('@adem/Collection/afficher_collection_front.html.twig',
            array(
                'Collections'=>$Collections,

            ));
    }

    public function envoyerMailAction()
    {
        //send tiquet at mail
        //$user = $this->getUser();
        $message = (new \Swift_Message())->setSubject('Bonjour Monsieur ')
            ->setFrom('mehdimarcel@gmail.com')
            ->setTo('elmehdi.baccari@esprit.tn')
            ->setBody(         $this->renderView(
            // templates/emails/registration.html.twig
                '@adem/Default/mailing.html.twig'),
                'text/html');
        $this->get('mailer')->send($message);
        return $this->redirectToRoute('afficher_collection');
    }
}
