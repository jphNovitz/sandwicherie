<?php

namespace App\Form;

use App\Entity\Cart;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CartType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('client', EntityType::class,[
                'label'=>'Client',
                'class'=>User::class
            ])
            ->add('items', CollectionType::class,[
                'entry_type'=>ItemType::class,
                'prototype'=>true,
                'label'=> ' ',
                'by_reference' => false,
                'allow_add'=>true,
            ])
        ;

//        $builder->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event)  {
//            $data = $event->getData();
//            dump($data['items'][0]['vegetables']);
//            die();
//
//        });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cart::class,
        ]);
    }
}
