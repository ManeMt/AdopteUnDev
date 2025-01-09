<?php

namespace App\Controller;

use App\Entity\Developer;
use App\Form\DeveloperType;
use App\Repository\DeveloperRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Repository\JobAddRepository;

#[Route('/developer')]
final class DeveloperController extends AbstractController{
    #[Route(name: 'app_developer_index', methods: ['GET'])]
    public function index(DeveloperRepository $developerRepository): Response
    {
        return $this->render('developer/index.html.twig', [
            'developers' => $developerRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_developer_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, UserInterface $user): Response
    {
        $developer = new Developer();
        $form = $this->createForm(DeveloperType::class, $developer);
        $developer->setUser($user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($developer);
            $entityManager->flush();

            return $this->redirectToRoute('app_developer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('developer/new.html.twig', [
            'developer' => $developer,
            'form' => $form,
        ]);
    }

    #[Route('/developer-createprofile', name: 'app_developer-createprofile', methods: ['GET'])]
    public function test(): Response
    {
        return $this->render('developer/createprofile.html.twig', [
            
        ]);
    }

    #[Route('/developer/dashboard', name: 'developer_dashboard')]
    public function developerDashboard(JobAddRepository $jobAddRepository):Response
    {
    
    
        return $this->render('developer/dashboard.html.twig', [
             
      ]);
    }

        #[Route('/profile', name: 'developer_profile', methods: ['GET'])]
        public function affiche (): Response
        {
            // Données simulées pour un développeur
            $developer = [
                'firstName' => 'John',
                'lastName' => 'Doe',
                'minSalary' => 60000,
                'level' => 4,
                'biography' => 'A passionate full-stack developer with 5 years of experience in web applications.',
                'avatar' => 'default-avatar.png',
                'programingLanguages' => ['PHP', 'JavaScript', 'Python']
            ];
    
            // Affichage de la vue Twig
            return $this->render('developer/profile.html.twig', [
                'developer' => $developer,
            ]);
        }
    
    



    #[Route('/{id}', name: 'app_developer_show', methods: ['GET'])]
    public function show(Developer $developer): Response
    {
        return $this->render('developer/show.html.twig', [
            'developer' => $developer,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_developer_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Developer $developer, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DeveloperType::class, $developer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_developer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('developer/edit.html.twig', [
            'developer' => $developer,
            'form' => $form,
        ]);
    }

    
    

    #[Route('/{id}', name: 'app_developer_delete', methods: ['POST'])]
    public function delete(Request $request, Developer $developer, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$developer->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($developer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_developer_index', [], Response::HTTP_SEE_OTHER);
    }



}
