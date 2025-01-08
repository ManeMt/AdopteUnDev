<?php

namespace App\Controller;

use App\Entity\JobAdd;
use App\Form\JobAddType;
use App\Repository\JobAddRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\User\UserInterface;

#[Route('/job/add')]
final class JobAddController extends AbstractController
{
    #[Route(name: 'app_job_add_index', methods: ['GET'])]
    public function index(JobAddRepository $jobAddRepository): Response
    {
        return $this->render('job_add/index.html.twig', [
            'job_adds' => $jobAddRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_job_add_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $jobAdd = new JobAdd();
        $form = $this->createForm(JobAddType::class, $jobAdd);
        // $jobAdd->setCompany($userInterface->getCompanies());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($jobAdd);
            $entityManager->flush();

            return $this->redirectToRoute('app_job_add_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('job_add/new.html.twig', [
            'job_add' => $jobAdd,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_job_add_show', methods: ['GET'])]
    public function show(JobAdd $jobAdd): Response
    {
        return $this->render('job_add/show.html.twig', [
            'job_add' => $jobAdd,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_job_add_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, JobAdd $jobAdd, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(JobAddType::class, $jobAdd);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_job_add_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('job_add/edit.html.twig', [
            'job_add' => $jobAdd,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_job_add_delete', methods: ['POST'])]
    public function delete(Request $request, JobAdd $jobAdd, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$jobAdd->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($jobAdd);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_job_add_index', [], Response::HTTP_SEE_OTHER);
    }
}
