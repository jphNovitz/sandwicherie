<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InputRepository")
 */
class Input
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Ingredient")
     */
    private $ingredient;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Provider")
     */
    private $provider;

    /**
     * @var integer
     *
     * @ORM\Column(type="smallint", length=2, nullable=true)
     */
    private $temperature;

    /**
     * @var datetime $dateEncode
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateEncode;

    /**
     * @var datetime $dateEntry
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateEntry;


    /**
     * Input constructor.
     */

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
    public function setId($id)
    {
        $this->id = $id;
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
    public function setIngredient($ingredient)
    {
        $this->ingredient = $ingredient;
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
    public function setProvider($provider)
    {
        $this->provider = $provider;
    }

    /**
     * @return int
     */
    public function getTemperature()
    {
        return $this->temperature;
    }

    /**
     * @param int $temperature
     */
    public function setTemperature($temperature)
    {
        $this->temperature = $temperature;
    }

    /**
     * @return datetime
     */
    public function getDateEntry()
    {
        return $this->dateEntry;
    }

    /**
     * @param datetime $dateEntry
     */
    public function setDateEntry($dateEntry)
    {
        $this->dateEntry = $dateEntry;
        return $this;
    }




}
