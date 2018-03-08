<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class ParentUser implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var String
     * @ORM\Column(name="last_name", type="string", length=100, nullable=false)
     */
     private $lastName;

    /**
     * @var String
     * @ORM\Column(name="first_name", type="string", length=100, nullable=false)
     */
     private $firstName;

    /**
     * @var String
     * @ORM\Column(name="street", type="string", length=100, nullable=false)
     */
     private $street;

    /**
     * @var String
     * @ORM\Column(name="street_nr", type="string", length=5, nullable=false)
     */
     private $streetNr;

    /**
     * @var String
     * @ORM\Column(name="phone", type="string", length=13, nullable=false)
     */
     private $phone;

    /**
     * @var String
     * @ORM\Column(name="email", type="string", length=100, nullable=false)
     */
     private $email;

    /**
     * @var Loyalty $loyalty
     * @ORM\OneToOne(targetEntity="App\Entity\Loyalty", mappedBy="customer")
     */
     private $loyalty;

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
    public function getLastName(): String
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
    public function getFirstName(): String
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
    public function getStreet(): String
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
    public function getStreetNr(): String
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
    public function getPhone(): String
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
    public function getEmail(): String
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
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
        // TODO: Implement getRoles() method.
    }

    /**
     * Returns the password used to authenticate the user.
     *
     * This should be the encoded password. On authentication, a plain-text
     * password will be salted, encoded, and then compared to this value.
     *
     * @return string The password
     */
    public function getPassword()
    {
        // TODO: Implement getPassword() method.
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
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        // TODO: Implement getUsername() method.
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
}
