<?php

namespace App\Form;

use App\Entity\Universe;
use App\Form\UserAutocompleteField;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class UniverseType extends AbstractType
{
    private $requestStack;
    private $authorizationChecker;

    public function __construct(RequestStack $requestStack, AuthorizationCheckerInterface $authorizationChecker)
    {
        $this->requestStack = $requestStack;
        $this->authorizationChecker = $authorizationChecker;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Name',
                'attr' => [
                    'placeholder' => 'Name'
                ]
            ])
            ->add('seed', TextType::class, [
                'label' => 'Seed',
                'attr' => [
                    'placeholder' => 'Seed'
                ]
            ]);

        // add event listener to show or hide the user field
        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            [$this, 'onPreSetData']
        );
    }

    public function onPreSetData(FormEvent $event)
    {
        $request = $this->requestStack->getCurrentRequest();

        if ($this->authorizationChecker->isGranted('ROLE_ADMIN') === true) {
            // If the user is an admin we can display the user field
            $event->getForm()->add('user', UserAutocompleteField::class);
            // same thing for slug
            $event->getForm()->add('slug', TextType::class, [
                'label' => 'Slug',
                'attr' => [
                    'placeholder' => 'Slug'
                ]
            ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Universe::class,
        ]);
    }
}
