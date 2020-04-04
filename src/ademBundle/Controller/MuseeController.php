<?php

namespace ademBundle\Controller;

use ademBundle\Entity\Collection;
use ademBundle\Entity\Musee;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MuseeController extends Controller
{

    public function ajouter_visiteAction(Request $request)
    {

        $musee=new Musee();
        $user=$this->getUser();
        $formMusee = $this->createForm('ademBundle\Form\MuseeType',$musee);
        $formMusee->handleRequest($request);
        if($formMusee->isSubmitted() && $formMusee->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $musee->setNom($user->getPrenom());
            $musee->setPrenom($user->getUsername());
            $musee->setEmail($user->getEmail());
            $musee->setTelephone($user->getTelephone());
            $musee->setFee($musee->getPersonne()*15);
            $em->persist($musee);
            $em->flush();
            return $this->redirectToRoute('ajouter_visite');

        }
        return $this->render('@adem/Musee/ajouter.visite.html.twig ', array(
            'formMusee' => $formMusee->createView(),
            'user'=>$user

        ));
    }

    public function modifier_visiteAction(Request $request , Musee $musee)
    {
        $editFormMusee = $this->createForm('ademBundle\Form\MuseeType',$musee);
        $editFormMusee->handleRequest($request);
        if ($editFormMusee->isSubmitted() && $editFormMusee->isValid())
        {
            $musee->setDateUpdate(new \DateTime('now'));
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('afficher_visite');
        }

        return $this->render('@adem/Musee/modifier.visite.html.twig', array(
            'musee'    => $musee,
            'formMusee'    => $editFormMusee->createView(),
        ));
    }

    public function supprimer_visiteAction($id)
    {
        $musee=new Musee();
        $doctrine= $this->getDoctrine();
        $repository = $doctrine->getRepository(  'ademBundle:Musee');
        $musee = $repository->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($musee);
        $em->flush();
        return $this->forward('ademBundle:Musee:afficher_visite');
    }

    public function afficher_visiteAction()
    {
        $doctrine= $this->getDoctrine();
        $repository = $doctrine->getRepository('ademBundle:Musee');
        $musee = $repository->findAll();
        return $this->render('@adem/Musee/afficher.visite.html.twig',
            array(
                'musee'=>$musee,

            ));
    }
    public function sendMailAction(Request $request){

        $text="Welcome to our Museum!!
        Hi ".$request->get("nom"). " we welcome u to our Museum at ".$request->get("date")."  have a good day
        Thanks!";
        $message = (new \Swift_Message())->setSubject('Bonjour Monsieur ')
            ->setFrom('mehdimarcel@gmail.com')
            ->setTo($request->get("email"))
            ->setBody($text);
        $this->get('mailer')->send($message);
       // dump($request->get("date"));
        //die();
        return $this->redirectToRoute('afficher_visite');
    }

}
