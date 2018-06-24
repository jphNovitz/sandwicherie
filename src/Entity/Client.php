<?php

namespace App\Entity;

use FOS\OAuthServerBundle\Entity\Client as BaseClient;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Client extends BaseClient
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * @return array
     */
    public function getAllowedGrantTypes(): array
    {
        return $this->allowedGrantTypes;
    }

    /**
     * @param array $allowedGrantTypes
     */
    public function setAllowedGrantTypes(array $allowedGrantTypes): void
    {
        $this->allowedGrantTypes = $allowedGrantTypes;
    }

    /**
     * @return string
     */
    public function getRandomId(): string
    {
        return $this->randomId;
    }

    /**
     * @param string $randomId
     */
    public function setRandomId($random): void
    {
        $this->randomId = $random;
    }

    /**
     * @return string
     */
    public function getSecret(): string
    {
        return $this->secret;
    }

    /**
     * @param string $secret
     */
    public function setSecret($secret): void
    {
        $this->secret = $secret;
    }

    /**
     * @return array
     */
    public function getRedirectUris(): array
    {
        return $this->redirectUris;
    }

    /**
     * @param array $redirectUris
     */
    public function setRedirectUris(array $redirectUris): void
    {
        $this->redirectUris = $redirectUris;
    }


}
