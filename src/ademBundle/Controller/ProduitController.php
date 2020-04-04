<?php

namespace ademBundle\Controller;


use ademBundle\Entity\Produit;
use ademBundle\Entity\Utilisateur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class ProduitController extends Controller
{
    public function pdfAction()
    {
        $em = $this->getDoctrine()->getManager();
        $vars = $em->getRepository(Produit::class)->findAll();
        $html = $this->renderView("@adem/Default/pdfproduit.html.twig", array(
            'Produits'  => $vars
        ));
        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="MesProduits.pdf"'
            )
        );
    }

    public function afficherpdfAction()
    {
        $doctrine = $this->getDoctrine();
        $repository = $doctrine->getRepository('ademBundle:Produit');
        $Produits = $repository->findAll();
        return $this->render('@adem/Default/pdfproduit.html.twig',
            array(
                'Produits' => $Produits,

            ));
    }

    public function afficherProduitFrontAction()
    {

        $doctrine= $this->getDoctrine();
        $repository = $doctrine->getRepository('ademBundle\Entity\Produit');
        $Produits = $repository->findAll();
        return $this->render('@adem/Produit/afficher_produit_front.html.twig',
            array(
                'Produits'=>$Produits,

            ));
    }


    public function afficherProduitAction()
    {
        $doctrine= $this->getDoctrine();
        $repository = $doctrine->getRepository('ademBundle:Produit');
        $Produits = $repository->findAll();
        return $this->render('@adem/Produit/afficher_produit.html.twig',
            array(
                'Produits'=>$Produits,

            ));
    }

    public function ajouterProduitAction(Request $request)
    {
        $Produits=new Produit();
        $formProduit = $this->createForm('ademBundle\Form\ProduitType',$Produits);
        $formProduit->handleRequest($request);
        if($formProduit->isSubmitted() && $formProduit->isValid())
        {
            $em = $this->getDoctrine()->getManager();

            $em->persist($Produits);
            $em->flush();
            return $this->redirectToRoute('afficher_produit');

        }
        return $this->render('@adem/Produit/ajouter_produit.html.twig', array(
            'formProduit' => $formProduit->createView()
        ));
    }

    public function supprimerProduitAction($id_produit)
    {
        $Produits =new Produit();
        $doctrine= $this->getDoctrine();
        $repository = $doctrine->getRepository(  'ademBundle:Produit');
        $Produits = $repository->find($id_produit);
        $em = $this->getDoctrine()->getManager();
        $em->remove($Produits);
        $em->flush();
        return $this->forward('ademBundle:Produit:afficherProduit');
    }

    public function modifierProduitAction(Request $request , Produit $Produits)
    {
        $editFormProduit = $this->createForm('ademBundle\Form\ProduitType',$Produits);
        $editFormProduit->handleRequest($request);
        if ($editFormProduit->isSubmitted() && $editFormProduit->isValid())
        {
            $Produits->setDateUpdate(new \DateTime('now'));
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('afficher_produit');
        }

        return $this->render('@adem/Produit/modifier_produit.html.twig', array(
            'Produit'    => $Produits,
            'formProduit'    => $editFormProduit->createView(),
        ));
    }

    public function statistique_produitAction()
    {

       // $user = $this->get('security.token_storage')->getToken()->getUser();
       // $val = $user->getId();
        $em = $this->getDoctrine()->getManager();
        //nb1




        $RAW_QUERY = 'SELECT  SUM(quantite ) as nb1 from Produit where type_produit ="Copie";';
        $statement = $em->getConnection()->prepare($RAW_QUERY);
       // $statement->bindValue(1,$val);
        $statement->execute();
        $nb1 = $statement->fetch();

        //nb2

        $RAW_QUERY2 = 'SELECT  SUM(quantite ) as nb2 from Produit where type_produit ="Souvenir";';
        $statement2 = $em->getConnection()->prepare($RAW_QUERY2);
       // $statement2->bindValue(1,$val);
        $statement2->execute();
        $nb2 = $statement2->fetch();

        //nb3
        $RAW_QUERY3 = 'SELECT  SUM(quantite ) as nb3 from Produit where type_produit ="Painture";';
        $statement3 = $em->getConnection()->prepare($RAW_QUERY3);
       // $statement3->bindValue(1,$val);
        $statement3->execute();
        $nb3 = $statement3->fetch();

        //nb4
        $RAW_QUERY4 = 'SELECT  SUM(quantite ) as nb4 from Produit where type_produit ="Commerciale";';
        $statement4 = $em->getConnection()->prepare($RAW_QUERY4);
       // $statement4->bindValue(1,$val);
        $statement4->execute();
        $nb4 = $statement4->fetch();



        $jan=intval($nb1['nb1']);
        $fev=intval($nb2['nb2']);
        $mars=intval($nb3['nb3']);
        $avril=intval($nb4['nb4']);


        $tab=array();

        $tab[1]=$jan;
        $tab[2]=$fev;
        $tab[3]=$mars;
        $tab[4]=$avril;


        return $this->render('@adem/Produit/statistique_produit.html.twig',array('tab'=> $tab
        ,'test'=>$nb3));

    }


    public function rechercheAction(Request $request){

        $em = $this->getDoctrine()->getManager();
        $Produits  = $em->getRepository(Produit::class)->findAll();
        if($request->isMethod('POST')) {
            $nomProduit=$request->get('nomProduit');
           // $prixProduit=$request->get('prixProduit');
            $Produits  = $em->getRepository(Produit::class)->findBy(
                array("nomProduit"=>$nomProduit,
                //"prixProduit"=>$prixProduit
                    )


            );




        }
        return $this->render("@adem/Default/recherche.html.twig",array("Produits"=>$Produits));



    }

    public function afficherProduitDetailFrontAction(Request $request ,  Produit $produit)
    {










            return $this->render('@adem/Produit/afficher_produit_detail.html.twig',
                array(
                    'produit'=>$produit,



                ));




        return $this->render('@adem/Produit/afficher_produit_detail.html.twig',
            array(
                'produit'=>$produit,

            ));

    }

    public function updateQteAction(Request $request ,  Produit $produit)
    {
        $produit->setQuantite($produit->getQuantite()-1);
        $em = $this->getDoctrine()->getManager();
        $em->persist($produit);
        $em->flush();
        $repoproduit= $this->getDoctrine()->getRepository('ademBundle:Produit');
        $produit=$repoproduit->find($produit->getId_Produit());

        return $this->redirectToRoute('afficherProduitdetail', [
            'id'  => $produit->getId_Produit(),
        ]);


    }





}
