<?php

namespace App\DataFixtures;

use App\Entity\Monster;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MonsterFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $rat = new Monster();
        $rat->setName('Rat');
        $manager->persist($rat);

        $goblin = new Monster();
        $goblin->setName('Goblin');
        $manager->persist($goblin);

        $wolf = new Monster();
        $wolf->setName('Wolf');
        $manager->persist($wolf);

        $giantSpider = new Monster();
        $giantSpider->setName('Giant Spider');
        $manager->persist($giantSpider);

        $chicken = new Monster();
        $chicken->setName('Chicken');
        $manager->persist($chicken);
        
        $manager->flush();
    }
}
