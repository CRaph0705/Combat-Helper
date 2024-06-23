<?php

namespace App\DataFixtures;

use App\Entity\SavingThrow;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SavingThrowFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $savingThrows = [
            'Force',
            'Dextérité',
            'Constitution',
            'Intelligence',
            'Sagesse',
            'Charisme',
        ];

        foreach ($savingThrows as $savingThrowName) {
            $savingThrow = new SavingThrow();
            $savingThrow->setName($savingThrowName);
            $manager->persist($savingThrow);
        }

        $manager->flush();
    }
}
