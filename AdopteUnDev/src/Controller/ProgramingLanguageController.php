<?php

namespace App\Controller;

use App\Entity\ProgramingLanguage;
use App\Form\ProgramingLanguageType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProgramingLanguageController extends AbstractController
{
    #[Route('/programing_language/new', name: 'app_programing_language_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $programingLanguage = new ProgramingLanguage();
        $form = $this->createForm(ProgramingLanguageType::class, $programingLanguage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($programingLanguage);
            $entityManager->flush();

            $this->addFlash('success', 'Programming language added successfully!');

            return $this->redirectToRoute('app_programing_language_new');
        }

        return $this->render('programing_language/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
