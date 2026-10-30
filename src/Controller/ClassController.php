<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\CapacityService;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\FitnessClass;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\FitnessClassRepository;


#[Route('/api/classes')]
final class ClassController extends AbstractController
{

    public function __construct(
        private FitnessClassRepository $repo,
        private EntityManagerInterface $em,
        private CapacityService $capacity,
    ) {}
    #[Route('', methods: ['GET'])]
    public function list(): JsonResponse
    {
        $data = array_map(fn (FitnessClass $c) => [
            'id' => $c->getId(),
            'name' => $c->getName(),
            'instructor' => $c->getInstructor(),
            'capacity' => $c->getCapacity(),
            'startsAt' => $c->getStartsAt()->format(DATE_ATOM),
        ], $this->repo->findAll());

        return $this->json($data);
    }

    #[Route('', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $body = json_decode($request->getContent(), true);

        $c = (new FitnessClass())
            ->setName($body['name'])
            ->setInstructor($body['instructor'])
            ->setCapacity($body['capacity'])
            ->setStartsAt(new \DateTimeImmutable($body['startsAt']));

        $this->em->persist($c);   
        $this->em->flush();       

        return $this->json(['id' => $c->getId()], 201);
    }

    #[Route('/{id}/space', methods: ['GET'])]
    public function space(FitnessClass $class, Request $request): JsonResponse
    {
        
        $booked = $request->query->getInt('booked');
        return $this->json(['hasSpace' => $this->capacity->hasSpace($class, $booked)]);
    }



}
