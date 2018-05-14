<?php

namespace App\Form;

use App\Entity\Site;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SiteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, ['label'=>'Nom du site'])
            ->add('subTitle', TextType::class, ['label'=>'Phrase'])
            ->add('introduction', TextareaType::class, [
                'label'=>'Présentation',
                'attr'=>['class'=>'tinymce']])
            ->add('adress', TextType::class, ['label'=>'Adresse'])
            ->add('city', TextType::class, ['label'=>'Localité'])
            ->add('tva', TextType::class, ['label'=>'N° TVA'])
            ->add('phone', TextType::class, ['label'=>'Téléphone'])
            ->add('socialFacebook', TextType::class, ['label'=>'Adresse Facebook'])
            ->add('socialInstagram', TextType::class, ['label'=>'Adresse Instagram'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
           'data_class' => Site::class,
        ]);
    }
}
