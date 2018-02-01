<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LineRepository")
 */
class Line extends Part
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var datetime $dateEntry
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateEntry;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Ingredient")
     */
    private $ingredient;

    /**
     * @var Float
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\OneToOne(targetEntity="provider")
     * @ORM\Column(nullable=false)
     */
    private $provider;

    /**
     * @var integer
     *
     * @ORM\Column(type="smallint", length=2, nullable=true)
     * @Assert\Length(max="2", maxMessage="Trop chaud !")
     */
    private $temperature;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=12, nullable=true, unique=true)
     */
    private $barcode;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Input", inversedBy="lines")
     */
    private $input;

    public function __construct()
    {
        $this->dateEntry = new \DateTime();
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

    /**²
     * @return Float
     */
    public function getPrice(): ?Float
    {
        return $this->price;
    }

    /**
     * @param Float $price
     */
    public function setPrice(Float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * @param mixed $provider
     */
    public function setProvider($provider): void
    {
        $this->provider = $provider;
    }

    /**
     * @return mixed
     */
    public function getIngredient()
    {
        return $this->ingredient;
    }

    /**
     * @param mixed $ingredient
     */
    public function setIngredient($ingredient): void
    {
        $this->ingredient = $ingredient;
    }

    /**
     * @return int
     */
    public function getTemperature(): ?int
    {
        return $this->temperature;
    }

    /**
     * @param int $temperature
     */
    public function setTemperature(int $temperature): void
    {
        $this->temperature = $temperature;
    }

    /**
     * @return mixed
     */
    public function getInput()
    {
        return $this->input;
    }

    /**
     * @param mixed $input
     */
    public function setInput($input): void
    {
        $this->input = $input;
    }

    /**
     * @return string
     */
    public function getBarcode(): ?string
    {
        return $this->barcode;
    }

    /**
     * @param string $barcode
     */
    public function setBarcode(string $barcode): void
    {
        $this->barcode = $barcode;
    }



}
