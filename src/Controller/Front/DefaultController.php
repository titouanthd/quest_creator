<?php

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_front_home')]
    public function home(): Response
    {
        return $this->render('front/default/home.html.twig', [
            'controller_name' => 'DefaultController',
            'page_title' => 'Home',
        ]);
    }
}
