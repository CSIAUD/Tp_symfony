<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'attr' => [
                    'placeholder' => 'Prénom',
                    'class' => 'form-control'
                ],
                'label' => false,
            ])
            ->add('lastname', TextType::class, [
                'attr' => [
                    'placeholder' => 'Nom de famille',
                    'class' => 'form-control'
                ],
                'label' => false,
            ])
            ->add('password', PasswordType::class, [
                'attr' => [
                    'placeholder' => 'Mot de passe',
                    'class' => 'form-control'
                ],
                'label' => false,
            ])
            ->add('email', TextType::class, [
                'attr' => [
                    'placeholder' => 'Email',
                    'class' => 'form-control'
                ],
                'label' => false,
            ])
            ->add('username', TextType::class, [
                'attr' => [
                    'placeholder' => 'Username',
                    'class' => 'form-control'
                ],
                'label' => false,
            ])
            ->add('image', FileType::class, [
                'required' => false,
            ])
            ->add('save', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary btn-block'
                ],
                'label' => 'S\'insrire',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
