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

    public function LoadOne(String $objectname, String $slug)
    {
        return $this->entityManager
            ->getRepository($objectname)
            ->findOneBy(['slug' => $slug]);
    }

    public function LoadAll(String $objectname)
    {
        return $this->entityManager
            ->getRepository($objectname)
            ->findAll();
    }

}