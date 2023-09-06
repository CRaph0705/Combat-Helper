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
        $valriia->setHp(37);
        $valriia->setAC(20);
        $valriia->setLevel(3);
        // $this->addReference('valriia', $valriia);
        $manager->persist($valriia);

        $zeke = new PlayerCharacter();
        $zeke->setName('Zeke');
        $zeke->setHp(30);
        $zeke->setAC(17);
        $zeke->setLevel(3);
        $manager->persist($zeke);

        $ornagar = new PlayerCharacter();
        $ornagar->setName('Ornagar');
        $ornagar->setHp(40);
        $ornagar->setAC(18);
        $ornagar->setLevel(3);
        $manager->persist($ornagar);

        $rhan = new PlayerCharacter();
        $rhan->setName('Rhan');
        $rhan->setHp(30);
        $rhan->setAC(16);
        $rhan->setLevel(3);
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
        $manager->persist($khalvi);

        $manager->flush();
    }
}
