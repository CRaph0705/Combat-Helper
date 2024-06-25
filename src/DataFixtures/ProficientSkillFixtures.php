<?php

namespace App\DataFixtures;

use App\Entity\ProficientSkill;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProficientSkillFixtures extends Fixture
{
    public const PROFICIENT_SKILL_ACROBATICS = 'proficient-skill-acrobatics';
    public const PROFICIENT_SKILL_ARCANA = 'proficient-skill-arcana';
    public const PROFICIENT_SKILL_ATHLETICS = 'proficient-skill-athletics';
    public const PROFICIENT_SKILL_STEALTH = 'proficient-skill-stealth';
    public const PROFICIENT_SKILL_ANIMAL_HANDLING = 'proficient-skill-animal-handling';
    public const PROFICIENT_SKILL_SLEIGHT_OF_HAND = 'proficient-skill-sleight-of-hand';
    public const PROFICIENT_SKILL_HISTORY = 'proficient-skill-history';
    public const PROFICIENT_SKILL_INTIMIDATION = 'proficient-skill-intimidation';
    public const PROFICIENT_SKILL_INVESTIGATION = 'proficient-skill-investigation';
    public const PROFICIENT_SKILL_MEDICINE = 'proficient-skill-medicine';
    public const PROFICIENT_SKILL_NATURE = 'proficient-skill-nature';
    public const PROFICIENT_SKILL_PERCEPTION = 'proficient-skill-perception';
    public const PROFICIENT_SKILL_INSIGHT = 'proficient-skill-insight';
    public const PROFICIENT_SKILL_PERSUASION = 'proficient-skill-persuasion';
    public const PROFICIENT_SKILL_RELIGION = 'proficient-skill-religion';
    public const PROFICIENT_SKILL_PERFORMANCE = 'proficient-skill-performance';
    public const PROFICIENT_SKILL_SURVIVAL = 'proficient-skill-survival';

    public function load(ObjectManager $manager): void
    {
        $acrobatics = new ProficientSkill();
        $acrobatics->setName('Acrobaties');
        $manager->persist($acrobatics);

        $arcana = new ProficientSkill();
        $arcana->setName('Arcanes');
        $manager->persist($arcana);

        $athletics = new ProficientSkill();
        $athletics->setName('Athlétisme');
        $manager->persist($athletics);

        $stealth = new ProficientSkill();
        $stealth->setName('Discrétion');
        $manager->persist($stealth);
        
        $animalHandling = new ProficientSkill();
        $animalHandling->setName('Dressage');
        $manager->persist($animalHandling);
        
        $sleightOfHand = new ProficientSkill();
        $sleightOfHand->setName('Escamotage');
        $manager->persist($sleightOfHand);
        
        $history = new ProficientSkill();
        $history->setName('Histoire');
        $manager->persist($history);
        
        $intimidation = new ProficientSkill();
        $intimidation->setName('Intimidation');
        $manager->persist($intimidation);
        
        $investigation = new ProficientSkill();
        $investigation->setName('Investigation');
        $manager->persist($investigation);
        
        $medicine = new ProficientSkill();
        $medicine->setName('Médecine');
        $manager->persist($medicine);
        
        $nature = new ProficientSkill();
        $nature->setName('Nature');
        $manager->persist($nature);
        
        $perception = new ProficientSkill();
        $perception->setName('Perception');
        $manager->persist($perception);
        
        $insight = new ProficientSkill();
        $insight->setName('Perspicacité');
        $manager->persist($insight);
        
        $persuasion = new ProficientSkill();
        $persuasion->setName('Persuasion');
        $manager->persist($persuasion);
        
        $religion = new ProficientSkill();
        $religion->setName('Religion');
        $manager->persist($religion);
        
        $performance = new ProficientSkill();
        $performance->setName('Représentation');
        $manager->persist($performance);
        
        $survival = new ProficientSkill();
        $survival->setName('Survie');
        $manager->persist($survival);

        $manager->flush();
    }
}