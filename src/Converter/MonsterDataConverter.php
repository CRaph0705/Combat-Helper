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
}