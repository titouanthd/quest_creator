<?php

namespace App\Controller\App;

use OpenAIService;
use App\Entity\User;
use App\Entity\Universe;
use App\Form\UniverseType;
use App\Repository\UniverseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class UniverseController extends AbstractController
{
    #[Route('/app/{id}/universe/index', name: 'app_universe_index')]
    public function index(User $user, EntityManagerInterface $em, PaginatorInterface $paginator, Request $request): Response
    {
        $this->denyAccessUnlessGranted('ACCESS_APP', $user);

        $dql = "SELECT b FROM App\Entity\Universe b WHERE b.user = :user ORDER BY b.id DESC";
        $query = $em->createQuery($dql)->setParameter('user', $user);

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            2
        );
        
        return $this->render('app/universe/index.html.twig', [
            'controller_name' => 'UniverseController',
            'pagination' => $pagination
        ]);
    }

    #[Route('/app/{id}/universe/create', name: 'app_universe_create')]
    public function create(User $user, EntityManagerInterface $em, Request $request, HttpClientInterface $client): Response
    {
        $open_ai_service = new OpenAIService($client);

        $this->denyAccessUnlessGranted('ACCESS_APP', $user);

        $universe = new Universe();
        $universe->setUser($user);
        $created_at = new \DateTime();
        $universe->setCreatedAt($created_at);
        $universe->setUpdatedAt($created_at);

        $form = $this->createForm(UniverseType::class, $universe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $prompt = "Could you tell me how to learn Symfony?";
            $context = "I am a beginner in Symfony and I want to learn it.";
            $open_ai_service->sendRequestToOpenAI($prompt, $context);

            $em->persist($universe);
            $em->flush();

            $this->addFlash('success', 'Universe created successfully');

            return $this->redirectToRoute('app_universe_index', ['id' => $user->getId()]);
        }

        return $this->render('app/universe/create.html.twig', [
            'controller_name' => 'UniverseController',
            'form' => $form->createView()
        ]);
    }
}
