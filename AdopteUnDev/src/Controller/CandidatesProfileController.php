<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CandidatesProfileController extends AbstractController
{
    #[Route('/candidates/profile', name: 'candidates_profile')]
    public function index(): Response
    {
        return $this->render('candidates_profile/index.html.twig', [
            'controller_name' => 'CandidatesProfileController',
        ]);
    }
}
