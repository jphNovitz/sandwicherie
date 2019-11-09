<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RecoverRepository")
 */
class Recover
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     *
     * @ORM\Column(type="string", length=192, unique=true)
     */
    private $uniqId;

    /**
     * @ORM\Column(type="string", length=60, unique=true)
     * @Assert\Email(message="Cet email ne semble pas valide")
     */
    private $email;

    public function __construct()
    {
        $this->uniqId = uniqId('',false);
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
     * @return mixed
     */
    public function getUniqId()
    {
        return $this->uniqId;
    }

    /**
     * @param mixed $uniqId
     */
    public function setUniqId($uniqId): void
    {
        $this->uniqId = $uniqId;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }


}
