<?php

namespace App\DataFixtures;

use App\Entity\ProficientSkill;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProficientSkillFixtures extends Fixture
{
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