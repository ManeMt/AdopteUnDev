<?php

namespace App\DataFixtures;

use App\Entity\ProgramingLanguage;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProgramingLanguageFixtures extends Fixture
{
    public const LANGUAGES = [
        'PHP', 'JavaScript', 'Python', 'Java', 'C++', 'C#', 'Ruby', 'Swift', 'Go', 'Kotlin',
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::LANGUAGES as $language) {
            $programingLanguage = new ProgramingLanguage();
            $programingLanguage->setEntitled($language);
            $manager->persist($programingLanguage);

            // Ajouter une référence pour chaque langage
            $this->addReference('language_' . strtolower($language), $programingLanguage);
        }

        $manager->flush();
    }
}
