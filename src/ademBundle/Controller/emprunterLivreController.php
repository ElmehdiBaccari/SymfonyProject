<?php

namespace ademBundle\Controller;

use ademBundle\Entity\EmpruntLivre;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Swift_Message;
use Symfony\Component\HttpFoundation\Response;
use Ob\HighchartsBundle\Highcharts\Highchart;

class emprunterLivreController extends Controller
{
    public function retourner_livreAction(EmpruntLivre $empruntLivre)
    {

        $doctrine= $this->getDoctrine();
        $repository = $doctrine->getRepository(  'ademBundle:Livre');
        $livre = $repository->find($empruntLivre->getIdLivre());
        $livre->setQteLivre($livre->getQteLivre()+1);
        $em = $this->getDoctrine()->getManager();
        $em->remove($empruntLivre);
        $em->flush();
        $em->persist($livre);
        $em->flush();
        return $this->forward('ademBundle:emprunterLivre:afficher_livre_emprunter');
    }

    public function afficher_livre_emprunterAction()
    {
        $doctrine= $this->getDoctrine();
        $repository = $doctrine->getRepository('ademBundle:EmpruntLivre');
        $EmpruntLivres= $repository->getEmprunts();
        return $this->render('ademBundle:emprunterLivre:afficher.livre.emprunter.html.twig',
            array(
                'EmpruntLivres'=>$EmpruntLivres,

            ));
    }



    public function statAction()
    {

        $ob = new Highchart();
        $ob->chart->renderTo('piechart');
        $ob->title->text('Les listes des emprunts par categorie');
        $ob->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => false),
            'showInLegend'  => true
        ));

        $em = $this->getDoctrine()->getManager();

        $RAW_QUERY = 'select count(*) as nb1 ,l.categorie_livre from emprunt_livre e join  livre l on e.id_livre=l.id_livre group by l.categorie_livre';
        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();
        $s = $statement->fetchAll();


        $data=array();
        foreach ($s as $values)
        {
            $a = array($values ['categorie_livre'],intval($values['nb1']));
            array_push($data,$a);

        }





        $ob->series(array(array('type' => 'pie','name' => 'Browser share', 'data' => $data)));

        return $this->render('ademBundle:emprunterLivre:statistique_emprunt.html.twig',array('chart'=> $ob));

    }






}
