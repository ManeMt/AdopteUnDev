<?php

namespace App\Service;

use App\Entity\Developer;
use App\Entity\JobAdd;

class MatchingService
{
    /**
     * Match a developer with a list of job ads.
     *
     * @param Developer $developer
     * @param array $jobAds Array of JobAdd entities
     * @return array Array of matches with scores
     */
    public function match(Developer $developer, array $jobAds): array
    {
        $matches = [];

        foreach ($jobAds as $jobAd) {
            $score = 0;

            // Vérifie la correspondance des langages de programmation
            $developerLanguages = $developer->getProgramingLanguages()->toArray();
            $jobAdLanguages = $jobAd->getProgramingLanguages()->toArray();
            $commonLanguages = array_intersect($developerLanguages, $jobAdLanguages);
            $score += count($commonLanguages) * 2; // Chaque langage commun vaut 2 points

            // Vérifie la correspondance du niveau
            if ($developer->getLevel() >= $jobAd->getLevel()) {
                $score += 3; // Bonus pour un niveau suffisant
            }

            // Vérifie la correspondance de la localisation
            if ($developer->getLocation() && $developer->getLocation() === $jobAd->getLocation()) {
                $score += 2; // Bonus pour la même localisation
            }

            // Vérifie la correspondance du salaire
            if ($developer->getMinSalary() <= $jobAd->getSalary()) {
                $score += 1; // Bonus pour un salaire acceptable
            }

            // Si le score est supérieur à 0, on ajoute le match
            if ($score > 0) {
                $matches[] = [
                    'jobAd' => $jobAd,
                    'score' => $score,
                ];
            }
        }

        // Trie les résultats par score décroissant
        usort($matches, fn($a, $b) => $b['score'] <=> $a['score']);

        return $matches;
    }
}
