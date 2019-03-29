<?php

namespace App\Repository;

use App\Entity\Creatures;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Creatures|null find($id, $lockMode = null, $lockVersion = null)
 * @method Creatures|null findOneBy(array $criteria, array $orderBy = null)
 * @method Creatures[]    findAll()
 * @method Creatures[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CreaturesRepository extends ServiceEntityRepository
{
    /**
     * CreaturesRepository constructor.
     * @param \Symfony\Bridge\Doctrine\RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Creatures::class);
    }


    /**
     * @param array $value
     * @return Creatures[] Returns an array of Creatures objects
     */
    public function findByNom(Array $value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere("c.nom LIKE '%".$value[0]."%'")
            ->orderBy('c.dateCreation', 'desc')
            ->join('c.film','f')
            ->join('c.tags','t')
            ->addSelect('f','t')
            ->orWhere("f.titre LIKE '%".$value[0]."%'")
            ->orWhere("t.nom LIKE '%".$value[0]."%'")
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?Creatures
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
