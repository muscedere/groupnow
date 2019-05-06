<?php

namespace App\Form;

use App\Entity\User;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class RegistrationType extends ApplicationType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, $this->getConfiguration(" ", "Prénom"))
            ->add('lastName', TextType::class, $this->getConfiguration(" ", "Nom"))
            ->add('email', EmailType::class, $this->getConfiguration(" ", " Email"))
            ->add('hash', PasswordType::class, $this->getConfiguration(" ", "Choisissez un bon mot de passe !"))
            ->add('passwordConfirm', PasswordType::class, $this->getConfiguration(" ", "Veuillez confirmer votre mot de passe"))

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
