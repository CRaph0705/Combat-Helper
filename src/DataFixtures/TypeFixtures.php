<?php

namespace App\DataFixtures;

use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TypeFixtures extends Fixture
{
    public const TYPE_ABERRATION = 'aberration';
    public const TYPE_BEAST = 'beast';
    public const TYPE_CELESTIAL = 'celestial';
    public const TYPE_CONSTRUCT = 'construct';
    public const TYPE_DRAGON = 'dragon';
    public const TYPE_ELEMENTAL = 'elemental';
    public const TYPE_FEY = 'fey';
    public const TYPE_FIEND = 'fiend';
    public const TYPE_GIANT = 'giant';
    public const TYPE_HUMANOID = 'humanoid';
    public const TYPE_MONSTROSITY = 'monstrosity';
    public const TYPE_OOZE = 'ooze';
    public const TYPE_PLANT = 'plant';
    public const TYPE_UNDEAD = 'undead';

    public function load(ObjectManager $manager): void
    {
        $aberration = new Type();
        $aberration->setName('Aberration');
        $manager->persist($aberration);
        $this->addReference(self::TYPE_ABERRATION, $aberration);

        $beast = new Type();
        $beast->setName('Bête');
        $manager->persist($beast);
        $this->addReference(self::TYPE_BEAST, $beast);

        $celestial = new Type();
        $celestial->setName('Céleste');
        $manager->persist($celestial);
        $this->addReference(self::TYPE_CELESTIAL, $celestial);

        $construct = new Type();
        $construct->setName('Créature artificielle');
        $manager->persist($construct);
        $this->addReference(self::TYPE_CONSTRUCT, $construct);

        $dragon = new Type();
        $dragon->setName('Dragon');
        $manager->persist($dragon);
        $this->addReference(self::TYPE_DRAGON, $dragon);

        $elemental = new Type();
        $elemental->setName('Élémentaire');
        $manager->persist($elemental);
        $this->addReference(self::TYPE_ELEMENTAL, $elemental);

        $fey = new Type();
        $fey->setName('Fée');
        $manager->persist($fey);
        $this->addReference(self::TYPE_FEY, $fey);

        $fiend = new Type();
        $fiend->setName('Fiélon');
        $manager->persist($fiend);
        $this->addReference(self::TYPE_FIEND, $fiend);

        $giant = new Type();
        $giant->setName('Géant');
        $manager->persist($giant);
        $this->addReference(self::TYPE_GIANT, $giant);

        $humanoid = new Type();
        $humanoid->setName('Humanoïde');
        $manager->persist($humanoid);
        $this->addReference(self::TYPE_HUMANOID, $humanoid);

        $monstrosity = new Type();
        $monstrosity->setName('Monstruosité');
        $manager->persist($monstrosity);
        $this->addReference(self::TYPE_MONSTROSITY, $monstrosity);

        $ooze = new Type();
        $ooze->setName('Vase');
        $manager->persist($ooze);
        $this->addReference(self::TYPE_OOZE, $ooze);

        $plant = new Type();
        $plant->setName('Plante');
        $manager->persist($plant);
        $this->addReference(self::TYPE_PLANT, $plant);

        $undead = new Type();
        $undead->setName('Mort-vivant');
        $manager->persist($undead);
        $this->addReference(self::TYPE_UNDEAD, $undead);

        $manager->flush();
    }
}