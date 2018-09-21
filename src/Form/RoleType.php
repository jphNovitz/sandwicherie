<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class RoleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('roles', ChoiceType::class, [
            'expanded'=>true,
            'mapped'=> true,
            'multiple'=>true,
            'choices'=>[
                'Administrateur'=>'ROLE_ADMIN',
                'Membre de l\'équipe'=>'ROLE_MEMBER',
                'Utilisateur'=>'ROLE_USER'
            ]
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
