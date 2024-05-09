<?php

namespace App\Repository;

use App\Entity\InvestisseurFavorities;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<InvestisseurFavorities>
 *
 * @method InvestisseurFavorities|null find($id, $lockMode = null, $lockVersion = null)
 * @method InvestisseurFavorities|null findOneBy(array $criteria, array $orderBy = null)
 * @method InvestisseurFavorities[]    findAll()
 * @method InvestisseurFavorities[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InvestisseurFavoritiesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InvestisseurFavorities::class);
    }

//    /**
//     * @return InvestisseurFavorities[] Returns an array of InvestisseurFavorities objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?InvestisseurFavorities
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
