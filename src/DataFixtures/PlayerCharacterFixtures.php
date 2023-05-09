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

        $manager->persist($valriia);

        $manager->flush();
    }
}
