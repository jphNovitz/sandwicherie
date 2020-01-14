<?php

namespace App\Repository;

use App\Entity\Instagram;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Instagram|null find($id, $lockMode = null, $lockVersion = null)
 * @method Instagram|null findOneBy(array $criteria, array $orderBy = null)
 * @method Instagram[]    findAll()
 * @method Instagram[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InstagramRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry  $registry)
    {
        parent::__construct($registry, Instagram::class);
    }



//    /**
//     * @return Instagram[] Returns an array of Instagram objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Instagram
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */


    public function myFindAll()
    {
        return $this->createQueryBuilder('i')
            ->select('i.id',
                'i.insta_id',
                'i.link',
                'i.caption',
                'i.thumbnail',
                'i.low_resolution',
                'i.standard_resolution')
            ->getQuery()
            ->getScalarResult();
        ;
    }

}
