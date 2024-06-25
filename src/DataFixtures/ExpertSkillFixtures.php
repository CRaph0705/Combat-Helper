<?php

namespace App\DataFixtures;

use App\Entity\ExpertSkill;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ExpertSkillFixtures extends Fixture
{
    public const EXPERT_SKILL_ACROBATICS = 'expert-skill-acrobatics';
    public const EXPERT_SKILL_ARCANA = 'expert-skill-arcana';
    public const EXPERT_SKILL_ATHLETICS = 'expert-skill-athletics';
    public const EXPERT_SKILL_STEALTH = 'expert-skill-stealth';
    public const EXPERT_SKILL_ANIMAL_HANDLING = 'expert-skill-animal-handling';
    public const EXPERT_SKILL_SLEIGHT_OF_HAND = 'expert-skill-sleight-of-hand';
    public const EXPERT_SKILL_HISTORY = 'expert-skill-history';
    public const EXPERT_SKILL_INTIMIDATION = 'expert-skill-intimidation';
    public const EXPERT_SKILL_INVESTIGATION = 'expert-skill-investigation';
    public const EXPERT_SKILL_MEDICINE = 'expert-skill-medicine';
    public const EXPERT_SKILL_NATURE = 'expert-skill-nature';
    public const EXPERT_SKILL_PERCEPTION = 'expert-skill-perception';
    public const EXPERT_SKILL_INSIGHT = 'expert-skill-insight';
    public const EXPERT_SKILL_PERSUASION = 'expert-skill-persuasion';
    public const EXPERT_SKILL_RELIGION = 'expert-skill-religion';
    public const EXPERT_SKILL_PERFORMANCE = 'expert-skill-performance';
    public const EXPERT_SKILL_SURVIVAL = 'expert-skill-survival';

    public function load(ObjectManager $manager): void
    {
        $acrobatics = new ExpertSkill();
        $acrobatics->setName('Acrobaties');
        $manager->persist($acrobatics);

        $arcana = new ExpertSkill();
        $arcana->setName('Arcanes');
        $manager->persist($arcana);

        $athletics = new ExpertSkill();
        $athletics->setName('Athlétisme');
        $manager->persist($athletics);

        $stealth = new ExpertSkill();
        $stealth->setName('Discrétion');
        $manager->persist($stealth);
        
        $animalHandling = new ExpertSkill();
        $animalHandling->setName('Dressage');
        $manager->persist($animalHandling);
        
        $sleightOfHand = new ExpertSkill();
        $sleightOfHand->setName('Escamotage');
        $manager->persist($sleightOfHand);
        
        $history = new ExpertSkill();
        $history->setName('Histoire');
        $manager->persist($history);
        
        $intimidation = new ExpertSkill();
        $intimidation->setName('Intimidation');
        $manager->persist($intimidation);
        
        $investigation = new ExpertSkill();
        $investigation->setName('Investigation');
        $manager->persist($investigation);
        
        $medicine = new ExpertSkill();
        $medicine->setName('Médecine');
        $manager->persist($medicine);
        
        $nature = new ExpertSkill();
        $nature->setName('Nature');
        $manager->persist($nature);
        
        $perception = new ExpertSkill();
        $perception->setName('Perception');
        $manager->persist($perception);
        
        $insight = new ExpertSkill();
        $insight->setName('Perspicacité');
        $manager->persist($insight);
        
        $persuasion = new ExpertSkill();
        $persuasion->setName('Persuasion');
        $manager->persist($persuasion);
        
        $religion = new ExpertSkill();
        $religion->setName('Religion');
        $manager->persist($religion);
        
        $performance = new ExpertSkill();
        $performance->setName('Représentation');
        $manager->persist($performance);
        
        $survival = new ExpertSkill();
        $survival->setName('Survie');
        $manager->persist($survival);

        $manager->flush();
    }
}