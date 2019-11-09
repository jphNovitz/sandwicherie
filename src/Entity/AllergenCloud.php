<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AllergenCloudRepository")
 */
class AllergenCloud
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     *
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="App\Entity\Ingredient", mappedBy="allergenTags")
     *
     */
    private $ingredients;

    /**
     * @ORM\Column(type="string", length=190)
     */
    private $allergenTag;

    /**
     * AllergenCloud constructor.
     */
    public function __construct()
    {
        $this->ingredients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getIngredients()
    {
        return $this->ingredients;
    }

    /**
     * @param mixed $ingredient
     */
    public function addIngredient($ingredient)
    {
        if ($this->ingredients->contains($ingredient)) {
            return;
        }
        $this->ingredients->add($ingredient);
        $ingredient->addAllergenTag($this);


        $this->ingredients->add($ingredient);
//        $ingredient->addAllergenTag($this);
    }


    /**
     * @param mixed $ingredient
     */
    public function removeIngredient($ingredient)
    {
        $this->ingredients->removeElement($ingredient);
//        $ingredient->removeAllergenTag($this);
    }


    /**
     * @return mixed
     */
    public function getAllergenTag()
    {
        return $this->allergenTag;
    }

    /**
     * @param mixed $allergenTag
     */
    public function setAllergenTag($allergenTag): void
    {
        $this->allergenTag = $allergenTag;
    }

 public function __toString()
 {
     return $this->allergenTag;
 }
}
