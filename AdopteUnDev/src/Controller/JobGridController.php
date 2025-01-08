<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class JobGridController extends AbstractController
{
    #[Route('/job/grid', name: 'job_grid')]
    public function index(): Response
    {
        return $this->render('job_grid/index.html.twig', [
            'controller_name' => 'JobGridController',
        ]);
    }
}
