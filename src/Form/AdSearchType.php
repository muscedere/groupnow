<?php

namespace App\Form;

use App\Entity\Activity;
use App\Entity\AdSearch;
use App\Entity\Category;
use App\Repository\AdRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class AdSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('maxPrice', IntegerType::class, [
            'required' => false,
            'label' => "Budget max",
            'attr' => [
                'placeholder' => "Prix max"
            ]
            
            ])
            ->add('minPlace', IntegerType::class, [
                'required' => false,
                'label' => "Nombre de place minimum",
                'attr' => [
                    'placeholder' => "nombre de place minimum"
                ]
                
                ])
            ->add('category', EntityType::class, [
                'required' => false,
                'label' => "Categories",
                'class' => Category::class,
                'choices' => $category->getCategory(),
                    
                    ])
            ->add('submit', SubmitType::class,[
                'label' => 'Rechercher'
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AdSearch::class,
            'method'   => 'get',
            'csrf_protection' => false
            ]);
    }
    public function getBlockPrefix(){
        return '';
    }
}
