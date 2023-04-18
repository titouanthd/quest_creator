<?php

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MapController extends AbstractController
{
    #[Route('/front/map', name: 'app_front_map')]
    public function index(): Response
    {
        return $this->render('front/map/index.html.twig', [
            'controller_name' => 'MapController',
        ]);
    }
}
