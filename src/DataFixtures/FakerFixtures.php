<?php
// src/DataFixtures/FakerFixtures.php
namespace App\DataFixtures;

use App\Entity\Creatures;
use App\Entity\Films;
use App\Entity\Tags;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;

use Faker;
use Faker\ORM\Propel\Populator;

/**
 * Class FakerFixtures
 * @package App\DataFixtures
 */
class FakerFixtures extends Fixture
{
    /**
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
    {

    // On configure dans quelles langues nous voulons nos données
    $faker = Faker\Factory::create('fr_BE');

   for ($i = 0; $i < 20; $i++) {
    $creature = new Creatures();
    $creature->setTexteSuite($faker->sentence(3));
    $a=$faker->word;
    $creature->setNom($a);
    $creature->setImage(($i+1).".jpg");
    $creature->setSlug($a);
    $creature->setTexteLead($faker->text(200));
       for ($i = 0; $i < 3; $i++) {
           $a=$faker->word;
           $film = new Films();
           $film->setTitre($a);
           $film->setSlug($a);
           $film->setSynopsis($faker->text);
           $manager->persist($film);
           $creature->setFilm($film);
       }

        $tage = new Tags();
       $b=$faker->domainWord;
        $tage->setNom($b);
        $tage->setSlug($b);
        $manager->persist($tage);
    $creature->AddTag($tage);
    $manager->persist($creature);
    }
    $manager->flush();
    }
}