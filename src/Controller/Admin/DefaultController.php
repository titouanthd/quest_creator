<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    #[Route('/admin/dashboard/{id}', name: 'app_admin_dashboard')]
    public function dashboard(User $user): Response
    {
        return $this->render('admin/default/dashboard.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
}
