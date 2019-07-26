<?php

namespace App\Form;

use App\Entity\Ingredient;
use App\Entity\Item;
use App\Entity\Product;
use App\Repository\IngredientRepository;
use App\Repository\ProductRepository;
use App\Repository\SauceRepository;
use Doctrine\ORM\EntityRepository;
use JMS\Serializer\Tests\Fixtures\VehicleInterfaceGarage;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
            ->add('mode', ChoiceType::class, [
                'label' => 'Comment vas-tu consommer ?',
                'choices' => [
                    'Emporté' => 'emporte',
                    'Sur Place' =>'sur place'
                    ]
            ])
            ->add('bread', EntityType::class, [
                'label' => 'Choisi ton pain ',
                'class'=> Ingredient::class,
                'query_builder' => function (IngredientRepository $i) {
                    return $i->findBreads();
                }
            ])
            ->add('sauce', EntityType::class, [
                'label' => 'Choisi ta sauce ',
                'class'=> Ingredient::class,
                'query_builder' => function (IngredientRepository $i) {
                    return $i->findSauces();
                }
            ])
            ->add('vegetables', EntityType::class,[
                'label' => 'Choisi tes crudités ',
                'class'=> Ingredient::class,
                'query_builder' => function (IngredientRepository $i) {
                    return $i->findVegetables();
                },
                'multiple'=>true
            ])
            ->add('halal', CheckboxType::class, [
                'label' => 'Halal',
                'required' => 'false'
            ])
            ->add('continue', SubmitType::class, [
                'label' => 'Contiuer mes achats'
            ])
            ->add('basket', SubmitType::class, [
                'label' => 'Aller vers \'mon panier\''
            ])
            ->add('comment', TextType::class, [
                'label' => 'Laisse un commentaire ',
                'required' => false
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
