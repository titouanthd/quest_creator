<?php

namespace App\Controller\App;

use OpenAIService;
use App\Entity\User;
use App\Entity\Universe;
use App\Form\UniverseType;
use Symfony\Component\Uid\Uuid;
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
    #[Route('/app/{user_id}/universe/index', name: 'app_universe_index')]
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

    #[Route('/app/{user_id}/universe/create', name: 'app_universe_create')]
    public function create(User $user, EntityManagerInterface $em, Request $request, HttpClientInterface $client): Response
    {
        $this->denyAccessUnlessGranted('ACCESS_APP', $user);

        $open_ai_service = new OpenAIService($client);

        $slug = $this->generateRandomSlug();
        
        // universe form
        $seed = $this->generateRandomSeed();
        $universe = new Universe();
        $universe->setUser($user);
        $created_at = new \DateTime();
        $universe->setCreatedAt($created_at);
        $universe->setUpdatedAt($created_at);
        $universe->setSeed($seed);
        $universe->setSlug($slug);
        $universe_form = $this->createForm(UniverseType::class, $universe);
        $universe_form->handleRequest($request);

        if ($universe_form->isSubmitted() && $universe_form->isValid()) {
            $em->persist($universe);
            $em->flush();

            $this->addFlash('success', 'Universe created successfully');

            return $this->redirectToRoute('app_universe_index', ['id' => $user->getId()]);
        }

        // gpt form
        $gpt_form = $this->createFormBuilder()
            ->add('prompt')
            ->add('context')
            ->getForm();
        $gpt_form->handleRequest($request);

        if ($gpt_form->isSubmitted() && $gpt_form->isValid()) {
            $data = $gpt_form->getData();
            $prompt = $data['prompt'];
            $context = $data['context'];
            $chat_gpt_response = $open_ai_service->sendRequestToOpenAI($prompt, $context);
            dd($chat_gpt_response);
        }

        return $this->render('app/universe/create.html.twig', [
            'controller_name' => 'UniverseController',
            'universe_form' => $universe_form->createView(),
            'gpt_form' => $gpt_form->createView(),
        ]);
    }
    
    #[Route('/app/{user_id}/universe/edit/{universe_id}', name: 'app_universe_edit')]
    public function edit(User $user, Universe $universe, EntityManagerInterface $em, Request $request): Response
    {
        $this->denyAccessUnlessGranted('ACCESS_APP', $user);

        $universe_form = $this->createForm(UniverseType::class, $universe);
        $universe_form->handleRequest($request);

        if ($universe_form->isSubmitted() && $universe_form->isValid()) {
            $em->persist($universe);
            $em->flush();

            $this->addFlash('success', 'Universe updated successfully');

            return $this->redirectToRoute('app_universe_edit', ['id' => $user->getId()]);
        }

        return $this->render('app/universe/edit.html.twig', [
            'controller_name' => 'UniverseController',
            'universe_form' => $universe_form->createView(),
        ]);
    }
    
    /**
     * generate_random_seed
     *
     * @return string
     */
    private function generateRandomSeed(): string
    {
        $seed = '';
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $characters_length = strlen($characters);
        for ($i = 0; $i < 32; $i++) {
            $seed .= $characters[rand(0, $characters_length - 1)];
        }
        return $seed;
    }
    
    /**
     * generateRandomSlug
     *
     * @return string
     */
    private function generateRandomSlug(): string
    {
        $slug = Uuid::v4();
        // to base58
        $slug = $slug->toBase58();
        return $slug;
    }
}
