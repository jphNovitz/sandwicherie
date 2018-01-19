<?php

namespace App\Form;

use App\Entity\Allergy;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class AllergyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('categories', EntityType::class,[
                'class'=>'App\Entity\Category',

                'by_reference' => true,
                'multiple' => true,
                'required' => false
            ])
            ->add('ingredients', EntityType::class,[
                'class'=>'App\Entity\Ingredient',
                'by_reference' => false,
                'multiple' => true,
                'required' => false
            ])
            ->add('imageFile', VichImageType::class, [
                'download_label' => '...'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Allergy::class,
        ]);
    }
}
