<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CandidatesListingController extends AbstractController
{
    #[Route('/candidates/listing', name: 'candidates_listing')]
    public function index(): Response
    {
        return $this->render('candidates_listing/index.html.twig', [
            'controller_name' => 'CandidatesListingController',
        ]);
    }
}
