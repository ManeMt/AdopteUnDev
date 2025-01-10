<?php

namespace App\Controller;

use App\Service\MatchingService;
use App\Repository\JobAddRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MatchingController extends AbstractController
{
    #[Route('/matching/{id}', name: 'app_matching')]
    public function match(MatchingService $matchingService, JobAddRepository $jobAddRepository, int $id): Response
    {
        $developer = $this->getUser(); 
        $jobAds = $jobAddRepository->findAll();

        $matches = $matchingService->match($developer, $jobAds);

        return $this->render('matching/index.html.twig', [
            'matches' => $matches,
        ]);
    }
}
