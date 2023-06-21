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
        $valriia->setHpMax(37);
        $valriia->setAC(20);
        $valriia->setInitiative(3);
        $manager->persist($valriia);

        $zeke = new PlayerCharacter();
        $zeke->setName('Zeke');
        $zeke->setHpMax(30);
        $zeke->setAC(17);
        $manager->persist($zeke);

        $ornagar = new PlayerCharacter();
        $ornagar->setName('Ornagar');
        $ornagar->setHpMax(40);
        $ornagar->setAC(18);
        $manager->persist($ornagar);

        $rhan = new PlayerCharacter();
        $rhan->setName('Rhan');
        $rhan->setHpMax(30);
        $rhan->setAC(16);
        $manager->persist($rhan);

        $fray = new PlayerCharacter();
        $fray->setName('Fray');
        $fray->setHpMax(30);
        $fray->setAC(16);
        $manager->persist($fray);

        $mortecouille = new PlayerCharacter();
        $mortecouille->setName('Mortecouille');
        $mortecouille->setHpMax(30);
        $mortecouille->setAC(16);
        $manager->persist($mortecouille);

        $khalvi = new PlayerCharacter();
        $khalvi->setName('Khalvi');
        $khalvi->setHpMax(30);
        $khalvi->setAC(16);
        $manager->persist($khalvi);

        $manager->flush();
    }
}
