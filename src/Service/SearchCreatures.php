<?php
namespace App\Service;

use App\Entity\Creatures;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class SearchCreatures{
    private $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em=$em;
    }

    public function search($sk){
        $strarray=preg_split('/\s+/', $sk);
        $result=$this->em->getRepository(Creatures::class)->findByNom($strarray);
        return $result;
    }
}