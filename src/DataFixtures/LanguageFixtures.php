<?php

namespace App\DataFixtures;

use App\Entity\Language;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LanguageCharacterFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $common = new Language();
        $common->setName('Commun');
        $manager->persist($common);

        $elvish = new Language();
        $elvish->setName('Elfique');
        $manager->persist($elvish);

        $giant = new Language();
        $giant->setName('Géant');
        $manager->persist($giant);

        $gnomish = new Language();
        $gnomish->setName('Gnome');
        $manager->persist($gnomish);

        $goblin = new Language();
        $goblin->setName('Gobelin');
        $manager->persist($goblin);

        $halfling = new Language();
        $halfling->setName('Halfelin');
        $manager->persist($halfling);

        $dwarvish = new Language();
        $dwarvish->setName('Nain');
        $manager->persist($dwarvish);

        $orc = new Language();
        $orc->setName('Orque');
        $manager->persist($orc);

        $abyssal = new Language();
        $abyssal->setName('Abyssal');
        $manager->persist($abyssal);

        $celestial = new Language();
        $celestial->setName('Céleste');
        $manager->persist($celestial);

        $draconic = new Language();
        $draconic->setName('Draconique');
        $manager->persist($draconic);

        $deepSpeech = new Language();
        $deepSpeech->setName('Profond');
        $manager->persist($deepSpeech);

        $infernal = new Language();
        $infernal->setName('Infernal');
        $manager->persist($infernal);

        $primordial = new Language();
        $primordial->setName('Primordial');
        $manager->persist($primordial);

        $sylvan = new Language();
        $sylvan->setName('Sylvestre');
        $manager->persist($sylvan);

        $undercommon = new Language();
        $undercommon->setName('Commun des profondeurs');
        $manager->persist($undercommon);

        $blackSpeech = new Language();
        $blackSpeech->setName('Noir parler');
        $manager->persist($blackSpeech);

        $sselish = new Language();
        $sselish->setName('Ssélish');
        $manager->persist($sselish);

        $manager->flush();
    }
}
