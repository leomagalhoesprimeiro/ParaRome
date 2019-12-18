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

class ControllerProfessores extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
        $this -> entityManager = $entityManager;
    }

    public function create(Request $request): Response{
        $content = json_decode($request->getContent());
        $professor= new Professor();
        $professor->setNome($content->name);
        $this->entityManager->persist($professor);
        $this->entityManager->flush();
        return new JsonResponse($professor->Professor());

    }

    public function ListaTodos(Request $request): Response{

        $repository = $this->getDoctrine()->getRepository(Professor::class);
        $professor = $repository->findAll();

        return new JsonResponse($professor);

    }

}