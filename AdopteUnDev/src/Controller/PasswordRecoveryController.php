<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PasswordRecoveryController extends AbstractController
{
    #[Route('/password/recovery', name: 'password_recovery')]
    public function index(): Response
    {
        return $this->render('password_recovery/index.html.twig', [
            'controller_name' => 'PasswordRecoveryController',
        ]);
    }
}
