<?php

namespace App\DataFixtures;

use App\Entity\ExpertSkill;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ExpertSkillFixtures extends Fixture
{
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