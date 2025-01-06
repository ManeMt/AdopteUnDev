<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PostJobController extends AbstractController
{
    #[Route('/post/job', name: 'post_job')]
    public function index(): Response
    {
        return $this->render('post_job/index.html.twig', [
            'controller_name' => 'PostJobController',
        ]);
    }
}
