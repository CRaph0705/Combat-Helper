<?php

namespace App\Converter;

use App\Entity\Monster;

class MonsterDataConverter
{
    public function convert(array $monsterData): array
    {
        $speed = $monsterData['speed'];
        $speedTypes = ['walk' => 'groundspeed', 'fly' => 'flyspeed', 'swim' => 'swimspeed', 'burrow' => 'burrowspeed', 'climb' => 'climbspeed'];
        
        foreach ($speedTypes as $type => $attribute) {
            if (isset($speed[$type])) {
                $monsterData[$attribute] = $this->convertFeetToMeters($speed[$type]);
            }
        }

        // convert sizes to lower case
        $monsterData['size'] = $this->translateSize($monsterData['size']);
        $monsterData['alignment'] = $this->translateAlignment($monsterData['alignment']);
        $monsterData['type'] = $this->translateType($monsterData['type']);
        $monsterData['challenge'] = $this->translateChallenge($monsterData['challenge_rating']);





        return $monsterData;
    }

    private function convertFeetToMeters($distance) {
        // Extraire la valeur numérique en pieds de la chaîne
        if (preg_match('/(\d+(\.\d+)?) ft./', $distance, $matches)) {
            $feet = (float)$matches[1];
            // Convertir les pieds en mètres (1 pied = 0.3048 mètres)
            $meters = $feet * 0.3048;
            return $meters;
        }
        return null; // Ou une valeur par défaut si la conversion échoue
    }
    
    private function translateSize($size) {
        $sizeTranslations = [
            'Tiny' => 'Très petit',
            'Small' => 'Petit',
            'Medium' => 'Moyen',
            'Large' => 'Grand',
            'Huge' => 'Très grand',
            'Gargantuan' => 'Gigantesque'
        ];
        return $sizeTranslations[$size] ?? null;
    }

    private function translateAlignment($alignment) {
        $alignmentTranslations = [
            'lawful good' => 'Loyal Bon',
            'neutral good' => 'Neutre Bon',
            'chaotic good' => 'Chaotique Bon',
            'lawful neutral' => 'Loyal Neutre',
            'true neutral' => 'Neutre',
            'chaotic neutral' => 'Chaotique Neutre',
            'lawful evil' => 'Loyal Mauvais',
            'neutral evil' => 'Neutre Mauvais',
            'chaotic evil' => 'Chaotique Mauvais',
            'unaligned' => 'Non aligné'
        ];
        return $alignmentTranslations[$alignment] ?? null;
    }

    private function translateType($type) {
        $typeTranslations = [
            'aberration' => 'Aberration',
            'beast' => 'Bête',
            'celestial' => 'Céleste',
            'construct' => 'Créature artificielle',
            'dragon' => 'Dragon',
            'elemental' => 'Élémentaire',
            'fey' => 'Fée',
            'fiend' => 'Fiélon',
            'giant' => 'Géant',
            'humanoid' => 'Humanoïde',
            'monstrosity' => 'Monstruosité',
            'ooze' => 'Vase',
            'plant' => 'Plante',
            'undead' => 'Mort-vivant'
        ];
        return $typeTranslations[$type] ?? null;
    }

    private function translateChallenge($challenge) {
        $challengeTranslations = [
            0 => '0',
            0.125 => '1/8',
            0.25 => '1/4',
            0.5 => '1/2',
            1 => '1',
            2 => '2',
            3 => '3',
            4 => '4',
            5 => '5',
            6 => '6',
            7 => '7',
            8 => '8',
            9 => '9',
            10 => '10',
            11 => '11',
            12 => '12',
            13 => '13',
            14 => '14',
            15 => '15',
            16 => '16',
            17 => '17',
            18 => '18',
            19 => '19',
            20 => '20',
            21 => '21',
            22 => '22',
            23 => '23',
            24 => '24',
            25 => '25',
            26 => '26',
            27 => '27',
            28 => '28',
            29 => '29',
            30 => '30'
        ];
        return $challengeTranslations[$challenge] ?? null;
    }
}