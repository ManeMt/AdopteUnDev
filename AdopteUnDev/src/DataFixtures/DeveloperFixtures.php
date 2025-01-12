<?php

namespace App\DataFixtures;

use App\Entity\Developer;
use App\Entity\ProgramingLanguage;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class DeveloperFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $developer = new Developer();
            $developer->setFirstName("DevFirstName$i")
                      ->setLastName("DevLastName$i")
                      ->setBiography("Biography of developer $i")
                      ->setMinSalary(rand(30000, 100000))
                      ->setLevel(rand(1, 5))
                      ->setAvatar("avatar$i.png")
                      ->setEmail("developer$i@example.com")
                      ->setPassword(password_hash('password', PASSWORD_BCRYPT))
                      ->setRoles('ROLE_DEVELOPER');

            // Ajouter des langages aléatoires
            // for ($j = 1; $j <= rand(1, 3); $j++) {
            //     $randomLanguage = ProgramingLanguageFixtures::LANGUAGES[array_rand(ProgramingLanguageFixtures::LANGUAGES)];
            //     $languageReference = 'language_' . strtolower($randomLanguage);
            //     $programingLanguage = $this->getReference($languageReference, ProgramingLanguage::class);

            //     // Assurez-vous que $programingLanguage est bien une instance de ProgramingLanguage
            //     $developer->addProgramingLanguage($programingLanguage);

            // }

            $manager->persist($developer);

            // Ajouter une référence pour l'utiliser dans d'autres fixtures
            $this->addReference('developer_' . $i, $developer);
        }

        $manager->flush();
    }
}
