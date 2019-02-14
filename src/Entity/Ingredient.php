<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Gedmo\Mapping\Annotation as Gedmo;

use Doctrine\ORM\Mapping as ORM;use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IngredientRepository")
 */
class Ingredient
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=80, nullable=false)
     * @Assert\NotBlank(message="N'oubliez pas le nom !")
     */
    private $name;


    /**
     * @var string
     *
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $code;


    /**
     * @var string
     *
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    private $brands;


    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $generic_name_fr;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image_ingredients_url;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image_nutrition_url;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image_url;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ingredients_text_fr;

    /**
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(length=80, unique=true)
     */
    private $slug;

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
     * @var string
     *
     * @ORM\Column(type="string", length=120, nullable=true)
     */
    private $comment;


    /**
     * @var Category
     * @ORM\ManyToMany(targetEntity="App\Entity\Category")
     * @ORM\JoinColumn(nullable=true)
     *
     */
    private $categories;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Ingredient")
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    private $components;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Images_Ingredient", mappedBy="ingredient", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    private $images;

    /**
     * @var boolean
     * @ORM\Column(name="bread", type="boolean", length=1)
     */
    private $bread;

    /**
     * @var boolean
     * @ORM\Column(name="sauce", type="boolean", length=1)
     */
    private $sauce;

    /**
     * @var boolean
     * @ORM\Column(name="vegetable", type="boolean", length=1)
     */
    private $vegetable;

    /**
     * Ingredient constructor.
     */

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->components = new ArrayCollection();
        $this->images = new ArrayCollection();
        $this->bread = false;
        $this->sauce = false;
        $this->vegetable = false;
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
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug): void
    {
        $this->slug = $slug;
    }

    /**
     * @return DateTime
     */
    public function getCreated(): DateTime
    {
        return $this->created;
    }

    /**
     * @param DateTime $created
     */
    public function setCreated(DateTime $created): void
    {
        $this->created = $created;
    }

    /**
     * @return DateTime
     */
    public function getUpdated(): DateTime
    {
        return $this->updated;
    }

    /**
     * @param DateTime $updated
     */
    public function setUpdated(DateTime $updated): void
    {
        $this->updated = $updated;
    }



    /**
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * @param mixed $category
     */
    public function addCategory($category)
    {
        $this->categories->add($category);
        // uncomment if you want to update other side
        //$category->setAllergy($this);
    }


    /**
     * @param mixed $category
     */
    public function removeCategory($category)
    {
        $this->categories->removeElement($category);
        // uncomment if you want to update other side
        //$category->setAllergy(null);
    }


    /**
     * @return Category
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @return mixed
     */
    public function getComponents()
    {
        return $this->components;
    }

    /**
     * @param mixed $component
     */
    public function addcomponent($component)
    {
        $this->components->add($component);
        // uncomment if you want to update other side
        //$category->setAllergy($this);
    }

    /**
     * Remove Ingredient
     *
     * @param Ingredient $component
     *
     *
     */
    public function removeComponent(Ingredient $component){
        $this->components->removeElement($component);
    }


    /**
     * @return ArrayCollection
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
        $image->setIngredient($this);
    }

    /**
     * @param mixed $image
     */
    public function removeImage($image)
    {
        $this->images->removeElement($image);
        $image->removeIngredient($this);
    }

    /**
     * @return bool
     */
    public function isBread(): bool
    {
        return $this->bread;
    }

    /**
     * @param bool $bread
     */
    public function setBread(bool $bread): void
    {
        $this->bread = $bread;
    }

    /**
     * @return bool
     */
    public function isSauce(): bool
    {
        return $this->sauce;
    }

    /**
     * @param bool $sauce
     */
    public function setSauce(bool $sauce): void
    {
        $this->sauce = $sauce;
    }

    /**
     * @return bool
     */
    public function isVegetable(): bool
    {
        return $this->vegetable;
    }

    /**
     * @param bool $vegetable
     */
    public function setVegetable(bool $vegetable): void
    {
        $this->vegetable = $vegetable;
    }

    /**
     * @return string
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getBrands(): ?string
    {
        return $this->brands;
    }

    /**
     * @param string $brands
     */
    public function setBrands(string $brands): void
    {
        $this->brands = $brands;
    }

    /**
     * @return string
     */
    public function getGenericNameFr(): ?string
    {
        return $this->generic_name_fr;
    }

    /**
     * @param string $generic_name_fr
     */
    public function setGenericNameFr(string $generic_name_fr): void
    {
        $this->generic_name_fr = $generic_name_fr;
    }

    /**
     * @return string
     */
    public function getImageIngredientsUrl(): ?string
    {
        return $this->image_ingredients_url;
    }

    /**
     * @param string $image_ingredients_url
     */
    public function setImageIngredientsUrl(string $image_ingredients_url): void
    {
        $this->image_ingredients_url = $image_ingredients_url;
    }

    /**
     * @return string
     */
    public function getImageNutritionUrl(): ?string
    {
        return $this->image_nutrition_url;
    }

    /**
     * @param string $image_nutrition_url
     */
    public function setImageNutritionUrl(string $image_nutrition_url): void
    {
        $this->image_nutrition_url = $image_nutrition_url;
    }

    /**
     * @return string
     */
    public function getImageUrl(): ?string
    {
        return $this->image_url;
    }

    /**
     * @param string $image_url
     */
    public function setImageUrl(string $image_url): void
    {
        $this->image_url = $image_url;
    }

    /**
     * @return string
     */
    public function getIngredientsTextFr(): ?string
    {
        return $this->ingredients_text_fr;
    }

    /**
     * @param string $ingredients_text_fr
     */
    public function setIngredientsTextFr(string $ingredients_text_fr): void
    {
        $this->ingredients_text_fr = $ingredients_text_fr;
    }



    public function __toString()
   {
       return $this->name;
   }


}
