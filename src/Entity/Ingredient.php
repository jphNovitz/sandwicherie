<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

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
     */
    private $name;

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
     * @var Provider
     * @ORM\ManyToMany(targetEntity="App\Entity\Provider")
     * @ORM\JoinColumn(nullable=true)
     *
     */
    private $providers;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Ingredient")
     * @ORM\JoinColumn(nullable=true)
     */
    private $components;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Image", mappedBy="image_ingredient")
     * @ORM\JoinColumn(nullable=true)
     */
    private $images;

    /**
     * Ingredient constructor.
     */

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->providers = new ArrayCollection();
        $this->components = new ArrayCollection();
        $this->images = new ArrayCollection();
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
     * @return Provider
     */
    public function getProviders()
    {
        return $this->providers;
    }


    /**
     * Add Provider
     * @param Provider $provider
     *
     * @return Provider
     */
    public  function  addProvider(Provider $provider){
        $this->providers[] = $provider;
        return $this;

    }

    /**
     * Remove Provider
     *
     * @param Provider $provider
     *
     *
     */
    public function removeProvider(Provider $provider){
        $this->providers->removeElement($provider);
    }

    /**
     * @return ArrayCollection
     */
    public function getImages(): ArrayCollection
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
        //$image->setIngredient($this);
    }

    /**
     * @param mixed $image
     */
    public function removeImage($image)
    {
        $this->images->removeElement($image);
        // uncomment if you want to update other side
        //$image->setIngredient(null);
    }


    public function __toString()
   {
       return $this->name;
   }


}
