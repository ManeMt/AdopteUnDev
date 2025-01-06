<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class JobDetailController extends AbstractController
{
    #[Route('/job/detail', name: 'job_details')]
    public function index(): Response
    {
        return $this->render('job_detail/index.html.twig', [
            'controller_name' => 'JobDetailController',
        ]);
    }
}
