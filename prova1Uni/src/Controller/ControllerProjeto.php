<?php

namespace App\Controller;
use App\Entity\Aluno;
use App\Entity\Professor;
use App\Entity\Projeto;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ControllerProjeto extends AbstractController
{
    public function __construct(EntityManagerInterface $entityManager){
        $this -> entityManager = $entityManager;
    }

    public function create(int $id, Request $request): Response{
        $content = json_decode($request->getContent());

        $repository = $this->getDoctrine()->getRepository(Professor::class);
        $professor = $repository->find($id);
        $projeto =  New Projeto();
        $projeto->addOrientador($professor);
        $projeto->setNome($content->name);
        $projeto->setStatus($content->status);

        $this->entityManager->persist($projeto);
        $this->entityManager->flush();

        return new JsonResponse($projeto);

    }

    public function ListaTodos(Request $request): Response{

        $repository = $this->getDoctrine()->getRepository(Projeto::class);
        $projeto = $repository->findAll();

        return new JsonResponse($projeto);

    }


    public function ListaPorId(int $id, Request $request){
        $repository = $this->getDoctrine()->getRepository(Projeto::class);
        $projeto = $repository->find($id);

        return new JsonResponse($projeto);
    }


}