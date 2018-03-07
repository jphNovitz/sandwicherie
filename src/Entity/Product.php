<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

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
    * @Assert\NotBlank(message="N'oubliez pas le nom !")
    */
   private $name;

    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(name="slug", type="string", length=90, unique=true)
     */
    private $slug;


    /**
    * @var string
    * @ORM\Column(name="description", type="string", length=255, nullable=true)
    *
    */
   private $description;

   /**
    * @var float
    * @ORM\Column(name="price", type="float", length=3)
    * @Assert\NotBlank(message="Le produit est gratuit ?")
    * @Assert\Type(type="float", message="Le prix est un nombre")
    */
   private $price;

   /**
    * @var boolean
    * @ORM\Column(name="isactive", type="boolean", length=1, nullable=true)
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
    * @ORM\ManyToMany(targetEntity="App\Entity\Ingredient")
    * @ORM\JoinColumn(nullable=true)
    * @ORM\JoinTable(name="product_vegetables")
    *
    */
   private $vegetables;

   /**
    * @var ArrayCollection
    * @ORM\ManyToMany(targetEntity="App\Entity\Ingredient")
    * @ORM\JoinColumn(nullable=true)
    * @ORM\JoinTable(name="product_breads")
    */
   private $breads;

   /**
    * @var ArrayCollection
    * @ORM\ManyToMany(targetEntity="App\Entity\Ingredient")
    * @ORM\JoinColumn(nullable=true)
    * @ORM\JoinTable(name="product_sauces")
    */
   private $sauces;

   /**
    * @var ArrayCollection
    * @ORM\ManyToMany(targetEntity="App\Entity\Type")
    * @ORM\JoinColumn(nullable=true)
    * @ORM\JoinTable(name="product_types")
    * }})
    */
   private $types;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Image", mappedBy="product", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $images;

   public function __construct()
   {
       $this->ingredients = new ArrayCollection();
       $this->vegetables = new ArrayCollection();
       $this->breads = new ArrayCollection();
       $this->sauces = new ArrayCollection();
       $this->types = new ArrayCollection();
       $this->images = new ArrayCollection();
       $this->isActive = true;
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
    public function getName(): ?String
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
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
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
    public function getPrice(): ?float
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
    public function isActive(): ?bool
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
     * @return Collection
     */
    public function getIngredients(): ?Collection
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
     * @return Collection
     */
    public function getVegetables(): ?Collection
    {
        return $this->vegetables;
    }

    /**
     * @param mixed $vegetable
     */
    public function addVegetable($vegetable)
    {
        $this->vegetables->add($vegetable);
        // uncomment if you want to update other side
        //$vegetable->setProduct($this);
    }

    /**
     * @param mixed $vegetable
     */
    public function removeVegetable($vegetable)
    {
        $this->vegetables->removeElement($vegetable);
        // uncomment if you want to update other side
        //$vegetable->setProduct(null);
    }

    /**
     * @return Collection
     */
    public function getBreads(): ?Collection
    {
        return $this->breads;
    }

    /**
     * @param mixed $bread
     */
    public function addBread($bread)
    {
        $this->breads->add($bread);
        // uncomment if you want to update other side
        //$bread->setProduct($this);
    }

    /**
     * @param mixed $bread
     */
    public function removeBread($bread)
    {
        $this->breads->removeElement($bread);
        // uncomment if you want to update other side
        //$bread->setProduct(null);
    }

    /**
     * @return Collection
     */
    public function getSauces(): ?Collection
    {
        return $this->sauces;
    }

    /**
     * @param mixed $sauce
     */
    public function addSauce($sauce)
    {
        $this->sauces->add($sauce);
        // uncomment if you want to update other side
        //$sauce->setProduct($this);
    }

    /**
     * @param mixed $sauce
     */
    public function removeSauce($sauce)
    {
        $this->sauces->removeElement($sauce);
        // uncomment if you want to update other side
        //$sauce->setProduct(null);
    }

    /**
     * @return Collection
     */
    public function getTypes(): ?Collection
    {
        return $this->types;
    }

    /**
     * @param mixed $type
     */
    public function addType($type)
    {
        $this->types->add($type);
        // uncomment if you want to update other side
        //$type->setProduct($this);
    }

    /**
     * @param mixed $type
     */
    public function removeType($type)
    {
        $this->types->removeElement($type);
        // uncomment if you want to update other side
        //$type->setProduct(null);
    }

    /**
     * @return Collection
     */
    public function getImages(): ?Collection
    {
        return $this->images;
    }

    /**
     * @param mixed $image
     */
    public function addImage($image)
    {
        $this->images->add($image);
        // uncomment if you want to update other side
        //$image->setProduct($this);
    }

    /**
     * @param mixed $image
     */
    public function removeImage($image)
    {
        $this->images->removeElement($image);
        // uncomment if you want to update other side
        //$image->setProduct(null);
    }


}
