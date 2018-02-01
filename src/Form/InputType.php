<?php

namespace App\Form;

use App\Entity\Input;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\DateTime;

class InputType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateEntry', DateType::class,['format' => 'MM-dd-MM-yyyy'])
            ->add('lines', CollectionType::class,[
            'entry_type'=>LineType::class,
            'allow_add'  => true,
            'allow_delete'  => true,
            'prototype' => true,

        ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Input::class,
        ]);
    }
}
