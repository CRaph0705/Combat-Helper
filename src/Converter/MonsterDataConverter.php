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

        if (isset($monsterData['senses'])) {
            $monsterData['senses'] = $this->convertSenses($monsterData['senses']);
        }

        // dans $monsterData on va avoir ['languages'], et ['telepathy'].
        // On va devoir les séparer pour les mettre dans des colonnes différentes dans la base de données.
        $languagesAndTelepathy = $this->convertLanguageAndTelepathy($monsterData['languages']);
        $monsterData['languages'] = $languagesAndTelepathy['languages'];
        $monsterData['telepathy'] = $languagesAndTelepathy['telepathy'];

        $monsterData['special_abilities'] = $this->convertSpecialAbilitiesInHtml($monsterData['special_abilities']);
        $monsterData['actions'] = $this->convertActionsInHtml($monsterData['actions']);
        $monsterData['legendary_actions'] = $this->convertLegendaryActionsInHtml($monsterData['legendary_actions']);


        return $monsterData;
    }

    private function convertFeetToMeters($distance) {
        // Extraire la valeur numérique en pieds de la chaîne
        if (preg_match('/(\d+(\.\d+)?) ft./', $distance, $matches)) {
            $feet = (float)$matches[1];
            // Convertir les pieds en mètres (1 pied = 0.3048 mètres)
            $meters = $feet * 0.3048;
            $roundedMeters = round($meters * 2) / 2;
            return $roundedMeters;
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

    private function convertSenses($senses) {
        $convertedSenses = [];
        if (isset($senses['darkvision'])) {
            $convertedSenses['darkvision'] = $this->convertFeetToMeters($senses['darkvision']);
        }
        if (isset($senses['blindsight'])) {
            $convertedSenses['blindsight'] = $this->convertFeetToMeters($senses['blindsight']);
        }
        if (isset($senses['tremorsense'])) {
            $convertedSenses['tremorsense'] = $this->convertFeetToMeters($senses['tremorsense']);
        }
        if (isset($senses['truesight'])) {
            $convertedSenses['truesight'] = $this->convertFeetToMeters($senses['truesight']);
        }

        return $convertedSenses;
    }

    private function convertLanguageAndTelepathy($languages) {
        $languageArray = explode(',', $languages); // sépare les langues par une virgule
        $languageArray = array_map('trim', $languageArray);// retire les espaces en début et fin de chaîne
        // dd( $languageArray);
        $telepathy = null;
        foreach ($languageArray as $key => $language) {
            if (preg_match('/telepathy (\d+) ft\./', $language, $matches)) {
                // si on trouve une correspondance pour la télépathie, on convertit la portée en mètres
                $telepathyString = $matches[0];
                $telepathy = $this->convertFeetToMeters($telepathyString);
                // on retire la télépathie du tableau des langues
                unset($languageArray[$key]);
                break;
            }
        }
        // $languagesCollection = [];
        // foreach ($languageArray as $language) {
        //     $translatedLanguage = $this->translateLanguage($language);
        //     if ($translatedLanguage) {
        //         $languagesCollection[] = $translatedLanguage;
        //     }

        $languagesCollection = array_map(fn($language) => $this->translateLanguage($language), $languageArray);
        $languagesCollection = array_filter($languagesCollection); // Supprime les valeurs null
        
        
        // on va retourner un tableau $languages et un float $telepathy


        return ['languages' => $languagesCollection, 'telepathy' => $telepathy];
    }

    private function translateLanguage($language) {
        $languageTranslations = [
            'Abyssal' => 'Abyssal',
            'Celestial' => 'Céleste',
            'Draconic' => 'Draconique',
            'Deep Speech' => 'Profond',
            'Infernal' => 'Infernal',
            'Primordial' => 'Primordial',
            'Sylvan' => 'Sylvestre',
            'Undercommon' => 'Commun des profondeurs',
            'Common' => 'Commun',
            'Dwarvish' => 'Nain',
            'Elvish' => 'Elfique',
            'Giant' => 'Géant',
            'Goblin' => 'Gobelin',
            'Halfling' => 'Halfelin',
            'Orc' => 'Orque'
        ];
        return $languageTranslations[$language] ?? null;
    }

    private function convertSpecialAbilitiesInHtml($specialAbilities) {
        $html = '';
        foreach ($specialAbilities as $specialAbility) {
            $html .= '<h4>' . $specialAbility['name'] . '</h4>';
            $html .= '<p>' . $specialAbility['desc'] . '</p>';
        }
        return $html;
    }

    private function convertActionsInHtml($actions) {
        $html = '';
        foreach ($actions as $action) {
            $html .= '<h4>' . $action['name'] . '</h4>';
            $html .= '<p>' . $action['desc'] . '</p>';
            if (isset($action['usage'])) {
                $html .= '<p>(' . $action['usage']['times'] . $action ['usage']['type'] . ')</p>';

            }
        $html .= '<br>';
        }
        return $html;
    }

    private function convertLegendaryActionsInHtml($legendaryActions) {
        $html = '';
        foreach ($legendaryActions as $legendaryAction) {
            $html .= '<h4>' . $legendaryAction['name'] . '</h4>';
            $html .= '<p>' . $legendaryAction['desc'] . '</p>';
            if (isset($legendaryAction['usage'])) {
                $html .= '<p>(' . $legendaryAction['usage']['times'] . $legendaryAction ['usage']['type'] . ')</p>';

            }
        $html .= '<br>';
        }
        return $html;
    }
}