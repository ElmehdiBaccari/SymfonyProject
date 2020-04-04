<?php

namespace ademBundle\Controller;

use ademBundle\Entity\EmpruntLivre;
use ademBundle\Entity\Livre;
use ademBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Swift_Message;
use Symfony\Component\HttpFoundation\Response;


use Swift_Attachment;

class livreController extends Controller
{
    public function ajouterlivreAction(Request $request)
    {
        $livre =new Livre();
        $formLivre = $this->createForm('ademBundle\Form\LivreType',$livre);
        $formLivre->handleRequest($request);
        if($formLivre->isSubmitted() && $formLivre->isValid())
        {
            $em = $this->getDoctrine()->getManager();

            $em->persist($livre);
            $em->flush();
            return $this->redirectToRoute('afficher_livre');

        }
        return $this->render('@adem/livre/ajouterlivre.html.twig', array(
            'formLivre' => $formLivre->createView()
        ));

    }

    public function afficherLivreAction()
    {

        $doctrine= $this->getDoctrine();
        $repository = $doctrine->getRepository('ademBundle:Livre');
        $Livres = $repository->findAll();
        return $this->render('@adem/livre/afficher_livre.html.twig',
            array(
                'livres'=>$Livres,

            ));
    }

    public function afficherLivreFrontAction()
    {

        $doctrine= $this->getDoctrine();
        $repository = $doctrine->getRepository('ademBundle:Livre');
        $Livres = $repository->findAll();
        return $this->render('@adem/livre/afficher_livre_front.html.twig',
            array(
                'livres'=>$Livres,

            ));
    }

    public function modifierLivreAction(Request $request , livre $livre)
    {
        $editFormlivre = $this->createForm('ademBundle\Form\LivreType',$livre);
        $editFormlivre->handleRequest($request);
        if ($editFormlivre->isSubmitted() && $editFormlivre->isValid())
        {
            $livre->setDateUpdate(new \DateTime('now'));
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('afficher_livre');
        }

        return $this->render('@adem/livre/modifier_livre.html.twig', array(
            'livre'    => $livre,
            'formlivre'    => $editFormlivre->createView(),
        ));
    }

    public function supprimerLivreAction($id_livre)
    {
        $livre =new Livre();
        $doctrine= $this->getDoctrine();
        $repository = $doctrine->getRepository(  'ademBundle:Livre');
        $livre = $repository->find($id_livre);
        $em = $this->getDoctrine()->getManager();
        $em->remove($livre);
        $em->flush();
        return $this->forward('ademBundle:livre:afficherLivre');
    }
    public function statistique_livreAction()
    {

// $user = $this->get('security.token_storage')->getToken()->getUser();
//  $val = $user->getId();
        $em = $this->getDoctrine()->getManager();
//nb1
        $RAW_QUERY = 'SELECT  SUM(qte_livre ) as nb1 from livre where categorie_livre="medecine";';
        $statement = $em->getConnection()->prepare($RAW_QUERY);
// $statement->bindValue(1,$val);
        $statement->execute();
        $nb1 = $statement->fetch();

//nb2

        $RAW_QUERY2 = 'SELECT  SUM(qte_livre ) as nb2 from livre where categorie_livre="informatique";';
        $statement2 = $em->getConnection()->prepare($RAW_QUERY2);
//$statement2->bindValue(1,$val);
        $statement2->execute();
        $nb2 = $statement2->fetch();

//nb3
        $RAW_QUERY3 = 'SELECT  SUM(qte_livre ) as nb3 from livre where categorie_livre="sport";';
        $statement3 = $em->getConnection()->prepare($RAW_QUERY3);
// $statement3->bindValue(1,$val);
        $statement3->execute();
        $nb3 = $statement3->fetch();

//nb4
        $RAW_QUERY4 = 'SELECT  SUM(qte_livre ) as nb4 from livre where categorie_livre="economie";';
        $statement4 = $em->getConnection()->prepare($RAW_QUERY4);
// $statement4->bindValue(1,$val);
        $statement4->execute();
        $nb4 = $statement4->fetch();

//nb5
        $RAW_QUERY5 = 'SELECT  SUM(qte_livre ) as nb5 from livre where categorie_livre="scientifique";';
        $statement5 = $em->getConnection()->prepare($RAW_QUERY5);
// $statement5->bindValue(1,$val);
        $statement5->execute();
        $nb5 = $statement5->fetch();

//nb6
        $RAW_QUERY6 = 'SELECT  SUM(qte_livre ) as nb6 from livre where categorie_livre="art";';
        $statement6 = $em->getConnection()->prepare($RAW_QUERY6);
//$statement6->bindValue(1,$val);
        $statement6->execute();
        $nb6 = $statement6->fetch();

//nb7
       // $RAW_QUERY7 = 'SELECT  COUNT(*) as nb1 from livre where categorie_livre="medecine";';
      //  $statement7= $em->getConnection()->prepare($RAW_QUERY7);
// $statement7->bindValue(1,$val);
      //  $statement7->execute();
        //$nb7 = $statement7->fetch();


        $jan=intval($nb1['nb1']);
        $fev=intval($nb2['nb2']);
        $mars=intval($nb3['nb3']);
        $avril=intval($nb4['nb4']);
        $mai=intval($nb5['nb5']);
        $juin=intval($nb6['nb6']);



        $tab=array();
        $tab[1]=$jan;

        $tab[2]=$fev;
        $tab[3]=$mars;
        $tab[4]=$avril;
        $tab[5]=$mai;
        $tab[6]=$juin;


        return $this->render('@adem/livre/statistique_livre.html.twig',array('tab'=> $tab
        ,'test'=>$nb3));

    }


    public function MailAction($mail)
    {
        //send tiquet at mail
       // $user = $this->getUser();
        $message = (new \Swift_Message())->setSubject('Bonjour Monsieur ' )
            ->setFrom('mehdimarcel@gmail.com')
            ->setTo( $mail)
            ->setBody(         $this->renderView(
            // templates/emails/registration.html.twig
                '@adem/livre/mail_livre.html.twig'
                //['name' => $mail]
            ),
                'text/html');

        $this->get('mailer')->send($message);
        return $this->redirectToRoute('afficher_livre');
    }


    public function pdfAction()
    {
        $em = $this->getDoctrine()->getManager();
        $vars = $em->getRepository(Livre::class)->findAll();
        $html = $this->renderView("@adem/livre/pdfLivre.html.twig", array(
            'livres'  => $vars
        ));
        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="MesLivres.pdf"'
            )
        );
    }

    public function afficherpdfAction()
    {
        $doctrine = $this->getDoctrine();
        $repository = $doctrine->getRepository('ademBundle:Livre');
        $Livres = $repository->findAll();
        return $this->render('@adem/livre/pdfLivre.html.twig',
            array(
                'livres' => $Livres,

            ));
    }


    public function afficherLivreDetailFrontAction(Request $request ,  Livre $livre)
    {
        $emprunt= new EmpruntLivre();
        $repoemrunt= $this->getDoctrine()->getRepository('ademBundle:EmpruntLivre');


        $user=$this->getUser();
        $formemprunt = $this->createForm('ademBundle\Form\EmpruntLivreType',$emprunt);
        $formemprunt->handleRequest($request);

        if($formemprunt->isSubmitted() && $formemprunt->isValid())
        {

            $emprunt->setIdUser($user);
            $emprunt->setIdLivre($livre);
            $em = $this->getDoctrine()->getManager();
            $em->persist($emprunt);
            $em->flush();
            $livre->setQteLivre($livre->getQteLivre()-1);
            $em->persist($livre);
            $em->flush();
            $emprunt = $repoemrunt->getEmprunt($livre->getId_livre(),$user->getId());
            $emp= new EmpruntLivre();
            $formemprunt = $this->createForm('ademBundle\Form\EmpruntLivreType',$emp);
            return $this->render('@adem/livre/afficher_livre_detail.html.twig',
                array(
                    'livre'=>$livre,
                    'formemprunt' => $formemprunt->createView(),
                    'emprunt' => $emprunt,

                ));

        }
        /*$rating=null;
        $repocom = $this->getDoctrine()->getRepository('ademBundle:Commentaire');
        $commentaires = $repocom->findAll();

        $user=$this->getUser();
        if ($user)
        {
            $doctrine = $this->getDoctrine();
            $repository =  $doctrine->getRepository('ademBundle:Rating');

            $rating = $repository->getRating($livre->getId(),$user->getId());
        }
        $rate =new Rating();
        $com =new Commentaire();
        $formrate = $this->createForm('ademBundle\Form\RatingType',$rate);
        $formrate->handleRequest($request);
        $formcom = $this->createForm('ademBundle\Form\CommentaireType',$com);
        $formcom->handleRequest($request);
        $rate->setIdlivre($livre);
        $rate->setIdUser($user);
        if($user)
            $com->setIdUser($user->getId());
        $com->setIdlivre($livre->getId());
        $com->setCreatedat(new \DateTime('now'));
        if($formrate->isSubmitted() && $formrate->isValid())
        {
            $em = $this->getDoctrine()->getManager();

            $em->persist($rate);
            $em->flush();
            $rating = $repository->getRating($livre->getId(),$user->getId());
            return $this->render('@adem/livre/livre_show.html.twig',
                array(
                    'livre'=>$livre,
                    'formrate' => $formrate->createView(),
                    'rating' => $rating,
                    'formcom' => $formcom->createView(),
                    'commentaires' => $commentaires,
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
            $rating = $repository->getRating($livre->getId(),$user->getId());
            return $this->render('@adem/livre/livre_show.html.twig',
                array(
                    'livre'=>$livre,
                    'formrate' => $formrate->createView(),
                    'rating' => $rating,
                    'formcom' => $formcom->createView(),
                    'commentaires' => $commentaires,
                ));

        }
*/      if ($user)
        $emprunt = $repoemrunt->getEmprunt($livre->getId_livre(),$user->getId());

        return $this->render('@adem/livre/afficher_livre_detail.html.twig',
            array(
                'livre'=>$livre,
                'formemprunt' => $formemprunt->createView(),
                'emprunt' => $emprunt,
            ));

    }

    public function accueilAction()
    {
        return $this->render('@adem/Default/accueil.html.twig');

    }
}
