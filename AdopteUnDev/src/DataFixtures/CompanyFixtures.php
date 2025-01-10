<?php

namespace App\DataFixtures;

use App\Entity\Company;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CompanyFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 5; $i++) {
            $company = new Company();
            $company->setName("Company $i")
                    ->setLogo("logo$i.png")
                    ->setBanner("banner$i.png")
                    ->setDescription("This is a description for Company $i.")
                    ->setEmail("company$i@example.com")
                    ->setPassword(password_hash('password', PASSWORD_BCRYPT))
                    ->setRoles('ROLE_COMPANY');

            $manager->persist($company);

            // Ajouter une référence pour l'utiliser dans d'autres fixtures
            $this->addReference('company_' . $i, $company);
        }

        $manager->flush();
    }
}
