<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * @ORM\Entity(repositoryClass="App\Repository\AllergyRepository")
 * @Vich\Uploadable
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
     * @ORM\Column(name="name", length=80)
     *  @Assert\NotBlank(message="Vous avez oubliez de mettre un nom ")
     */
    private $name;

    /**
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(length=80, unique=true)
     */
    private $slug;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="allergy", fileNameProperty="imageName")
     *
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $imageName;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Category")
     * @ORM\JoinColumn(referencedColumnName="id", nullable=true)
     *
     */
    private $categories;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Ingredient", cascade={"persist"})
     * @ORM\JoinColumn(referencedColumnName="id", nullable=true)
     */
    private $ingredients;

    /**
     * Allergy constructor.
     */

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
     * @return File
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     */
    public function setImageFile(File $imageFile): void
    {
        $this->imageFile = $imageFile;
    }

    /**
     * @return string
     */
    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    /**
     * @param string $imageName
     */
    public function setImageName(string $imageName): void
    {
        $this->imageName = $imageName;
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
