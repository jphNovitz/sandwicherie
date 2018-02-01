<?php

namespace App\Form;

use App\Entity\Ingredient;
use App\Entity\Line;
use App\Entity\Product;
use App\Entity\Provider;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ingredient', EntityType::class, [
                'class'=>Ingredient::class,
                'label'=>false,
                'attr'=>['class'=>'table-presentation custom']
            ])
            ->add('provider', EntityType::class, [
                'class'=>Provider::class,
                'label'=>false,
                'attr'=>['class'=>'table-presentation custom']])
            ->add('quantity', NumberType::class,[
                'label'=>false,
                'attr'=>['class'=>'table-presentation custom']
            ])
            ->add('price', NumberType::class,[
                'label'=>false,
             'by_reference'=>false,
                'attr'=>['class'=>'table-presentation custom']
            ])->add('temperature', NumberType::class,[
                'label'=>false,
                'by_reference'=>false,
                'attr'=>['class'=>'table-presentation custom']
            ])->add('barcode', TextType::class,[
                'label'=>false,
             'by_reference'=>false,
                'attr'=>['class'=>'table-presentation custom']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Line::class,
        ]);
    }
}
