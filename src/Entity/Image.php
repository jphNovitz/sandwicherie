<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ImageRepository")
 */
class Image
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var ArrayCollection
     * @Assert\Image()
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Ingredient", inversedBy="images")
     * @ORM\JoinColumn(nullable=true)
     */
    private $images_ingredient;

    /**
     * @var ArrayCollection
     * @Assert\Image()
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Product", inversedBy="images")
     * @ORM\JoinColumn(nullable=true)
     */
    private $images_product;

    /**
     * @var ArrayCollection
     * @Assert\Image()
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Provider", inversedBy="images")
     * @ORM\JoinColumn(nullable=true)
     */
    private $images_provider;

    /**
     * @var String
     * @Assert\Image()
     *
     * @ORM\Column(name="image", type="string")
     */
    private $image;

    private $upImage;


    public function __construct()
    {
        $this->images_ingredient = new ArrayCollection();
        $this->images_product = new ArrayCollection();
        $this->images_provider = new ArrayCollection();
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
    public function getImage(): String
    {
        return $this->image;
    }

    /**
     * @param String $image
     */
    public function setImage(String $image): void
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getUpImage()
    {
        return $this->upImage;
    }

    /**
     * @param mixed $upImage
     */
    public function setUpImage($upImage): void
    {
        $this->upImage = $upImage;
    }

    /**
     * @return ArrayCollection
     */
    public function getImagesIngredient(): ArrayCollection
    {
        return $this->images_ingredient;
    }

    /**
     * @param mixed $images_ingredient
     */
    public function addImagesingredient($images_ingredient)
    {
        $this->images_ingredient->add($images_ingredient);
        $images_ingredient->setImage($this);
    }

    /**
     * @param mixed $images_ingredient
     */
    public function removeImagesingredient($images_ingredient)
    {
        $this->images_ingredient->removeElement($images_ingredient);
        $images_ingredient->setImage(null);
    }

    /**
     * @return ArrayCollection
     */
    public function getImagesProduct(): ArrayCollection
    {
        return $this->images_product;
    }

    /**
     * @param mixed $images_product
     */
    public function addImagesproduct($images_product)
    {
        $this->images_product->add($images_product);
        $images_product->setImage($this);
    }

    /**
     * @param mixed $images_product
     */
    public function removeImagesproduct($images_product)
    {
        $this->images_product->removeElement($images_product);
        $images_product->setImage(null);
    }

    /**
     * @return ArrayCollection
     */
    public function getImagesProvider(): ArrayCollection
    {
        return $this->images_provider;
    }

    /**
     * @param mixed $images_provider
     */
    public function addImagesprovider($images_provider)
    {
        $this->images_provider->add($images_provider);
        $images_provider->setImage($this);
    }

    /**
     * @param mixed $images_provider
     */
    public function removeImagesprovider($images_provider)
    {
        $this->images_provider->removeElement($images_provider);
        $images_provider->setImage(null);
    }


}
