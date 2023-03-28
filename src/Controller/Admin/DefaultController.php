<?php

namespace App\Controller\Admin;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    #[Route('/admin/dashboard/', name: 'app_admin_dashboard')]
    public function dashboard(): Response
    {
        return $this->render('admin/default/dashboard.html.twig', [
            'controller_name' => 'DefaultController',
            'page_title' => 'Admin Dashboard',
        ]);
    }
}
