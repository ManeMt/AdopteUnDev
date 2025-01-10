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

#[Route('/developer')]
final class DeveloperController extends AbstractController{
    #[Route(name: 'app_developer_index', methods: ['GET'])]
    public function index(DeveloperRepository $developerRepository): Response
    {
        return $this->render('devs/index.html.twig', [
            'developers' => $developerRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_developer_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager ): Response
    {
        $developer = new Developer();
        $form = $this->createForm(DeveloperType::class, $developer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Mettre à jour l'attribut completeProfile de l'utilisateur

            $avatarFile = $form->get('avatar')->getData();

            if ($avatarFile) {
                $uploadDir = $this->getParameter('kernel.project_dir') . '/public/uploads/avatars';
                $newFilename = uniqid() . '.' . $avatarFile->guessExtension();
                $avatarFile->move($uploadDir, $newFilename);
                $developer->setAvatar($newFilename);
            }
            
            $entityManager->persist($developer);
            $entityManager->flush();

            return $this->redirectToRoute('app_developer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('devs/new.html.twig', [
            'developer' => $developer,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_developer_show', methods: ['GET'])]
    public function show(Developer $developer): Response
    {
        return $this->render('devs/show.html.twig', [
            'developer' => $developer,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_developer_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Developer $developer, EntityManagerInterface $entityManager, UserInterface $user): Response
    {
        $form = $this->createForm(DeveloperType::class, $developer);
        $developer->setUser($user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ($user instanceof \App\Entity\User) { // Assurez-vous que $user est bien une instance de User
                $user->setCompleteProfile(true);
                $entityManager->persist($user);
            }

            $avatarFile = $form->get('avatar')->getData();

            if ($avatarFile) {
                 $uploadDir = $this->getParameter('kernel.project_dir') . '/public/uploads/avatars';
                 $newFilename = uniqid() . '.' . $avatarFile->guessExtension();
                 $avatarFile->move($uploadDir, $newFilename);
                 $developer->setAvatar($newFilename);
            }
            $entityManager->flush();

            return $this->redirectToRoute('app_dashboard', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('devs/edit.html.twig', [
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
