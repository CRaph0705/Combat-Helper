<?php

namespace App\DataFixtures;

use App\Entity\SavingThrow;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SavingThrowFixtures extends Fixture
{
    public const SAVING_THROW_FORCE = 'saving-throw-force';
    public const SAVING_THROW_DEXTERITY = 'saving-throw-dexterity';
    public const SAVING_THROW_CONSTITUTION = 'saving-throw-constitution';
    public const SAVING_THROW_INTELLIGENCE = 'saving-throw-intelligence';
    public const SAVING_THROW_WISDOM = 'saving-throw-wisdom';
    public const SAVING_THROW_CHARISMA = 'saving-throw-charisma';

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
            $this->addReference('saving-throw-' . strtolower($savingThrowName), $savingThrow);
        }

        $manager->flush();
    }
}
