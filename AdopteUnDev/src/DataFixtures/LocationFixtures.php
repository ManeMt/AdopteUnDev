<?php

namespace App\DataFixtures;

use App\Entity\Location;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class LocationFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        // Générer 10 lieux fictifs
        for ($i = 1; $i <= 10; $i++) {
            $location = new Location();
            $location->setEntitled($faker->city()); // Utilise des noms de ville fictifs
            $manager->persist($location);
        }

        $manager->flush();
    }
}
