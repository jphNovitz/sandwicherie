<?php

namespace App\Entity;

use DateTime;
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
     * @var datetime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @var datetime $updated
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updated;

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
    * @var boolean
    * @ORM\Column(name="featured", type="boolean", length=1, nullable=true)
    */
   private $featured;

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

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\User", mappedBy="likes")
     */
    private $likedBy;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\User", mappedBy="discoveries")
     */
    private $interestedBy;

    /**
     * Product constructor.
     */

   public function __construct()
   {
       $this->ingredients = new ArrayCollection();
       $this->vegetables = new ArrayCollection();
       $this->breads = new ArrayCollection();
       $this->sauces = new ArrayCollection();
       $this->types = new ArrayCollection();
       $this->images = new ArrayCollection();
       $this->isActive = true;
       $this->featured = false;
       $this->likedBy = new ArrayCollection();
       $this->interestedBy = new ArrayCollection();
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
     * @return datetime
     */
    public function getCreated(): ?datetime
    {
        return $this->created;
    }



    /**
     * @param datetime $created
     */
    public function setCreated(datetime $created): void
    {
        $this->created = $created;
    }

    /**
     * @return datetime
     */
    public function getUpdated(): datetime
    {
        return $this->updated;
    }

    /**
     * @param datetime $updated
     */
    public function setUpdated(datetime $updated): void
    {
        $this->updated = $updated;
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
     * @return bool
     */
    public function isFeatured(): bool
    {
        return $this->featured;
    }

    /**
     * @param bool $featured
     */
    public function setFeatured(bool $featured): void
    {
        $this->featured = $featured;
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
        $image->setProduct($this);
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

    /**
     * @return ArrayCollection
     */
    public function getLikedBy(): ?Collection
    {
        return $this->likedBy;
    }

    /**
     * @param mixed $likedBy
     */
    public function addLikedBy($likedBy)
    {
        $this->likedBy->add($likedBy);
        $likedBy->addLike($this);
    }

    /**
     * @param mixed $likedBy
     */
    public function removeLikedBy($likedBy)
    {
        $this->likedBy->removeElement($likedBy);
        $likedBy->removeLike($this);
    }

    /**
     * @return ArrayCollection
     */
    public function getInterestedBy(): ?Collection
    {
        return $this->interestedBy;
    }

    /**
     * @param mixed $interestedBy
     */
    public function addInterestedBy($interestedBy)
    {
        $this->interestedBy->add($interestedBy);
        // uncomment if you want to update other side
        //$interestedBy->setProduct($this);
    }

    /**
     * @param mixed $interestedBy
     */
    public function removeInterestedBy($interestedBy)
    {
        $this->interestedBy->removeElement($interestedBy);
        // uncomment if you want to update other side
        //$interestedBy->setProduct(null);
    }


    public function __toString()
    {
       return $this->name;
    }

}
