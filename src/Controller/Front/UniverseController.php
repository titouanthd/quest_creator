<?php

namespace App\Controller\Front;

use App\Entity\Universe;
use App\Form\Front\UniverseType;
use App\Repository\UniverseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/app/universe')]
class UniverseController extends AbstractController
{
    #[Route('/', name: 'app_front_universe_index', methods: ['GET'])]
    public function index(UniverseRepository $universeRepository): Response
    {
        // show only the universes of the current user
        $universes = $universeRepository->findBy(['author' => $this->getUser()]);
        return $this->render('front/universe/index.html.twig', [
            'universes' => $universes,
            'page_title' => 'Universes index',
        ]);
    }

    #[Route('/new', name: 'app_front_universe_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UniverseRepository $universeRepository): Response
    {
        $universe = new Universe();
        $form = $this->createForm(UniverseType::class, $universe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $date = new \DateTime();
            $author = $this->getUser();

            $universe->setAuthor($author);
            $universe->setCreatedAt($date);
            $universe->setUpdatedAt($date);

            $universeRepository->save($universe, true);

            // add a flash message
            $this->addFlash('success', 'The universe has been created');

            return $this->redirectToRoute('app_front_universe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('front/universe/new.html.twig', [
            'universe' => $universe,
            'form' => $form,
            'page_title' => 'New universe',
        ]);
    }

    #[Route('/{id}', name: 'app_front_universe_show', methods: ['GET'])]
    public function show(Universe $universe): Response
    {
        return $this->render('front/universe/show.html.twig', [
            'universe' => $universe,
            'page_title' => 'Show universe',
        ]);
    }

    #[Route('/{id}/edit', name: 'app_front_universe_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Universe $universe, UniverseRepository $universeRepository): Response
    {
        $form = $this->createForm(UniverseType::class, $universe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $date = new \DateTime();
            $universe->setUpdatedAt($date);
            $universeRepository->save($universe, true);

            // add a flash message
            $this->addFlash('success', 'The universe has been updated');

            return $this->redirectToRoute('app_front_universe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('front/universe/edit.html.twig', [
            'universe' => $universe,
            'form' => $form,
            'page_title' => 'Edit universe',
        ]);
    }

    #[Route('/{id}', name: 'app_front_universe_delete', methods: ['POST'])]
    public function delete(Request $request, Universe $universe, UniverseRepository $universeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$universe->getId(), $request->request->get('_token'))) {
            $universeRepository->remove($universe, true);
        }

        // add a flash message
        $this->addFlash('success', 'The universe has been deleted');

        return $this->redirectToRoute('app_front_universe_index', [], Response::HTTP_SEE_OTHER);
    }
}
