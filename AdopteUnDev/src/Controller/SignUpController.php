<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SignUpController extends AbstractController
{
    #[Route('/sign-up', name: 'signup')]
    public function index(Request $request): Response
    {
        // Vérifie si le formulaire a été soumis
        if ($request->isMethod('POST')) {
            // Récupère les données du formulaire
            $firstName = $request->request->get('first_name');
            $lastName = $request->request->get('last_name');
            $email = $request->request->get('email');
            $password = $request->request->get('password');
            $confirmPassword = $request->request->get('confirm_password');
            $terms = $request->request->get('terms');

            // Validation des données (exemple simple)
            if ($password !== $confirmPassword) {
                $this->addFlash('error', 'Passwords do not match.');
                return $this->redirectToRoute('signup');
            }

            if (!$terms) {
                $this->addFlash('error', 'You must accept the terms and conditions.');
                return $this->redirectToRoute('signup');
            }

            // Ici, vous pouvez ajouter la logique pour enregistrer l'utilisateur dans la base de données
            // Par exemple, utiliser Doctrine pour persister les données

            // Redirige l'utilisateur après l'inscription réussie
            $this->addFlash('success', 'Registration successful!');
            return $this->redirectToRoute('home');
        }

        // Affiche le formulaire d'inscription
        return $this->render('joblist/index.html.twig', [
            'controller_name' => 'SignUpController',
        ]);
    }
}