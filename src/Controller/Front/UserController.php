<?php

namespace App\Controller\Front;

use App\Entity\User;
use App\Form\Front\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/app/user')]
class UserController extends AbstractController
{
    #[Route('/{id}', name: 'app_front_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        // every body can see the user profile
        return $this->render('front/user/show.html.twig', [
            'user' => $user,
            'page_title' => 'Show user',
        ]);
    }

    #[Route('/{id}/edit', name: 'app_front_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, UserRepository $userRepository): Response
    {
        // only the user can edit his profile
        if ($user !== $this->getUser()) {
            throw $this->createAccessDeniedException();
        }

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $date = new \DateTime();
            $user->setUpdatedAt($date);
            
            $userRepository->save($user, true);

            // add a flash message
            $this->addFlash('success', 'The user has been updated');

            return $this->redirectToRoute('app_front_user_show', ["id" => $user->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('front/user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
            'page_title' => 'Edit user',
        ]);
    }
}
