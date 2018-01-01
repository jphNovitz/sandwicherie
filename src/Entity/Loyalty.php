<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LoyaltyRepository")
 */
class Loyalty
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
     * @var  datetime $date
     * @ORM\Column(type="date", nullable=false)
     */
    private $date;
    /**
     * @var integer $points
     * @ORM\Column(name="points", type="integer", nullable=false)
     */
    private $points;

    /**
     * @var User $customer
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="loyalty");
     */
    private $customer;

    /**
     * Loyalty constructor.
     */

    public function __construct()
    {
        $this->date= new \DateTime();
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
     * @return datetime
     */
    public function getDate(): datetime
    {
        return $this->date;
    }

    /**
     * @param datetime $date
     */
    public function setDate(datetime $date): void
    {
        $this->date = $date;
    }

    /**
     * @return int
     */
    public function getPoints(): int
    {
        return $this->points;
    }

    /**
     * @param int $points
     */
    public function setPoints(int $points): void
    {
        $this->points = $points;
    }

    /**
     * @return User
     */
    public function getCustomer(): User
    {
        return $this->customer;
    }

    /**
     * @param User $customer
     */
    public function setCustomer(User $customer): void
    {
        $this->customer = $customer;
    }


}
