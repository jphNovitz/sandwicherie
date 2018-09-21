<?php

namespace App\Form;

use App\Entity\Input;
use App\Entity\Invoice;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\DateTime;

class InputType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('provider', EntityType::class,[
            'class'=>'App\Entity\Provider',
            'choice_label'=>'name'
        ])
            ->add('comment', TextType::class)
            ->add('tags', CollectionType::class,[
                'entry_type'=>TagType::class,
                'by_reference'=>false,
                'allow_add'  => true,
                'label' => 'tags :',
                'prototype' => true,
                'empty_data' => 'John Doe'
            ])
            ->add('invoices', CollectionType::class,[
                'entry_type'=>InvoiceType::class,
                'allow_add'  => true,
                'allow_delete'  => true,
                'by_reference' => false,
                'label' => 'factures :',
                'prototype' => true
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
