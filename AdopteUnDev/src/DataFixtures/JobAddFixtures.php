<?php

namespace App\DataFixtures;

use App\Entity\JobAdd;
use App\Entity\Company;
use App\Entity\Location;
use App\Entity\ProgramingLanguage;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class JobAddFixtures extends Fixture
{
    // Define constants for predefined entities
    const COMPANIES = [
        'Company A',
        'Company B',
        'Company C',
    ];

    const LOCATIONS = [
        'New York',
        'San Francisco',
        'London',
    ];

    const LANGUAGES = [
        'PHP',
        'JavaScript',
        'Python',
    ];

    public function load(ObjectManager $manager): void
    {
        // Create instances of predefined companies, locations, and languages
        $companies = $this->createCompanies($manager);
        $locations = $this->createLocations($manager);
        $languages = $this->createLanguages($manager);

        // Now create job ads
        for ($i = 1; $i <= 10; $i++) {
            $jobAdd = new JobAdd();
            $jobAdd->setPostTitle("Job Title $i")
                   ->setLevel(rand(1, 5))
                   ->setSalary(rand(30000, 100000))
                   ->setDescription("Job Description $i")
                   ->setLocation($locations[array_rand($locations)])
                   ->setCompany($companies[array_rand($companies)]);

            // Add programming languages
            for ($j = 0; $j < rand(1, 3); $j++) {
                $jobAdd->addProgramingLanguage($languages[array_rand($languages)]);
            }

            $manager->persist($jobAdd);
        }

        $manager->flush();
    }

    private function createCompanies(ObjectManager $manager): array
    {
        $companies = [];
        foreach (self::COMPANIES as $companyName) {
            $company = new Company();
            $company->setName($companyName);
            $manager->persist($company);
            $companies[] = $company;
        }
        $manager->flush();

        return $companies;
    }

    private function createLocations(ObjectManager $manager): array
    {
        $locations = [];
        foreach (self::LOCATIONS as $locationName) {
            $location = new Location();
            $location->setEntitled($locationName);
            $manager->persist($location);
            $locations[] = $location;
        }
        $manager->flush();

        return $locations;
    }

    private function createLanguages(ObjectManager $manager): array
    {
        $languages = [];
        foreach (self::LANGUAGES as $languageName) {
            $language = new ProgramingLanguage();
            $language->setEntitled($languageName);
            $manager->persist($language);
            $languages[] = $language;
        }
        $manager->flush();

        return $languages;
    }
}
