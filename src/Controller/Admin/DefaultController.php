<?php

namespace App\Controller\Admin;

use App\Repository\UserRepository;
use App\Repository\UniverseRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    #[Route('/admin/dashboard/', name: 'app_admin_dashboard')]
    public function dashboard(UniverseRepository $universeRepository, UserRepository $userRepository): Response
    {
        // count the number of universes
        $userCount = $userRepository->count([]);
        $universeCount = $universeRepository->count([]);

        return $this->render('admin/default/dashboard.html.twig', [
            'controller_name' => 'DefaultController',
            'page_title' => 'Admin Dashboard',
            'user_count' => $userCount,
            'universe_count' => $universeCount,
        ]);
    }
}
