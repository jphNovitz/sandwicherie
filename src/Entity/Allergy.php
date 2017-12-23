<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections;

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
     *
     * @ORM\Column(name="name", nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", nullable=false)
     */
    private $description;

    /**
     * @var Category
     * @ORM\ManyToMany(targetEntity="App\Entity\Category")
     * @ORM\JoinColumn(nullable=true)
     */
    private $forbiddenCategories;

    public function __construct()
    {
        $this->forbiddenCategories= new ArrayCollection();
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
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * @return Category
     */
    public function getForbiddenCategories()
    {
        return $this->forbiddenCategories;
    }

    /**
     * Add ForbiddenCategory
     * @param Category $forbiddenCategory
     *
     * @return forbiddenCategory
     */
    public  function  addforbiddenCategory(Category $forbiddenCategory){
        $this->forbiddenCategories[] = $forbiddenCategory;
        return $this;

    }


}
