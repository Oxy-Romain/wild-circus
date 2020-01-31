<?php

namespace App\Repository;

use App\Entity\Perform;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Perform|null find($id, $lockMode = null, $lockVersion = null)
 * @method Perform|null findOneBy(array $criteria, array $orderBy = null)
 * @method Perform[]    findAll()
 * @method Perform[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PerformRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Perform::class);
    }


    const MAX_PERFORM = 4;
    /**
     * @return Perform[] Returns an array of Perform objects
     */
        public function findByExampleField()
    {
        $qd = $this->createQueryBuilder('p')
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(self::MAX_PERFORM);
        $query = $qd->getQuery();
        return $query->execute();

    }

    /*
    public function findOneBySomeField($value): ?Perform
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
