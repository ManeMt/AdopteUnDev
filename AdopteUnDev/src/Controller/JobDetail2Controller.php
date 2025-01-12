<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class JobDetail2Controller extends AbstractController
{
    #[Route('/job/detail2', name: 'job_details_2')]
    public function index(): Response
    {
        return $this->render('job_detail2/index.html.twig', [
            'controller_name' => 'JobDetail2Controller',
        ]);
    }
}
