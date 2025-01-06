<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CompanyDetailController extends AbstractController
{
    #[Route('/company/detail', name: 'company_detail')]
    public function index(): Response
    {
        return $this->render('company_detail/index.html.twig', [
            'controller_name' => 'CompanyDetailController',
        ]);
    }
}
