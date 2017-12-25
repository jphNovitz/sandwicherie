<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AllergyRepository")
 */
class Allergy
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="name")
     */
    private $name;

    /**
     * @var Category
     * @ORM\ManyToMany(targetEntity="App\Entity\Category")
     * @ORM\JoinColumn(nullable=true)
     *
     */
    private $categories;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="App\Entity\Ingredient", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $ingredients;

    public function __construct()
    {
        $this->categories =  new ArrayCollection();
        $this->ingredients =  new ArrayCollection();
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
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param mixed $ingredient
     */
    public function addIngredient($ingredient)
    {
        $this->ingredients->add($ingredient);
        // uncomment if you want to update other side
        //$ingredient->setAllergy($this);
    }

    /**
     * @param mixed $ingredient
     */
    public function removeIngredient($ingredient)
    {
        $this->ingredients->removeElement($ingredient);
        // uncomment if you want to update other side
        //$ingredient->setAllergy(null);
    }

    /**
     * @return ArrayCollection
     */
    public function getIngredients(): ArrayCollection
    {
        return new ArrayCollection($this->ingredients->getValues());
    }

    /**
     * @return ArrayCollection
     */
    public function getCategories(): ArrayCollection
    {
        return new ArrayCollection($this->categories->getValues());
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


}
