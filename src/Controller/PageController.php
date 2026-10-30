<?php

namespace App\Controller;

use App\Repository\FitnessClassRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PageController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(FitnessClassRepository $repo): Response
    {
        // Repo injected into the action (method injection) instead of the constructor
        return $this->render('page/index.html.twig', [
            'classes' => $repo->findAll(),
        ]);
    }
}
