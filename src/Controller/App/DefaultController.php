<?php

namespace App\Controller\App;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    #[Route('/app/{id}/dashboard/', name: 'app_default_dashboard')]
    public function index(User $user): Response
    {
        $this->denyAccessUnlessGranted('ACCESS_APP', $user);
        
        return $this->render('app/default/dashboard.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
}
