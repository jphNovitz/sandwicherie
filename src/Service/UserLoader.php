<?php

namespace App\Service;

use App\Model\UserLoaderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Hateoas\HateoasBuilder;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;


class UserLoader implements UserLoaderInterface {

    protected $container ;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getUser()
    {
        if (!$this->container->has('security.token_storage')) {
            throw new \LogicException('The SecurityBundle is not registered in your application.');
        }
        if (null === $token = $this->container->get('security.token_storage')->getToken()) {
            return false;
        }
        if (!is_object($user = $token->getUser())) {
            return false ;
        }
        return $user;
    }


}