<?php
// src/DataFixtures/FakerFixtures.php
namespace App\DataFixtures;

use App\Entity\Creatures;
use App\Entity\Films;
use App\Entity\Tags;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

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

        ini_set('memory_limit', '-1');
   for ($i = 0; $i < 20; $i++) {
    $creature = new Creatures();
    $creature->setTexteSuite($faker->text(100));
    $creature->setNom($faker->domainWord);
    $creature->setImage(($i+1).".jpg");
    $creature->setTexteLead($faker->text(200));
       for ($j = 0; $j < 3; $j++) {
           $film = new Films();
           $film->setTitre($faker->company);
           $film->setSynopsis($faker->text);
           $manager->persist($film);
           $creature->setFilm($film);
       }

        $tage = new Tags();
        $tage->setNom($faker->domainWord);
        $manager->persist($tage);
    $creature->AddTag($tage);
    $manager->persist($creature);
    }
    $manager->flush();
    }
}