<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ItemRepository")
 */
class Item
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
     * @var datetime $created
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updated;

    /**
     * @var Product
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Product", cascade={"persist"})
     *
     */
    private $product;
    /**
     * @var int
     *
     * @ORM\Column(name="Quantity", type="integer", nullable=true)
     */
    private $quantity;

    /**
     *@var string $cart
     *@ORM\ManyToMany(targetEntity="App\Entity\Cart", inversedBy="items")
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
     * @return datetime
     */
    public function getCreated(): datetime
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
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return string
     */
    public function getCart(): string
    {
        return $this->cart;
    }

    /**
     * @param string $cart
     */
    public function setCart(string $cart): void
    {
        $this->cart = $cart;
    }

}
