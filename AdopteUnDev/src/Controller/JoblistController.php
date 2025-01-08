<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class JoblistController extends AbstractController
{
    #[Route('/joblist', name: 'job_list')]
    public function index(): Response
    {
        return $this->render('joblist/index.html.twig', [
            'controller_name' => 'JoblistController',
        ]);
    }
}
