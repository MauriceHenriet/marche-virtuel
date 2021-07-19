<?php

namespace App\Repository;

use App\Entity\ProfilVendeur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProfilVendeur|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProfilVendeur|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProfilVendeur[]    findAll()
 * @method ProfilVendeur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProfilVendeurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProfilVendeur::class);
    }

    // /**
    //  * @return ProfilVendeur[] Returns an array of ProfilVendeur objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ProfilVendeur
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
