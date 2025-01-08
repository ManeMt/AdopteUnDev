<?php

namespace App\Controller;

use App\Entity\JobAdd;
use App\Form\CompanyType;
use App\Form\JobAddType;
use App\Repository\JobAddRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class JobAddController1 extends AbstractController
{
    #[Route('/job/add', name: 'job_add_index')]
    public function index(): Response
    {
        return $this->render('job_add/index.html.twig', [
            'controller_name' => 'JobAddController',
        ]);
    }
    // #[Route('/job/add', name: 'job_add_index')]
    // public function create(): Response
    // {
    //     return $this->render('job_add/index.html.twig', [
    //         'controller_name' => 'JobAddController',
    //     ]);
    // }
    #[Route('/job/add/create', name: 'job_add_create')]
    public function create(Request $request, JobAddRepository $jobAddRepository)
    {
        $jobAdd = new JobAdd();
        $form = $this->createForm(JobAddType::class, $jobAdd);
        $form->handleRequest($request);
        // if($form->isSubmitted() && $form->isValid()){
        //     $jobAddRepository->save($jobAdd,true);
        //     // return 
        // }
        // return $this->renderForm('job_add/create.html.twig',[
        //     'jobAdd' => $jobAdd,
        //     'form'=>$form
        // ]);
     
    }
}
