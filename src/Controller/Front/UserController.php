<?php

namespace App\Controller\Front;

use App\Entity\User;
use App\Form\Front\UserType;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    // new route to display user profile
    #[Route('/profile', name: 'app_front_user_show')]
    public function show(): Response
    {
        return $this->render('front/user/show.html.twig', [
            'controller_name' => 'DefaultController',
            'page_title' => 'Show profile',
        ]);
    }

    // new route to edit user profile
    #[Route('/profile/edit/{id}', name: 'app_front_user_edit')]
    public function editProfile(User $user, Request $request, UserRepository $ur): Response
    {
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        // handle the form submission
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            // set update at
            $user->setUpdatedAt(new \DateTimeImmutable());
            // set username
            $user->setUsername($data->getUsername());

            $ur->save($user, true);

            // add flash message
            $this->addFlash('success', 'Profile updated successfully');

            // redirect to the profile page
            return $this->redirectToRoute('app_front_user_show');
        }

        return $this->render('front/user/edit.html.twig', [
            'controller_name' => 'DefaultController',
            'page_title' => 'Edit Profile',
            'form' => $form->createView(),
        ]);
    }
}
