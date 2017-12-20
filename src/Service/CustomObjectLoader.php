<?php

namespace App\Service;

use App\Model\CustomObjectLoaderInterface;
use Doctrine\ORM\EntityManagerInterface;


class CustomObjectLoader implements CustomObjectLoaderInterface {

    protected $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function LoadOne()
    {
        // TODO: Implement LoadOne() method.
    }

    public function LoadAll(String $objectname)
    {
        return $this->entityManager
            ->getRepository($objectname)
            ->findAll();
    }

}