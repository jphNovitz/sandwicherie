<?php

namespace App\Form;

use App\Entity\Ingredient;
use App\Entity\Item;
use App\Entity\Product;
use App\Repository\IngredientRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityRepository;
use JMS\Serializer\Tests\Fixtures\VehicleInterfaceGarage;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('qty', IntegerType::class, [
                'label'=>'Quantité',
                'data'=>'1'
            ])
            ->add('product', EntityType::class, [
                'class'=> Product::class,
                'label'=> 'Produit'
            ])
            ->add('bread', EntityType::class,[
                'class'=> Ingredient::class,
                'query_builder' => function (IngredientRepository $i) {
                    return $i->findBreads();
                }
            ])
            ->add('vegetables', EntityType::class,[
                'class'=> Ingredient::class,
                'query_builder' => function (IngredientRepository $i) {
                    return $i->findVegetables();
                },
                'multiple'=>true
            ])
            ->add('halal', CheckboxType::class, [
                'label'=>'Halal'
            ])
        ;
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
           'data_class' => Item::class,
        ]);
    }
}
