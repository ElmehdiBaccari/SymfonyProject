<?php

namespace EspritApiBundle\Controller;

use ademBundle\Entity\EmpruntLivre;
use ademBundle\Entity\Livre;
use ademBundle\Entity\User;
use Esprit\ApiBundle\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class TaskController extends Controller
{
    public function allAction()
    {
        $tasks = $this->getDoctrine()->getManager()
            ->getRepository('EspritApiBundle:Task')
            ->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tasks);
        return new JsonResponse($formatted);
    }

    public function findAction($id)
    {
        $tasks = $this->getDoctrine()->getManager()
            ->getRepository('EspritApiBundle:Task')
            ->find($id);
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tasks);
        return new JsonResponse($formatted);
    }

    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $task = new Task();
        $task->setName($request->get('name'));
        $task->setStatus($request->get('status'));
        $em->persist($task);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($task);
        return new JsonResponse($formatted);
    }

    public function livreAction()
    {
        $tasks = $this->getDoctrine()->getManager()
            ->getRepository('ademBundle:Livre')
            ->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tasks);
        return new JsonResponse($formatted);
    }

    public function emlivreAction()
    {
        $tasks = $this->getDoctrine()->getManager()
            ->getRepository('ademBundle:EmpruntLivre')
            ->getlivreEmprunts();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tasks);
        return new JsonResponse($formatted);
    }

    public function empruntAction(Livre $idlivre,User $iduser,$dateemprunt,$dateretour)
    {

        $emprunt= new EmpruntLivre();
        $emprunt->setIdUser($iduser);
        $emprunt->setIdLivre($idlivre);
        $emprunt->setDEmprunt(new \DateTime($dateemprunt));
        $emprunt->setDRetour(new \DateTime($dateretour));
        $em = $this->getDoctrine()->getManager();
        $em->persist($emprunt);
        $em->flush();
        $idlivre->setQteLivre($idlivre->getQteLivre()-1);
        $em->persist($idlivre);
        $em->flush();
        return new Response(
            'emprunt ajouté !');
    }

}
