<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class JobAddController extends AbstractController
{
    #[Route('/job/add', name: 'app_job_add_index')]
    public function index(): Response
    {
        return $this->render('job_add/index.html.twig', [
            'controller_name' => 'JobAddController',
        ]);
    }
}
