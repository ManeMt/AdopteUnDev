<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CreateResumeController extends AbstractController
{
    #[Route('/create/resume', name: 'create_resume')]
    public function index(): Response
    {
        return $this->render('create_resume/index.html.twig', [
            'controller_name' => 'CreateResumeController',
        ]);
    }
}
