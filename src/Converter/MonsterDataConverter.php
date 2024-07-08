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
        // $monsterData['reactions'] = $this->convertReactionInHtml($monsterData['reactions']);

        // $monsterData['damage_vulnerabilities'] = $this->convertDamageVulnerabilities($monsterData['damage_vulnerabilities']);

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
            $html .= '<h5>' . $specialAbility['name'] . '</h4>';
            $html .= '<p>' . $specialAbility['desc'] . '</p>';
        }
        return $html;
    }

    private function convertActionsInHtml($actions) {
        $html = '';
        foreach ($actions as $action) {
            $html .= '<h5>' . $action['name'] . '</h4>';
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
            $html .= '<h5>' . $legendaryAction['name'] . '</h4>';
            $html .= '<p>' . $legendaryAction['desc'] . '</p>';
            if (isset($legendaryAction['usage'])) {
                $html .= '<p>(' . $legendaryAction['usage']['times'] . $legendaryAction ['usage']['type'] . ')</p>';

            }
        $html .= '<br>';
        }
        return $html;
    }

    // private function convertReactionInHtml($reactions) {
    //     $html = '';
    //     foreach ($reactions as $reaction) {
    //         $html .= '<h4>' . $reaction['name'] . '</h4>';
    //         $html .= '<p>' . $reaction['desc'] . '</p>';
    //     }
    //     return $html;
    // }


    //private function convertDamageVulnerabilities($damageVulnerabilities) {
    //    $vulnerabilities = [];
    //    foreach ($damageVulnerabilities as $damageVulnerability) {
    //        $vulnerabilities[] = $this->translateDamageType($damageVulnerability);
    //    }
    //    return $vulnerabilities;
    //}


    private function translateDamageTypeVulnerability($damageTypeVulnerability) {
        $damageTypeTranslations = [
            // Types de dégâts simples
            'acid' => 'vulnerability-acid',
            'bludgeoning' => 'vulnerability-bludgeoning',
            'cold' => 'vulnerability-cold',
            'fire' => 'vulnerability-fire',
            'force' => 'vulnerability-force',
            'lightning' => 'vulnerability-lightning',
            'necrotic' => 'vulnerability-necrotic',
            'piercing' => 'vulnerability-piercing',
            'poison' => 'vulnerability-poison',
            'psychic' => 'vulnerability-psychic',
            'radiant' => 'vulnerability-radiant',
            'slashing' => 'vulnerability-slashing',
            'thunder' => 'vulnerability-thunder',
            
            // Types de dégâts avec conditions
            'non-magical bludgeoning' => 'vulnerability-non-magical-bludgeoning',
            'non-cold iron bludgeoning' => 'vulnerability-non-cold-iron-bludgeoning',
            'non-adamantine bludgeoning' => 'vulnerability-non-adamantine-bludgeoning',
            'non-silver bludgeoning' => 'vulnerability-non-silver-bludgeoning',
            'non-magical piercing' => 'vulnerability-non-magical-piercing',
            'non-cold iron piercing' => 'vulnerability-non-cold-iron-piercing',
            'non-adamantine piercing' => 'vulnerability-non-adamantine-piercing',
            'non-silver piercing' => 'vulnerability-non-silver-piercing',
            'non-magical slashing' => 'vulnerability-non-magical-slashing',
            'non-cold iron slashing' => 'vulnerability-non-cold-iron-slashing',
            'non-adamantine slashing' => 'vulnerability-non-adamantine-slashing',
            'non-silver slashing' => 'vulnerability-non-silver-slashing',
            
            // Combinations de dégâts avec conditions
            'non-magical piercing and slashing' => 'vulnerability-non-magical-piercing-and-slashing',
            'non-cold iron piercing and slashing' => 'vulnerability-non-cold-iron-piercing-and-slashing',
            'non-adamantine piercing and slashing' => 'vulnerability-non-adamantine-piercing-and-slashing',
            'non-silver piercing and slashing' => 'vulnerability-non-silver-piercing-and-slashing',
            'non-magical bludgeoning and slashing' => 'vulnerability-non-magical-bludgeoning-and-slashing',
            'non-cold iron bludgeoning and slashing' => 'vulnerability-non-cold-iron-bludgeoning-and-slashing',
            'non-adamantine bludgeoning and slashing' => 'vulnerability-non-adamantine-bludgeoning-and-slashing',
            'non-silver bludgeoning and slashing' => 'vulnerability-non-silver-bludgeoning-and-slashing',
            'non-magical bludgeoning and piercing' => 'vulnerability-non-magical-bludgeoning-and-piercing',
            'non-cold iron bludgeoning and piercing' => 'vulnerability-non-cold-iron-bludgeoning-and-piercing',
            'non-adamantine bludgeoning and piercing' => 'vulnerability-non-adamantine-bludgeoning-and-piercing',
            'non-silver bludgeoning and piercing' => 'vulnerability-non-silver-bludgeoning-and-piercing',
            
            // Combinaisons multiples
            'non-magical bludgeoning and piercing and slashing' => 'vulnerability-non-magical-bludgeoning-and-piercing-and-slashing',
            'non-cold iron bludgeoning and piercing and slashing' => 'vulnerability-non-cold-iron-bludgeoning-and-piercing-and-slashing',
            'non-adamantine bludgeoning and piercing and slashing' => 'vulnerability-non-adamantine-bludgeoning-and-piercing-and-slashing',
            'non-silver bludgeoning and piercing and slashing' => 'vulnerability-non-silver-bludgeoning-and-piercing-and-slashing',
        ];
        
        return $damageTypeTranslations[$damageTypeVulnerability] ?? null;
    }

    private function translateDamageTypeResistance($damageTypeResistance) {
        $damageTypeTranslations = [
            // Types de dégâts simples
            'acid' => 'resistance-acid',
            'bludgeoning' => 'resistance-bludgeoning',
            'cold' => 'resistance-cold',
            'fire' => 'resistance-fire',
            'force' => 'resistance-force',
            'lightning' => 'resistance-lightning',
            'necrotic' => 'resistance-necrotic',
            'piercing' => 'resistance-piercing',
            'poison' => 'resistance-poison',
            'psychic' => 'resistance-psychic',
            'radiant' => 'resistance-radiant',
            'slashing' => 'resistance-slashing',
            'thunder' => 'resistance-thunder',
            
            // Types de dégâts avec conditions
            'non-magical bludgeoning' => 'resistance-non-magical-bludgeoning',
            'non-cold iron bludgeoning' => 'resistance-non-cold-iron-bludgeoning',
            'non-adamantine bludgeoning' => 'resistance-non-adamantine-bludgeoning',
            'non-silver bludgeoning' => 'resistance-non-silver-bludgeoning',
            'non-magical piercing' => 'resistance-non-magical-piercing',
            'non-cold iron piercing' => 'resistance-non-cold-iron-piercing',
            'non-adamantine piercing' => 'resistance-non-adamantine-piercing',
            'non-silver piercing' => 'resistance-non-silver-piercing',
            'non-magical slashing' => 'resistance-non-magical-slashing',
            'non-cold iron slashing' => 'resistance-non-cold-iron-slashing',
            'non-adamantine slashing' => 'resistance-non-adamantine-slashing',
            'non-silver slashing' => 'resistance-non-silver-slashing',
            
            // Combinations de dégâts avec conditions
            'non-magical piercing and slashing' => 'resistance-non-magical-piercing-and-slashing',
            'non-cold iron piercing and slashing' => 'resistance-non-cold-iron-piercing-and-slashing',
            'non-adamantine piercing and slashing' => 'resistance-non-adamantine-piercing-and-slashing',
            'non-silver piercing and slashing' => 'resistance-non-silver-piercing-and-slashing',
            'non-magical bludgeoning and slashing' => 'resistance-non-magical-bludgeoning-and-slashing',
            'non-cold iron bludgeoning and slashing' => 'resistance-non-cold-iron-bludgeoning-and-slashing',
            'non-adamantine bludgeoning and slashing' => 'resistance-non-adamantine-bludgeoning-and-slashing',
            'non-silver bludgeoning and slashing' => 'resistance-non-silver-bludgeoning-and-slashing',
            'non-magical bludgeoning and piercing' => 'resistance-non-magical-bludgeoning-and-piercing',
            'non-cold iron bludgeoning and piercing' => 'resistance-non-cold-iron-bludgeoning-and-piercing',
            'non-adamantine bludgeoning and piercing' => 'resistance-non-adamantine-bludgeoning-and-piercing',
            'non-silver bludgeoning and piercing' => 'resistance-non-silver-bludgeoning-and-piercing',

            // Combinaisons multiples
            'non-magical bludgeoning and piercing and slashing' => 'resistance-non-magical-bludgeoning-and-piercing-and-slashing',
            'non-cold iron bludgeoning and piercing and slashing' => 'resistance-non-cold-iron-bludgeoning-and-piercing-and-slashing',
            'non-adamantine bludgeoning and piercing and slashing' => 'resistance-non-adamantine-bludgeoning-and-piercing-and-slashing',
            'non-silver bludgeoning and piercing and slashing' => 'resistance-non-silver-bludgeoning-and-piercing-and-slashing',
        ];

        return $damageTypeTranslations[$damageTypeResistance] ?? null;

    }

    private function translateDamageTypeImmunity($damageTypeImmunity) {
        $damageTypeTranslations = [
            // Types de dégâts simples
            'acid' => 'immunity-acid',
            'bludgeoning' => 'immunity-bludgeoning',
            'cold' => 'immunity-cold',
            'fire' => 'immunity-fire',
            'force' => 'immunity-force',
            'lightning' => 'immunity-lightning',
            'necrotic' => 'immunity-necrotic',
            'piercing' => 'immunity-piercing',
            'poison' => 'immunity-poison',
            'psychic' => 'immunity-psychic',
            'radiant' => 'immunity-radiant',
            'slashing' => 'immunity-slashing',
            'thunder' => 'immunity-thunder',
            
            // Types de dégâts avec conditions
            'non-magical bludgeoning' => 'immunity-non-magical-bludgeoning',
            'non-cold iron bludgeoning' => 'immunity-non-cold-iron-bludgeoning',
            'non-adamantine bludgeoning' => 'immunity-non-adamantine-bludgeoning',
            'non-silver bludgeoning' => 'immunity-non-silver-bludgeoning',
            'non-magical piercing' => 'immunity-non-magical-piercing',
            'non-cold iron piercing' => 'immunity-non-cold-iron-piercing',
            'non-adamantine piercing' => 'immunity-non-adamantine-piercing',
            'non-silver piercing' => 'immunity-non-silver-piercing',
            'non-magical slashing' => 'immunity-non-magical-slashing',
            'non-cold iron slashing' => 'immunity-non-cold-iron-slashing',
            'non-adamantine slashing' => 'immunity-non-adamantine-slashing',
            'non-silver slashing' => 'immunity-non-silver-slashing',
            
            // Combinations de dégâts avec conditions
            'non-magical piercing and slashing' => 'immunity-non-magical-piercing-and-slashing',
            'non-cold iron piercing and slashing' => 'immunity-non-cold-iron-piercing-and-slashing',
            'non-adamantine piercing and slashing' => 'immunity-non-adamantine-piercing-and-slashing',
            'non-silver piercing and slashing' => 'immunity-non-silver-piercing-and-slashing',
            'non-magical bludgeoning and slashing' => 'immunity-non-magical-bludgeoning-and-slashing',
            'non-cold iron bludgeoning and slashing' => 'immunity-non-cold-iron-bludgeoning-and-slashing',
            'non-adamantine bludgeoning and slashing' => 'immunity-non-adamantine-bludgeoning-and-slashing',
            'non-silver bludgeoning and slashing' => 'immunity-non-silver-bludgeoning-and-slashing',
            'non-magical bludgeoning and piercing' => 'immunity-non-magical-bludgeoning-and-piercing',
            'non-cold iron bludgeoning and piercing' => 'immunity-non-cold-iron-bludgeoning-and-piercing',
            'non-adamantine bludgeoning and piercing' => 'immunity-non-adamantine-bludgeoning-and-piercing',
            'non-silver bludgeoning and piercing' => 'immunity-non-silver-bludgeoning-and-piercing',

            // Combinaisons multiples
            'non-magical bludgeoning and piercing and slashing' => 'immunity-non-magical-bludgeoning-and-piercing-and-slashing',
            'non-cold iron bludgeoning and piercing and slashing' => 'immunity-non-cold-iron-bludgeoning-and-piercing-and-slashing',
            'non-adamantine bludgeoning and piercing and slashing' => 'immunity-non-adamantine-bludgeoning-and-piercing-and-slashing',
            'non-silver bludgeoning and piercing and slashing' => 'immunity-non-silver-bludgeoning-and-piercing-and-slashing',
        ];

        return $damageTypeTranslations[$damageTypeImmunity] ?? null;
    }





}