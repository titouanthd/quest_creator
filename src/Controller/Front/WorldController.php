<?php

namespace App\Controller\Front;

use App\Entity\World;
use App\Form\Front\WorldType;
use App\Repository\WorldRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/app/world')]
class WorldController extends AbstractController
{
    #[Route('/{id}', name: 'app_front_world_show', methods: ['GET'])]
    public function show(World $world): Response
    {
        return $this->render('front/world/show.html.twig', [
            'world' => $world,
            'page_title' => 'Show world',
        ]);
    }

    #[Route('/{id}/edit', name: 'app_front_world_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, World $world, WorldRepository $worldRepository): Response
    {
        $form = $this->createForm(WorldType::class, $world);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $date = new \DateTime();
            $world->setUpdatedAt($date);
            $worldRepository->save($world, true);

            // add a flash message
            $this->addFlash('success', 'The world has been updated.');

            return $this->redirectToRoute('app_front_world_show', ["id" => $world->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('front/world/edit.html.twig', [
            'world' => $world,
            'form' => $form,
            'page_title' => 'Edit world',
        ]);
    }

    #[Route('/{id}', name: 'app_front_world_delete', methods: ['POST'])]
    public function delete(Request $request, World $world, WorldRepository $worldRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$world->getId(), $request->request->get('_token'))) {
            $worldRepository->remove($world, true);
        }

        // add a flash message
        $this->addFlash('success', 'The world has been deleted.');

        return $this->redirectToRoute('app_front_world_index', [], Response::HTTP_SEE_OTHER);
    }
}
