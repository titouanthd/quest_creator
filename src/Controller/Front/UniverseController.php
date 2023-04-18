<?php

namespace App\Controller\Front;

use App\Entity\Universe;
use App\Repository\UniverseRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

// route base is app_front_universe_
#[Route('/app/universe', name: 'app_front_universe_')]
class UniverseController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(UniverseRepository $universeRepository): Response
    {
        // get all universes from this author
        $author = $this->getUser();
        $universes = $universeRepository->findBy(['author' => $author]);

        return $this->render('front/universe/index.html.twig', [
            'controller_name' => 'UniverseController',
            'page_title' => 'Universe',
            'universes' => $universes,
        ]);
    }

    // show a universe
    #[Route('/{id}', name: 'show')]
    public function show(Universe $universe): Response
    {
        return $this->render('front/universe/show.html.twig', [
            'controller_name' => 'UniverseController',
            'page_title' => 'Show universe',
            'universe' => $universe,
        ]);
    }
}
