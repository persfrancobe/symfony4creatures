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
     * @param array $arstr
     * @return \Doctrine\ORM\Query
     */
    public function findByNom(Array $arstr)
    {
         $qb=$this->createQueryBuilder('c');
         $qb->orderBy('c.dateCreation', 'desc')
            ->join('c.film','f')
            ->join('c.tags','t')
            ->addSelect('f','t');
         foreach ($arstr as $value) {
             $qb//->orWhere("c.nom LIKE '%".$value."%'")
                 //->orWhere("c.texteSuite LIKE '%".$value."%'")
                 //->orWhere("f.titre LIKE '%".$value."%'")
                 //->orWhere("t.nom LIKE '%".$value."%'")
                 ->orWhere($qb->expr()->like('c.nom', $qb->expr()->literal('%' . $value . '%')))
                 //->orWhere($qb->expr()->like('c.texteSuite', $qb->expr()->literal('%' . $value . '%')))
                 ->orWhere($qb->expr()->like('f.titre', $qb->expr()->literal('%' . $value . '%')))
                 ->orWhere($qb->expr()->like('t.nom', $qb->expr()->literal('%' . $value . '%')));
         }
         return $qb->getQuery();
    }


}