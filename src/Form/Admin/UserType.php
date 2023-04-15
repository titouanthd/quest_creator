<?php

namespace App\Form\Admin;

use App\Entity\User;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' => [
                    'placeholder' => 'Email',
                ],
            ])
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Admin' => 'ROLE_ADMIN',
                    'User' => 'ROLE_USER',
                ],
                'multiple' => true,
                'expanded' => true,
                'autocomplete' => true,
            ])
            ->add('username', TextType::class, [
                'label' => 'Username',
                'attr' => [
                    'placeholder' => 'Username',
                ],
            ])
            ->add('avatarUrl')
            ->add('created_at', DateTimeType::class, [
                'widget' => 'single_text',
            ])
            ->add('updated_at', DateTimeType::class, [
                'widget' => 'single_text',
            ])
        ;

        // add event listener to set the password field
        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) {
                $user = $event->getData();
                $form = $event->getForm();

                if (!$user || null === $user->getId()) {
                    // new user
                    $form->add('password', PasswordType::class, [
                        'label' => 'Password',
                        'attr' => [
                            'placeholder' => 'Password',
                            // required for the validation
                            'required' => true,
                        ],

                    ]);
                } else {
                    // edit user
                }
            }
        );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
