<?php
namespace App\Service;

use App\Entity\Creatures;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class SearchCreatures
 * @package App\Service
 */
class SearchCreatures{
    /**
     * @var \Doctrine\ORM\EntityManagerInterface
     */
    private $em;

    /**
     * SearchCreatures constructor.
     * @param \Doctrine\ORM\EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em=$em;
    }

    /**
     * @param String $sk
     * @return \App\Entity\Creatures[]
     */
    public function search(String $sk){
        return $this->em->getRepository(Creatures::class)->findByNom(preg_split('/\s+/', $sk));
    }
}

// Example - $qb->expr()->in('u.id', array(1, 2, 3))
// Make sure that you do NOT use something similar to $qb->expr()->in('value', array('stringvalue')) as this will cause Doctrine to throw an Exception.
// Instead, use $qb->expr()->in('value', array('?1')) and bind your parameter to ?1 (see section above)
//public function in($x, $y); // Returns Expr\Func instance