<?php

namespace App\Form;

use App\Entity\Ad;
use App\Form\ImageType;
use App\Entity\Category;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class AdType extends ApplicationType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'title', 
                TextType::class, 
                $this->getConfiguration("Titre", "Tapez un super titre pour votre événement")
            )
            ->add(
                'place',
                TextType::class,
                $this->getConfiguration("Lieu", "Le lieu de l'événement")
            )
            ->add(
                'date',
                DateTimeType::class,
                $this->getConfiguration("Date", "Date de l'événement",[
                    'required' => false
                ])
            )
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'title',
                
                ])
            ->add(
                'coverImage', 
                UrlType::class, 
                $this->getConfiguration("URL de l'image principale", "Donnez l'adresse d'une image qui donne vraiment envie")
            )
            ->add(
                'introduction', 
                TextType::class, 
                $this->getConfiguration("Introduction", "Donnez une description globale de l'événement")
            )
            ->add(
                'content', 
                TextareaType::class, 
                $this->getConfiguration("Description détaillée", "Tapez une description qui donne vraiment envie de participé !")
            )
            ->add(
                'rooms', 
                IntegerType::class, 
                $this->getConfiguration("Nombre de personnes", "Le nombre de personne nécessaire a l'événement")
            )
            ->add(
                'price', 
                MoneyType::class, 
                $this->getConfiguration("budget", "Indiquez le budget moyen pour l'événement")
            )
            ->add(
                'images',
                CollectionType::class,
                [
                    'entry_type' => ImageType::class,
                    'allow_add' => true,
                    'allow_delete' => true
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ad::class,
        ]);
    }
}
