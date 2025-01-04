<?php
namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);
       
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $existingUser = $em->getRepository(User::class)->findOneBy(['email' => $user->getEmail()]);
             if ($existingUser) {
                 $this->addFlash('error', 'Un compte avec cet email existe déjà.');
                return $this->redirectToRoute('app_register'); // Recharger la page de registre
             }
             
            $hashedPassword = $passwordHasher->hashPassword($user, $user->getPassword());
            $user->setPassword($hashedPassword);

            $roles = $form->get('roles')->getData();
            if (!is_array($roles)) {
                $roles = [$roles]; // Ensure it's an array
            }
            $user->setRoles($roles);

            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('app_login');
        }

         return $this->render('registration/register.html.twig', [
            'form' => $form->createView(),
         ]);
    }
}
