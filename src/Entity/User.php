<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Types\BooleanType;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=40, unique=true)
     * @Assert\NotBlank(message="Ce champs est obligatoire")
     * @Assert\Length(min="5", max="20", minMessage="Username au moins cinq caractères", maxMessage="trop looongs")
     */
    private $username;

    /**
     * @Assert\NotBlank(message="Ce champs est obligatoire")
     * @Assert\Length(min=5, max=4096,  minMessage="Au moins cinq caractères")
     */
    private $plainPassword;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=60, unique=true, nullable=false)
     * @Assert\NotNull(message="Ce champs est obligatoire")
     * @Assert\NotBlank(message="Ce champs est obligatoire")
     * @Assert\Email(message="Cet email ne semble pas valide")
     */
    private $email;

    /**
     * @var String
     * @ORM\Column(name="last_name", type="string", length=100, nullable=false)
     * @Assert\NotBlank(message="Ce champs est obligatoire")
     */
     private $lastName;

    /**
     * @var String
     * @ORM\Column(name="first_name", type="string", length=100, nullable=false)
     * @Assert\NotBlank(message="Ce champs est obligatoire")
     */
     private $firstName;

    /**
     * @var String
     * @ORM\Column(name="street", type="string", length=100, nullable=true)
     */
     private $street;

    /**
     * @var String
     * @ORM\Column(name="street_nr", type="string", length=5, nullable=true)
     */
     private $streetNr;

    /**
     * @var String
     * @ORM\Column(name="phone", type="string", length=13, nullable=false)
     */
     private $phone;

    /**
     * @var Loyalty $loyalty
     * @ORM\OneToOne(targetEntity="App\Entity\Loyalty", mappedBy="customer")
     */
     private $loyalty;


    /**
     * @var ArrayCollection
     * @ORM\Column(name="roles", type="array")
     */
    private $roles = array();

    /**
     * @var  int $tries
     * @ORM\Column(name="tries", type="integer", length=1, nullable=false)
     */
    private $tries;

    /**
     * @var boolean $isActive
     * @ORM\Column(name="isActive", type="boolean", nullable=false)
     */
    private $isActive;

    public function __construct()
    {
        $this->roles = ["ROLE_USER"];
        $this->setIsActive(false);
        $this->setTries(0);
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
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param mixed $plainPassword
     */
    public function setPlainPassword($plainPassword): void
    {
        $this->plainPassword = $plainPassword;
    }

    /**
     * @return String
     */
    public function getLastName(): ?String
    {
        return $this->lastName;
    }

    /**
     * @param String $lastName
     */
    public function setLastName(String $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return String
     */
    public function getFirstName(): ?String
    {
        return $this->firstName;
    }

    /**
     * @param String $firstName
     */
    public function setFirstName(String $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return String
     */
    public function getStreet(): ?String
    {
        return $this->street;
    }

    /**
     * @param String $street
     */
    public function setStreet(String $street): void
    {
        $this->street = $street;
    }

    /**
     * @return String
     */
    public function getStreetNr(): ?String
    {
        return $this->streetNr;
    }

    /**
     * @param String $streetNr
     */
    public function setStreetNr(String $streetNr): void
    {
        $this->streetNr = $streetNr;
    }
    /**
     * @var String
     * @ORM\OneToOne(targetEntity="App\Entity\City")
     */
    private $city;

    /**
     * @return String
     */
    public function getPhone(): ?String
    {
        return $this->phone;
    }

    /**
     * @param String $phone
     */
    public function setPhone(String $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return String
     */
    public function getEmail(): ?String
    {
        return $this->email;
    }

    /**
     * @param String $email
     */
    public function setEmail(String $email): void
    {
        $this->email = $email;
    }

    /**
     * @return String
     */
    public function getCity(): String
    {
        return $this->city;
    }

    /**
     * @param String $city
     */
    public function setCity(String $city): void
    {
        $this->city = $city;
    }

    /**
     * @return Loyalty
     */
    public function getLoyalty(): Loyalty
    {
        return $this->loyalty;
    }

    /**
     * @param Loyalty $loyalty
     */
    public function setLoyalty(Loyalty $loyalty): void
    {
        $this->loyalty = $loyalty;
    }

    /**
     * @return mixed
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param mixed $role
     */
    public function addRole($role)
    {
        $this->roles->add($role);
        // uncomment if you want to update other side
        //$role->setUser($this);
    }

    /**
     * @param mixed $role
     */
    public function removeRole($role)
    {
        $this->roles->removeElement($role);
        // uncomment if you want to update other side
        //$role->setUser(null);
    }


    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }



    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    /**
     * @return bool
     */
    public function getIsActive(): bool
    {
        return $this->isActive;
    }

    /**
     * @param bool $isActive
     */
    public function setIsActive(bool $isActive): void
    {
        $this->isActive = $isActive;
    }

    /**
     * @return int
     */
    public function getTries(): int
    {
        return $this->tries;
    }

    /**
     * @param int $tries
     */
    public function setTries(int $tries): void
    {
        $this->tries = $tries;
        if ($this->tries >= 3) $this->setIsActive(false);
    }






}
