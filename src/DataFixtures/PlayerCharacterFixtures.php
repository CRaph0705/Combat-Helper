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
        $zeke->setHp(30);
        $zeke->setAC(17);
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
        $ornagar->setHp(40);
        $ornagar->setAC(18);
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
        $rhan->setName('Rhan');
        $rhan->setHp(30);
        $rhan->setAC(16);
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
        $fray->setHp(30);
        $fray->setAC(16);
        $fray->setLevel(3);
        $manager->persist($fray);

        $mortecouille = new PlayerCharacter();
        $mortecouille->setName('Mortecouille');
        $mortecouille->setHp(30);
        $mortecouille->setAC(16);
        $mortecouille->setLevel(3);
        $manager->persist($mortecouille);

        $khalvi = new PlayerCharacter();
        $khalvi->setName('Khalvi');
        $khalvi->setHp(30);
        $khalvi->setAC(16);
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

        $manager->flush();
    }
}
