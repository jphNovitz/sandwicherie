<?php

namespace App\Form;

use App\Entity\Product;
use Doctrine\DBAL\Types\BooleanType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('description', TextType::class)
            ->add('price', NumberType::class)
            ->add('featured', CheckboxType::class)
            ->add('sauces', EntityType::class, [
                'class'=>'App\Entity\Ingredient',
                'query_builder' => function (EntityRepository $er) {
                    return $er->findSauces();
                },
                'required'=>false,
                'multiple'=>true
            ])
            ->add('vegetables', EntityType::class, [
                'class'=>'App\Entity\Ingredient',
                'query_builder' => function (EntityRepository $er) {
                    return $er->findVegetables();
                },
                'required'=>false,
                'multiple'=>true
            ])
            ->add('breads', EntityType::class, [
                'class'=>'App\Entity\Ingredient',
                'query_builder' => function (EntityRepository $er) {
                    return $er->findBreads();
                },
                'required'=>false,
                'multiple'=>true
            ])
            ->add('ingredients', EntityType::class, [
                'class'=>'App\Entity\Ingredient',
                'query_builder' => function (EntityRepository $er) {
                    return $er->findGeneralIngredients();
                },
                'required'=>false,
                'multiple'=>true
            ])
            ->add('types', EntityType::class, [
                'class'=>'App\Entity\Type',
                'required'=>false,
                'multiple'=>true
            ])
            ->add('isActive', CheckboxType::class)
            ->add('images', CollectionType::class,[
                'entry_type'=>ImageProductType::class,
                'allow_add'  => true,
                'allow_delete'  => true,
                'by_reference' => false,
                'label' => 'Fichier(s) :',
                'prototype' => true
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
