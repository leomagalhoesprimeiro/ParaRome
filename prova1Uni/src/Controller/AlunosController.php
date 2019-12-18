<?php

namespace App\Controller;
use App\Entity\Aluno;
use App\Entity\Projeto;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Persistence\ObjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class AlunosController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
        $this -> entityManager = $entityManager;
    }

    public function create(Request $request): Response{
        $content = json_decode($request->getContent());
        $aluno = new Aluno();
        $aluno->setNome($content->name);
        $this->entityManager->persist($aluno);
        $this->entityManager->flush();
        return new JsonResponse($aluno->getNome());

    }

    public function ListaTodos(Request $request): Response{

        $repository = $this->getDoctrine()->getRepository(Aluno::class);
        $aluno = $repository->findAll();

        return new JsonResponse($aluno);

    }
}