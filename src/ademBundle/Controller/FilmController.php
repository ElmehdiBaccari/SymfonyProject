<?php

namespace ademBundle\Controller;

use ademBundle\Entity\Commentaire;
use ademBundle\Entity\Film;
use ademBundle\Entity\Rating;
use ademBundle\Entity\User;
use ademBundle\Entity\Utilisateur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class FilmController extends Controller
{
    public function ajouterFilmAction(Request $request)
    {
        $film =new Film();
        $formfilm = $this->createForm('ademBundle\Form\FilmType',$film);
        $formfilm->handleRequest($request);
        if($formfilm->isSubmitted() && $formfilm->isValid())
        {
            $em = $this->getDoctrine()->getManager();

            $em->persist($film);
            $em->flush();
            return $this->redirectToRoute('afficher_film');

        }
        return $this->render('@adem/Film/ajouter_film.html.twig', array(
            'formfilm' => $formfilm->createView()
        ));
    }

    public function afficherFilmAction()
    {

        $doctrine= $this->getDoctrine();
        $repository = $doctrine->getRepository('ademBundle:Film');
        $films = $repository->findAll();
        return $this->render('@adem/Film/afficher_film.html.twig',
            array(
                'films'=>$films,

            ));
    }

    public function afficherFilmFrontAction()
    {

        $doctrine= $this->getDoctrine();
        $repository = $doctrine->getRepository('ademBundle:Film');
        $films = $repository->findAll();
        return $this->render('@adem/Film/afficher_film_front.html.twig',
            array(
                'films'=>$films,


            ));
    }
    public function afficherFilmDetailFrontAction(Request $request , Film $film)
    {



        $doctrine= $this->getDoctrine();
        $repository = $doctrine->getRepository('ademBundle:Realisation');
        $realisation = $repository->getRealisation();
        $rating=null;
        $repocom = $this->getDoctrine()->getRepository('ademBundle:Commentaire');
        $commentaires = $repocom->findAll();

        $user=$this->getUser();
        if ($user)
        {
            $doctrine = $this->getDoctrine();
        $repository =  $doctrine->getRepository('ademBundle:Rating');

        $rating = $repository->getRating($film->getId(),$user->getId());
        }
        $rate =new Rating();
        $com =new Commentaire();
        $formrate = $this->createForm('ademBundle\Form\RatingType',$rate);
        $formrate->handleRequest($request);
        $formcom = $this->createForm('ademBundle\Form\CommentaireType',$com);
        $formcom->handleRequest($request);
        $rate->setIdFilm($film);
        $rate->setIdUser($user);
        if($user)
        $com->setIdUser($user->getId());
        $com->setIdFilm($film->getId());
        $com->setCreatedat(new \DateTime('now'));
        if($formrate->isSubmitted() && $formrate->isValid())
        {
            $em = $this->getDoctrine()->getManager();

            $em->persist($rate);
            $em->flush();
            $rating = $repository->getRating($film->getId(),$user->getId());
            return $this->render('@adem/Film/film_show.html.twig',
                array(
                    'film'=>$film,
                    'formrate' => $formrate->createView(),
                    'rating' => $rating,
                    'formcom' => $formcom->createView(),
                    'commentaires' => $commentaires,
                    'realisations'=>$realisation,
                ));

        }
        if($formcom->isSubmitted() && $formcom->isValid())
        {
            $em = $this->getDoctrine()->getManager();

            $em->persist($com);
            $em->flush();
            $commentaires = $repocom->findAll();
            $com =new Commentaire();
            $formcom = $this->createForm('ademBundle\Form\CommentaireType',$com);
            $rating = $repository->getRating($film->getId(),$user->getId());
            return $this->render('@adem/Film/film_show.html.twig',
                array(
                    'film'=>$film,
                    'formrate' => $formrate->createView(),
                    'rating' => $rating,
                    'formcom' => $formcom->createView(),
                    'commentaires' => $commentaires,
                    'realisations'=>$realisation,
                ));

        }


        return $this->render('@adem/Film/film_show.html.twig',
            array(
                'film'=>$film,
                'formrate' => $formrate->createView(),
                'rating' => $rating,
                'formcom' => $formcom->createView(),
                'commentaires' => $commentaires,
                'realisations'=>$realisation,
            ));
    }



    public function modifierFilmAction(Request $request , Film $film)
    {
        $editFormfilm = $this->createForm('ademBundle\Form\FilmType',$film);
        $editFormfilm->handleRequest($request);
        if ($editFormfilm->isSubmitted() && $editFormfilm->isValid())
        {
            $film->setDateUpdate(new \DateTime('now'));
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('afficher_film');
        }

        return $this->render('@adem/Film/modifier_film.html.twig', array(
            'film'    => $film,
            'Formfilm'    => $editFormfilm->createView(),
        ));
    }

    public function supprimerFilmAction($id)
    {
        $film =new Film();
        $doctrine= $this->getDoctrine();
        $repository = $doctrine->getRepository(  'ademBundle:Film');
        $film = $repository->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($film);
        $em->flush();
        return $this->forward('ademBundle:Film:afficherFilm');
    }



    public function supprimerCommentaireAction($id)
    {
        $com =new Commentaire();
        $doctrine= $this->getDoctrine();
        $repository = $doctrine->getRepository(  'ademBundle:Commentaire');
        $com = $repository->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($com);
        $em->flush();
        return $this->redirectToRoute('afficher_film_detail', [
            'id'  => $com->getIdFilm(),
        ]);
    }

}
