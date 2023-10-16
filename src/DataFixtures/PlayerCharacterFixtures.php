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
        $valriia->setHp(34);
        $valriia->setAC(20);
        $valriia->setLevel(3);
        $valriia->setStats(
            16, // strength
            16, // dexterity
            16, // constitution
            13, // intelligence
            13, // wisdom
            17  // charisma
        );
        $manager->persist($valriia);

        $zeke = new PlayerCharacter();
        $zeke->setName('Zeke');
        $zeke->setHp(18);
        $zeke->setAC(15);
        $zeke->setLevel(3);
        $zeke->setStats(
            11, // strength
            17, // dexterity
            13, // constitution
            12, // intelligence
            13, // wisdom
            14  // charisma
        );
        $manager->persist($zeke);

        $ornagar = new PlayerCharacter();
        $ornagar->setName('Ornagar');
        $ornagar->setHp(16);
        $ornagar->setAC(15);
        $ornagar->setLevel(3);
        $ornagar->setStats(
            13, // strength
            16, // dexterity
            13, // constitution
            10, // intelligence
            15, // wisdom
            11  // charisma
        );
        $manager->persist($ornagar);

        $rhan = new PlayerCharacter();
        $rhan->setName('Rhanne');
        $rhan->setHp(22);
        $rhan->setAC(11);
        $rhan->setLevel(3);
        $rhan->setStats(
            14, // strength
            11, // dexterity
            13, // constitution
            12, // intelligence
            14, // wisdom
            13  // charisma
        );
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
        $manager->persist($mortecouille);

        $khalvi = new PlayerCharacter();
        $khalvi->setName('Khalvi');
        $khalvi->setHp(37);
        $khalvi->setAC(14);
        $khalvi->setLevel(3);
        $khalvi->setStats(
            18, // strength
            10, // dexterity
            14, // constitution
            11, // intelligence
            12, // wisdom
            9  // charisma
        );
        $manager->persist($khalvi);


        $jeanLuc = new PlayerCharacter();
        $jeanLuc->setName('Jean-Luc');
        $jeanLuc->setHp(18);
        $jeanLuc->setAC(13);
        $jeanLuc->setLevel(1);
        $jeanLuc->setStats(
            11, // strength
            11, // dexterity
            12, // constitution
            5, // intelligence
            8, // wisdom
            2  // charisma
        );
        $manager->persist($jeanLuc);



        $manager->flush();
    }
}
