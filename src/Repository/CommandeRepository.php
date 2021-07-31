<?php

namespace App\Repository;

use App\Entity\User;
use App\Entity\Commande;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Commande|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commande|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commande[]    findAll()
 * @method Commande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commande::class);
    }

/******************Acheteur************************ */

    /**
     * @return Commande[] Returns an array of Commande objects
     */
    public function findCommandesAcheteurAFacturer(User $user)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.user = :user_id')
            ->setParameter('user_id', $user)
            ->andWhere('c.status = :status')
            ->setParameter('status', 'a-facturer')
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return Commande[] Returns an array of Commande objects
     */
    public function findCommandesAcheteurAttentePaiement(User $user)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.user = :user_id')
            ->setParameter('user_id', $user)
            ->andWhere('c.status = :status')
            ->setParameter('status', 'paiement-attente')
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }    

    /**
     * @return Commande[] Returns an array of Commande objects
     */
    public function findCommandesAcheteurAEnvoyer(User $user)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.user = :user_id')
            ->setParameter('user_id', $user)
            ->andWhere('c.status = :status')
            ->setParameter('status', 'a-envoyer')
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    } 

    /**
     * @return Commande[] Returns an array of Commande objects
     */
    public function findCommandesAcheteurLivraison(User $user)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.user = :user_id')
            ->setParameter('user_id', $user)
            ->andWhere('c.status = :status')
            ->setParameter('status', 'livraison')
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }         

    /**
     * @return Commande[] Returns an array of Commande objects
     */
    public function findCommandesAcheteurLivree(User $user)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.user = :user_id')
            ->setParameter('user_id', $user)
            ->andWhere('c.status = :status')
            ->setParameter('status', 'livree')
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }     

    /**
     * @return Commande[] Returns an array of Commande objects
     */
    public function findCommandesAcheteurRefusee(User $user)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.user = :user_id')
            ->setParameter('user_id', $user)
            ->andWhere('c.status = :status')
            ->setParameter('status', 'refusee')
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }     

    /**
     * @return Commande[] Returns an array of Commande objects
     */
    public function findCommandesAcheteurAnnulee(User $user)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.user = :user_id')
            ->setParameter('user_id', $user)
            ->andWhere('c.status = :status')
            ->setParameter('status', 'annulee')
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }     



    // /**
    //  * @return Commande[] Returns an array of Commande objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Commande
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
