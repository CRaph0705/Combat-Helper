<?php

namespace App\DataFixtures;

use App\Entity\Language;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LanguageFixtures extends Fixture
{
    public const LANGUAGE_COMMON = 'Common';
    public const LANGUAGE_ELVISH = 'Elvish';
    public const LANGUAGE_GIANT = 'Giant';
    public const LANGUAGE_GNOMISH = 'Gnomish';
    public const LANGUAGE_GOBLIN = 'Goblin';
    public const LANGUAGE_HALFLING = 'Halfling';
    public const LANGUAGE_DWARVISH = 'Dwarvish';
    public const LANGUAGE_ORC = 'Orc';
    public const LANGUAGE_ABYSSAL = 'Abyssal';
    public const LANGUAGE_CELESTIAL = 'Celestial';
    public const LANGUAGE_DRACONIC = 'Draconic';
    public const LANGUAGE_DEEP_SPEECH = 'Deep Speech';
    public const LANGUAGE_INFERNAL = 'Infernal';
    public const LANGUAGE_PRIMORDIAL = 'Primordial';
    public const LANGUAGE_SYLVAN = 'Sylvan';
    public const LANGUAGE_UNDERCOMMON = 'Undercommon';
    public const LANGUAGE_BLACK_SPEECH = 'Black Speech';
    public const LANGUAGE_SSELISH = 'Sselish';

    public function load(ObjectManager $manager): void
    {
        $common = new Language();
        $common->setName('Commun');
        $manager->persist($common);
        $this->addReference(self::LANGUAGE_COMMON, $common);

        $elvish = new Language();
        $elvish->setName('Elfique');
        $manager->persist($elvish);
        $this->addReference(self::LANGUAGE_ELVISH, $elvish);

        $giant = new Language();
        $giant->setName('Géant');
        $manager->persist($giant);
        $this->addReference(self::LANGUAGE_GIANT, $giant);

        $gnomish = new Language();
        $gnomish->setName('Gnome');
        $manager->persist($gnomish);
        $this->addReference(self::LANGUAGE_GNOMISH, $gnomish);

        $goblin = new Language();
        $goblin->setName('Gobelin');
        $manager->persist($goblin);
        $this->addReference(self::LANGUAGE_GOBLIN, $goblin);

        $halfling = new Language();
        $halfling->setName('Halfelin');
        $manager->persist($halfling);
        $this->addReference(self::LANGUAGE_HALFLING, $halfling);

        $dwarvish = new Language();
        $dwarvish->setName('Nain');
        $manager->persist($dwarvish);
        $this->addReference(self::LANGUAGE_DWARVISH, $dwarvish);

        $orc = new Language();
        $orc->setName('Orque');
        $manager->persist($orc);
        $this->addReference(self::LANGUAGE_ORC, $orc);

        $abyssal = new Language();
        $abyssal->setName('Abyssal');
        $manager->persist($abyssal);
        $this->addReference(self::LANGUAGE_ABYSSAL, $abyssal);

        $celestial = new Language();
        $celestial->setName('Céleste');
        $manager->persist($celestial);
        $this->addReference(self::LANGUAGE_CELESTIAL, $celestial);

        $draconic = new Language();
        $draconic->setName('Draconique');
        $manager->persist($draconic);
        $this->addReference(self::LANGUAGE_DRACONIC, $draconic);

        $deepSpeech = new Language();
        $deepSpeech->setName('Profond');
        $manager->persist($deepSpeech);
        $this->addReference(self::LANGUAGE_DEEP_SPEECH, $deepSpeech);

        $infernal = new Language();
        $infernal->setName('Infernal');
        $manager->persist($infernal);
        $this->addReference(self::LANGUAGE_INFERNAL, $infernal);

        $primordial = new Language();
        $primordial->setName('Primordial');
        $manager->persist($primordial);
        $this->addReference(self::LANGUAGE_PRIMORDIAL, $primordial);

        $sylvan = new Language();
        $sylvan->setName('Sylvestre');
        $manager->persist($sylvan);
        $this->addReference(self::LANGUAGE_SYLVAN, $sylvan);

        $undercommon = new Language();
        $undercommon->setName('Commun des profondeurs');
        $manager->persist($undercommon);
        $this->addReference(self::LANGUAGE_UNDERCOMMON, $undercommon);

        $blackSpeech = new Language();
        $blackSpeech->setName('Noir parler');
        $manager->persist($blackSpeech);
        $this->addReference(self::LANGUAGE_BLACK_SPEECH, $blackSpeech);

        $sselish = new Language();
        $sselish->setName('Ssélish');
        $manager->persist($sselish);
        $this->addReference(self::LANGUAGE_SSELISH, $sselish);

        $manager->flush();
    }
}
