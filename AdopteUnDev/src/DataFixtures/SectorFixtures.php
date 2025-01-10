<?php

namespace App\DataFixtures;

use App\Entity\Sector;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class SectorFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        // Exemple : Générer 5 secteurs
        for ($i = 1; $i <= 5; $i++) {
            $sector = new Sector();
            $sector->setEntitled($faker->jobTitle()); // Nom fictif pour un secteur
            $manager->persist($sector);
        }

        $manager->flush();
    }
}
