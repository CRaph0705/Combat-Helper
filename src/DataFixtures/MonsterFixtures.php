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

        //10 more monsters

        $dragon = new Monster();
        $dragon->setName('Dragon');
        $manager->persist($dragon);

        $troll = new Monster();
        $troll->setName('Troll');
        $manager->persist($troll);

        $giant = new Monster();
        $giant->setName('Giant');
        $manager->persist($giant);

        $demon = new Monster();
        $demon->setName('Demon');
        $manager->persist($demon);

        $ghost = new Monster();
        $ghost->setName('Ghost');
        $manager->persist($ghost);

        $zombie = new Monster();
        $zombie->setName('Zombie');
        $manager->persist($zombie);

        $skeleton = new Monster();
        $skeleton->setName('Skeleton');
        $manager->persist($skeleton);

        $vampire = new Monster();
        $vampire->setName('Vampire');
        $manager->persist($vampire);

        $werewolf = new Monster();
        $werewolf->setName('Werewolf');
        $manager->persist($werewolf);

        $lich = new Monster();
        $lich->setName('Lich');
        $manager->persist($lich);
        
        $manager->flush();
    }
}
