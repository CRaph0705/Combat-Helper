<?php

namespace App\DataFixtures;

use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TypeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $aberration = new Type();
        $aberration->setName('Aberration');
        $manager->persist($aberration);

        $beast = new Type();
        $beast->setName('Bête');
        $manager->persist($beast);

        $celestial = new Type();
        $celestial->setName('Céleste');
        $manager->persist($celestial);

        $construct = new Type();
        $construct->setName('Créature artificielle');
        $manager->persist($construct);

        $dragon = new Type();
        $dragon->setName('Dragon');
        $manager->persist($dragon);

        $elemental = new Type();
        $elemental->setName('Élémentaire');
        $manager->persist($elemental);

        $fey = new Type();
        $fey->setName('Fée');
        $manager->persist($fey);

        $fiend = new Type();
        $fiend->setName('Fiélon');
        $manager->persist($fiend);

        $giant = new Type();
        $giant->setName('Géant');
        $manager->persist($giant);

        $humanoid = new Type();
        $humanoid->setName('Humanoïde');
        $manager->persist($humanoid);

        $monstrosity = new Type();
        $monstrosity->setName('Monstruosité');
        $manager->persist($monstrosity);

        $ooze = new Type();
        $ooze->setName('Vase');
        $manager->persist($ooze);

        $plant = new Type();
        $plant->setName('Plante');
        $manager->persist($plant);

        $undead = new Type();
        $undead->setName('Mort-vivant');
        $manager->persist($undead);

        $manager->flush();
    }
}