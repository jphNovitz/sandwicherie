<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SauceRepository")
 */
class Sauce
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
     * @ORM\Column(name="comment", type="string", length=255, nullable=true)
     *
     */
    private $comment;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="App\Entity\Ingredient")
     * @ORM\JoinColumn(nullable=true)
     * @ORM\JoinTable(name="sauce_components")
     *
     */
    private $components;
    /**
     * @var Boolean
     * @ORM\Column(name="is_home_made", type="boolean")
     */
    private $isHomeMade;

    public  function __construct()
    {
        $this->isHomeMade = false;
        $this->components = new ArrayCollection();
    }

    public function __toString()
    {
       return $this->name;
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
    public function getComment(): string
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     */
    public function setComment(string $comment): void
    {
        $this->comment = $comment;
    }

    /**
     * @return bool
     */
    public function isHomeMade(): bool
    {
        return $this->isHomeMade;
    }

    /**
     * @param bool $isHomeMade
     */
    public function setIsHomeMade(bool $isHomeMade): void
    {
        $this->isHomeMade = $isHomeMade;
    }

    /**
     * @return ArrayCollection
     */
    public function getComponents(): ArrayCollection
    {
        return $this->components;
    }

    /**
     * @param mixed $component
     */
    public function addComponent($component)
    {
        $this->components->add($component);
        // uncomment if you want to update other side
        //$component->setSauce($this);
    }

    /**
     * @param mixed $component
     */
    public function removeComponent($component)
    {
        $this->components->removeElement($component);
        // uncomment if you want to update other side
        //$component->setSauce(null);
    }


}
