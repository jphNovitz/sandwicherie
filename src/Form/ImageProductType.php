<?php

namespace App\Form;

use App\Entity\ImageProduct;
use App\Entity\Images_Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Imagesproduct;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ImageProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('imageFile', VichImageType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Images_Product::class,
        ]);
    }
}
