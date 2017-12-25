<?php
namespace App\Service;

use App\Model\CustomPersisterInterface;
use Doctrine\ORM\EntityManagerInterface;
class CustomPersister implements  CustomPersisterInterface{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;

    }

    public function insert($obj)
    {
        $this->entityManager->persist($obj);
        $this->entityManager->flush();
    }
    public function update($obj)
    {
        $this->entityManager->merge($obj);
        $this->entityManager->flush();
    }
}