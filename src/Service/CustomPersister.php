<?php

namespace App\Service;

use App\Model\CustomPersisterInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Persisters\PersisterException;

class CustomPersister implements CustomPersisterInterface
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;

    }

    public function insert($obj)
    {
        try {
            $this->entityManager->persist($obj);
            $this->entityManager->flush();
            return true;
        } catch (\Exception $e) {

            return false;
        }
    }

    public function update($obj)
    {
        try {
            $this->entityManager->merge($obj);
            $this->entityManager->flush();
            return true;
        } catch (\Exception $e) {

            return false;
        }
    }

    public function delete($obj)
    {
        try{
            $this->entityManager->remove($obj);
            $this->entityManager->flush();
            return true;
        } catch (\Exception $e) {
            var_dump($e);
            return false;
        }

    }
}