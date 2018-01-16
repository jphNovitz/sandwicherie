<?php

namespace App\Form;

use App\Entity\Ingredient;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IngredientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('comment', TextType::class)
            ->add('components', EntityType::class,[
                'class'=>'App\Entity\Ingredient',
                'multiple' => true,
                'required' => false
            ])
            ->add('categories', EntityType::class,[
                'class'=>'App\Entity\Category',
                'empty_data' => '',
                'multiple' => true,
                'required' => false
            ])
            ->add('bread', CheckboxType::class)
            ->add('sauce', CheckboxType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ingredient::class,
        ]);
    }
}
