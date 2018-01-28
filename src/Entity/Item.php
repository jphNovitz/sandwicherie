<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ItemRepository")
 */
class Item extends Part
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var Product
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Product", cascade={"persist"})
     *
     */
    private $product;

    public function __construct()
    {
        $this->cart = new ArrayCollection();
    }

    /**
     *
     * @var ArrayCollection $cart
     * @ORM\ManyToMany(targetEntity="App\Entity\Cart", inversedBy="items")
     */
    private $cart;

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
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @param Product $product
     */
    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }

    /**
     * @return string
     */
    public function getCart(): string
    {
        return $this->cart;
    }

    /**
     * @param mixed $cart
     */
    public function addCart($cart)
    {
        $this->cart->add($cart);
        // uncomment if you want to update other side
        //$cart->setItem($this);
    }

    /**
     * @param mixed $cart
     */
    public function removeCart($cart)
    {
        $this->cart->removeElement($cart);
        // uncomment if you want to update other side
        //$cart->setItem(null);
    }


}
