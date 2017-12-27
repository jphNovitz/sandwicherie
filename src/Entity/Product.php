<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

   /**
    * @var String
    * @ORM\Column(name="name", type="string", length=80, nullable=false)
    */
   private $name;

   /**
    * @var string
    * @ORM\Column(name="description", type="string", length=255, nullable=true)
    *
    */
   private $description;

   /**
    * @var float
    * @ORM\Column(name="price²", type="float", length=3, nullable=true)
    *
    */
   private $price;

   /**
    * @var boolean
    * @ORM\Column(name="isactive", type="boolean", length=1, nullable=true)
    *
    */
   private $isActive;



   /**
    * @var ArrayCollection
    * @ORM\ManyToMany(targetEntity="App\Entity\Ingredient")
    * @ORM\JoinColumn(nullable=true)
    * @ORM\JoinTable(name="product_ingredients")
    *
    */
   private $ingredients;

   /**
    * @var ArrayCollection
    * @ORM\ManyToMany(targetEntity="App\Entity\Ingredient")
    * @ORM\JoinColumn(nullable=true)
    * @ORM\JoinTable(name="product_vegetables")
    *
    */
   private $vegetables;

   /**
    * @var ArrayCollection
    * @ORM\ManyToMany(targetEntity="App\Entity\Type")
    * @ORM\JoinColumn(nullable=false)
    * @ORM\JoinTable(name="product_types")
    *
    */
   private $types;


   /**
    * @var ArrayCollection
    * @ORM\ManyToMany(targetEntity="App\Entity\Sauce")
    * @ORM\JoinColumn(nullable=true)
    * @ORM\JoinTable(name="product_sauce")
    *
    */
   private $sauce;


   /**
    * @var ArrayCollection
    * @ORM\ManyToMany(targetEntity="App\Entity\Bread")
    * @ORM\JoinColumn(nullable=true)
    * @ORM\JoinTable(name="product_bread")
    *
    */
   private $bread;

   public function __construct()
   {
       $this->ingredients = new ArrayCollection();
       $this->vegetables = new ArrayCollection();
       $this->types = new ArrayCollection();
       $this->bread = new ArrayCollection();
   }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return String
     */
    public function getName(): String
    {
        return $this->name;
    }

    /**
     * @param String $name
     */
    public function setName(String $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->isActive;
    }

    /**
     * @param bool $isActive
     */
    public function setIsActive(bool $isActive): void
    {
        $this->isActive = $isActive;
    }

    /**
     * @return ArrayCollection
     */
    public function getIngredients(): ArrayCollection
    {
        return $this->ingredients;
    }

    /**
     * @param mixed $ingredient
     */
    public function addIngredient($ingredient)
    {
        $this->ingredient->add($ingredient);
        // uncomment if you want to update other side
        //$ingredient->setProduct($this);
    }

    /**
     * @param mixed $ingredient
     */
    public function removeIngredient($ingredient)
    {
        $this->ingredient->removeElement($ingredient);
        // uncomment if you want to update other side
        //$ingredient->setProduct(null);
    }

    /**
     * @return ArrayCollection
     */
    public function getVegetables(): ArrayCollection
    {
        return $this->vegetables;
    }

    /**
     * @param mixed $vegetable
     */
    public function addVegetable($vegetable)
    {
        $this->vegetable->add($vegetable);
        // uncomment if you want to update other side
        //$vegetable->setProduct($this);
    }

    /**
     * @param mixed $vegetable
     */
    public function removeVegetable($vegetable)
    {
        $this->vegetable->removeElement($vegetable);
        // uncomment if you want to update other side
        //$vegetable->setProduct(null);
    }

    /**
     * @return ArrayCollection
     */
    public function getTypes(): ArrayCollection
    {
        return $this->types;
    }

    /**
     * @param mixed $type
     */
    public function addType($type)
    {
        $this->type->add($type);
        // uncomment if you want to update other side
        //$type->setProduct($this);
    }

    /**
     * @param mixed $type
     */
    public function removeType($type)
    {
        $this->type->removeElement($type);
        // uncomment if you want to update other side
        //$type->setProduct(null);
    }

    /**
     * @return ArrayCollection
     */
    public function getSauce(): ArrayCollection
    {
        return $this->sauce;
    }

    /**
     * @param mixed $sauce
     */
    public function removeSauce($sauce)
    {
        $this->sauce->removeElement($sauce);
        // uncomment if you want to update other side
        //$sauce->setProduct(null);
    }

    /**
     * @return ArrayCollection
     */
    public function getBread(): ArrayCollection
    {
        return $this->bread;
    }

    /**
     * @param mixed $bread
     */
    public function addBread($bread)
    {
        $this->bread->add($bread);
        // uncomment if you want to update other side
        //$bread->setProduct($this);
    }

    /**
     * @param mixed $bread
     */
    public function removeBread($bread)
    {
        $this->bread->removeElement($bread);
        // uncomment if you want to update other side
        //$bread->setProduct(null);
    }


}
