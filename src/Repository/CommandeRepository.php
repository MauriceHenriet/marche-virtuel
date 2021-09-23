<?php

namespace App\Repository;

use App\Entity\User;
use App\Entity\Boutique;
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
    public function findCommandesAcheteurAEnvoyer(User $user)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.user = :user_id')
            ->setParameter('user_id', $user)
            ->andWhere('c.status = :status')
            ->setParameter('status', Commande::A_EXPE)
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
            ->setParameter('status', Commande::EN_LIV)
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
            ->setParameter('status', Commande::LIVR)
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }     

/******************Boutique************************ */

    /**
     * @return Commande[] Returns an array of Commande objects
     */
    public function findCommandesBoutiqueAExpedier(Boutique $boutique)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.boutique = :boutique_id')
            ->setParameter('boutique_id', $boutique)
            ->andWhere('c.status = :status')
            ->setParameter('status', Commande::A_EXPE)
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    } 

    /**
     * @return Commande[] Returns an array of Commande objects
     */
    public function findCommandesBoutiqueEnLivraison(Boutique $boutique)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.boutique = :boutique_id')
            ->setParameter('boutique_id', $boutique)
            ->andWhere('c.status = :status')
            ->setParameter('status', Commande::EN_LIV)
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }         

    /**
     * @return Commande[] Returns an array of Commande objects
     */
    public function findCommandesBoutiqueLivree(Boutique $boutique)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.boutique = :boutique_id')
            ->setParameter('boutique_id', $boutique)
            ->andWhere('c.status = :status')
            ->setParameter('status', Commande::LIVR)
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }     
    
/**************************************************************** */


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
