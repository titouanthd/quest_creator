<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if get user
        if ($this->getUser()) {
            // add flash message
            $username = $this->getUser()->getUsername();
            $logout_url = $this->generateUrl('app_logout');
            $home_url = $this->generateUrl('app_front_home');
            $this->addFlash('info', 'You are already logged in as '.$username.' ! Please <a href="'.$logout_url.'">logout</a> first to login as another user or <a href="'.$home_url.'">Go back to home page</a>');
        }
        
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // if error
        if ($error) {
            $this->addFlash('danger', $error->getMessage());
        }
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername, 
            'error' => $error, 
            'page_title' => 'Login'
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
