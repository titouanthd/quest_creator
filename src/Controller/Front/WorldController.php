<?php

namespace App\Controller\Front;

use App\Entity\World;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/app/world', name: 'app_front_world_')]
class WorldController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('front/world/index.html.twig', [
            'controller_name' => 'WorldController',
            'page_title' => 'Worlds',
        ]);
    }

    #[Route('/{id}', name: 'show')]
    public function show(World $world): Response
    {
        return $this->render('front/world/show.html.twig', [
            'controller_name' => 'WorldController',
            'page_title' => 'Worlds',
            'world' => $world,
        ]);
    }
}
