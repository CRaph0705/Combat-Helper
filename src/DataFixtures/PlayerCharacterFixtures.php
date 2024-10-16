<?php

namespace App\DataFixtures;

use App\Entity\PlayerCharacter;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PlayerCharacterFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $valriia = new PlayerCharacter();
        $valriia->setName('Valriia');
        $valriia->setHp(55);
        $valriia->setAC(20);
        $valriia->setLevel(5);
        $valriia->setStats(
            18, // strength
            16, // dexterity
            16, // constitution
            13, // intelligence
            13, // wisdom
            17  // charisma
        );
        $valriia->setSpeed("9");
        $manager->persist($valriia);

        $zeke = new PlayerCharacter();
        $zeke->setName('Zeke');
        $zeke->setHp(33);
        $zeke->setAC(16);
        $zeke->setLevel(5);
        $zeke->setStats(
            11, // strength
            18, // dexterity
            13, // constitution
            13, // intelligence
            13, // wisdom
            14  // charisma
        );
        $zeke->setSpeed("7,5");
        $manager->persist($zeke);

        $ornagar = new PlayerCharacter();
        $ornagar->setName('Ornagar');
        $ornagar->setHp(32);
        $ornagar->setAC(16);
        $ornagar->setLevel(5);
        $ornagar->setStats(
            13, // strength
            18, // dexterity
            13, // constitution
            10, // intelligence
            15, // wisdom
            11  // charisma
        );
        $ornagar->setSpeed("9");
        $manager->persist($ornagar);

        $rhan = new PlayerCharacter();
        $rhan->setName('Rhanne');
        $rhan->setHp(37);
        $rhan->setAC(17);
        $rhan->setLevel(5);
        $rhan->setStats(
            14, // strength
            12, // dexterity
            14, // constitution
            12, // intelligence
            14, // wisdom
            13  // charisma
        );
        $rhan->setSpeed("9");
        $manager->persist($rhan);

        $fray = new PlayerCharacter();
        $fray->setName('Fray');
        $fray->setHp(14);
        $fray->setAC(10);
        $fray->setLevel(2);
        $fray->setStats(
            5, // strength
            9, // dexterity
            12, // constitution
            14, // intelligence
            17, // wisdom
            18  // charisma
        );
        $fray->setSpeed("9");
        $manager->persist($fray);

        $mortecouille = new PlayerCharacter();
        $mortecouille->setName('Mortecouille');
        $mortecouille->setHp(12);
        $mortecouille->setAC(18);
        $mortecouille->setLevel(1);
        $mortecouille->setStats(
            19, // strength
            18, // dexterity
            15, // constitution
            13, // intelligence
            15, // wisdom
            16  // charisma
        );
        $mortecouille->setSpeed("9");
        $manager->persist($mortecouille);

        $khalvi = new PlayerCharacter();
        $khalvi->setName('Khalvi');
        $khalvi->setHp(60);
        $khalvi->setAC(13);
        $khalvi->setLevel(5);
        $khalvi->setStats(
            18, // strength
            12, // dexterity
            14, // constitution
            11, // intelligence
            12, // wisdom
            9  // charisma
        );
        $khalvi->setSpeed("12");
        $manager->persist($khalvi);

        $manager->flush();
    }
}
