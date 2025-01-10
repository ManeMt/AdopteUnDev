<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AuthenticationController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('authentication/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    #[Route(path: '/profile', name: 'app_profile')]
    public function profile()
    {
        $user = $this->getUser();
    //    dd($user);
        if(!$user){
            return null;
        }

        $viewFile = 'index.html.twig';
        $viewDir = 'devs';
        if(in_array('ROLE_COMPANY',$user->getRoles())){
          
            if(!$user->isCompleteProfile()){
                return $this->redirectToRoute("app_company_edit",["id"=> $user->getId()]);
            }else{
                return $this->redirectToRoute("company_dashboard");
            }
        }else{
            if(!$user->isCompleteProfile()){
                return $this->redirectToRoute("app_developer_edit",["id"=> $user->getId()]);
            }else{
                return $this->redirectToRoute("developer_dashboard");
            }
        }
        

        return $this->render("profiles/$viewDir/$viewFile");
    }


    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
