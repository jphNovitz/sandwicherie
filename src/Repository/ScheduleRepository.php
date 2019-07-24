<?php

namespace App\Repository;

use App\Entity\Schedule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Schedule|null find($id, $lockMode = null, $lockVersion = null)
 * @method Schedule|null findOneBy(array $criteria, array $orderBy = null)
 * @method Schedule[]    findAll()
 * @method Schedule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ScheduleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Schedule::class);
    }

//    /**
//     * @return Schedule[] Returns an array of Schedule objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Schedule
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function fetchAll()
    {
        return $this->createQueryBuilder('s')
            ->select('s')
            ->getQuery()
            ->getResult();
    }

    public function groupByDay()
    {
//       return $this->createQueryBuilder('s')
//           ->select('s.id, s.day, s.open, s.close')
//           ->groupBy('s.day')
//           ->getQuery()
//
        $days = $this->createQueryBuilder('s')
            ->select('s.day')
            ->groupBy('s.day')
            ->getQuery()
            ->getScalarResult();

        $all = $this->createQueryBuilder('s')
            ->getQuery()
            ->getScalarResult();

        $list = [];
        foreach ($days as $row):
            $i = 0;
            foreach ($all as $current):
                if($current['s_day'] == $row['day'] ){
                    $list[$row['day']][$i] = $current;
                    $i++;
                }
            endforeach;
        endforeach;

        return $list;
    }
}
