<?php

namespace App\Form;

use App\Entity\Imagesproduct;
use App\Entity\Ingredient;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Choice;
use Vich\UploaderBundle\Form\Type\VichImageType;

class IngredientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('code', TextType::class)
            ->add('brands', TextType::class)
            ->add('genericNameFr', TextType::class)
            ->add('imageIngredientsUrl', TextType::class)
            ->add('imageNutritionUrl', TextType::class)
            ->add('imageUrl', TextType::class)
            ->add('ingredientsTextFr', TextType::class)
            ->add('comment', TextType::class)
            ->add('components', EntityType::class,[
                'class'=>'App\Entity\Ingredient',
                'multiple' => true,
                'required' => false
            ])
            ->add('categories', EntityType::class,[
                'class'=>'App\Entity\Category',
                'multiple' => true,
                'required' => false
            ])
            ->add('bread', CheckboxType::class)
            ->add('sauce', checkboxType::class)
            ->add('vegetable', checkboxType::class)
            ->add('images', CollectionType::class,[
                'entry_type'=>ImagesIngredientType::class,
                'allow_add'  => true,
                'allow_delete'  => true,
                'by_reference' => false,
                'label' => ' ',
                'prototype' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ingredient::class,
        ]);
    }
}
