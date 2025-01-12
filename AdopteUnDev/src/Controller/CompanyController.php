<?php

namespace App\Controller;

use App\Entity\Company;
use App\Form\CompanyType;
use App\Repository\CompanyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\User\UserInterface;

#[Route('/company')]
final class CompanyController extends AbstractController{
    #[Route(name: 'app_company_index', methods: ['GET'])]
    public function index(CompanyRepository $companyRepository): Response
    {
        return $this->render('companies/index.html.twig', [
            'companies' => $companyRepository->findAll(),
        ]);
    }

    // #[Route('/new', name: 'app_company_new', methods: ['GET', 'POST'])]
    // public function new(Request $request, EntityManagerInterface $entityManager): Response
    // {
    //     $company = new Company();
    //     $form = $this->createForm(CompanyType::class, $company);
    //     // $company->setUser($user);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {

    //         // Mettre à jour l'attribut completeProfile de l'utilisateur
        
    //         #$logoFile = $this->fileUpload($form->get('logo')->getData());
    //         // $company->setLogo($logoFile);
    //         // $bannerFile = $this->fileUpload($form->get('banner')->getData());
    //         // $company->setLogo($bannerFile);
    
    //         // $imageFiles = $form->get('images')->getData();
    //         // $images = [];
    //         // foreach ($imageFiles as $key => $image) {
    //         //     $images[] = $this->fileUpload($image);

    //         // }
    //         if(count($images) > 0){
    //             $company->setImages($images);
    //         }
    //         // $company->setLogo($logoFile);
    //         $entityManager->flush();
    //         $entityManager->persist($company);
    //         $entityManager->flush();

    //         return $this->redirectToRoute('app_company_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->render('companies/new.html.twig', [
    //         'company' => $company,
    //         'form' => $form,
    //     ]);
    // }

    #[Route('/company-createprofile', name: 'app_company-createprofile', methods: ['GET', 'POST'])]
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        // Créez une nouvelle instance de l'entité Company
        $company = new Company();

        if ($request->isMethod('POST')) {
            // Récupérez les données du formulaire
            $company->setName($request->request->get('name'));
            // $company->setIndustry($request->request->get('industry'));
            $company->setDescription($request->request->get('description'));
            $company->setLocation($request->request->get('location'));
            $company->setWebsite($request->request->get('website'));
            $company->setEmail($request->request->get('email'));

            // Gestion des fichiers (logo et images)
            $logoFile = $request->files->get('logo');
            if ($logoFile) {
                $logoFilename = uniqid().'.'.$logoFile->guessExtension();
                $logoFile->move($this->getParameter('uploads_directory'), $logoFilename);
                $company->setLogo($logoFilename);
            }

            $images = $request->files->get('images');
            if ($images) {
                $imagePaths = [];
                foreach ($images as $image) {
                    $imageFilename = uniqid().'.'.$image->guessExtension();
                    $image->move($this->getParameter('uploads_directory'), $imageFilename);
                    $imagePaths[] = $imageFilename;
                }
                $company->setImages($imagePaths);
            }

            // Sauvegarder dans la base de données
            $em->persist($company);
            $em->flush();

            // Redirection après création
            return $this->redirectToRoute('app_company-details', ['id' => $company->getId()]);
        }

        // Rendu de la vue Twig
        return $this->render('company/createprofile.html.twig');
    }
  
    #[Route('/dashboard', name: 'company_dashboard', methods: ['GET'])]
    public function resume (): Response
    {
            // Données simulées pour l'entreprise
            $data = [
                'views' => 220, // Nombre de vues des fiches de poste
                'topJobs' => [
                    ['title' => 'Full-Stack Developer', 'views' => 180],
                    ['title' => 'Frontend Engineer', 'views' => 150],
                ],
            ];
    
            return $this->render('companies/dashboard.html.twig', [
                'data' => $data,
            ]);
        }
    
    
    

    #[Route('/company-profile', name: 'app_company-profile', methods: ['GET'])]
    public function essai(): Response
    
    {
       $company = [
                'name' => 'My Company',
                'industry' => 'Software Development',
                'location' => 'Paris, France',
                'description' => 'We are a leading company in software solutions.',
                'website' => 'https://www.mycompany.com',
                'email' => 'contact@mycompany.com',
                'images' => [
                    'images/gallery1.jpg',
                    'images/gallery2.jpg',
                    'images/gallery3.jpg',
                ],
            ];
        
            return $this->render('companies/profile.html.twig', [
                'company' => $company,
            ]);
        
        
            
    
        }
    #[Route('/{id}', name: 'app_company_show', methods: ['GET'])]
    public function show(Company $company): Response
    {
        return $this->render('companies/show.html.twig', [
            'company' => $company,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_company_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Company $company, EntityManagerInterface $entityManager, UserInterface $user): Response
    {
        $form = $this->createForm(CompanyType::class, $company);
        // $company->setUser($user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

             // Mettre à jour l'attribut completeProfile de l'utilisateur
             if ($user instanceof \App\Entity\User) { // Assurez-vous que $user est bien une instance de User
                $user->setCompleteProfile(true);
                $entityManager->persist($user);
            }

            $entityManager->flush();

            return $this->redirectToRoute('company_dashboard', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('companies/edit.html.twig', [
            'company' => $company,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_company_delete', methods: ['POST'])]
    public function delete(Request $request, Company $company, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$company->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($company);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_company_index', [], Response::HTTP_SEE_OTHER);
    }
}
