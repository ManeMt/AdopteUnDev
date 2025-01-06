<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EmployersListController extends AbstractController
{
    #[Route('/employers/list', name: 'employers_list')]
    public function index(): Response
    {
        return $this->render('employers_list/index.html.twig', [
            'controller_name' => 'EmployersListController',
        ]);
    }
}
