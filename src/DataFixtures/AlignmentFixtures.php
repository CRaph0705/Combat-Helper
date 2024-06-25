<?php

namespace App\DataFixtures;

use App\Entity\Alignment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AlignmentFixtures extends Fixture
{
    public const ALIGNMENT_LAWFUL_GOOD = 'alignment-lawful-good';
    public const ALIGNMENT_NEUTRAL_GOOD = 'alignment-neutral-good';
    public const ALIGNMENT_CHAOTIC_GOOD = 'alignment-chaotic-good';
    public const ALIGNMENT_LAWFUL_NEUTRAL = 'alignment-lawful-neutral';
    public const ALIGNMENT_TRUE_NEUTRAL = 'alignment-true-neutral';
    public const ALIGNMENT_CHAOTIC_NEUTRAL = 'alignment-chaotic-neutral';
    public const ALIGNMENT_LAWFUL_EVIL = 'alignment-lawful-evil';
    public const ALIGNMENT_NEUTRAL_EVIL = 'alignment-neutral-evil';
    public const ALIGNMENT_CHAOTIC_EVIL = 'alignment-chaotic-evil';

    public function load(ObjectManager $manager): void
    {
        $lawfulGood = new Alignment();
        $lawfulGood->setName('Loyal Bon');
        $manager->persist($lawfulGood);
        $this->addReference(self::ALIGNMENT_LAWFUL_GOOD, $lawfulGood);

        $neutralGood = new Alignment();
        $neutralGood->setName('Neutre Bon');
        $manager->persist($neutralGood);
        $this->addReference(self::ALIGNMENT_NEUTRAL_GOOD, $neutralGood);

        $chaoticGood = new Alignment();
        $chaoticGood->setName('Chaotique Bon');
        $manager->persist($chaoticGood);
        $this->addReference(self::ALIGNMENT_CHAOTIC_GOOD, $chaoticGood);

        $lawfulNeutral = new Alignment();
        $lawfulNeutral->setName('Loyal Neutre');
        $manager->persist($lawfulNeutral);
        $this->addReference(self::ALIGNMENT_LAWFUL_NEUTRAL, $lawfulNeutral);

        $trueNeutral = new Alignment();
        $trueNeutral->setName('Neutre');
        $manager->persist($trueNeutral);
        $this->addReference(self::ALIGNMENT_TRUE_NEUTRAL, $trueNeutral);

        $chaoticNeutral = new Alignment();
        $chaoticNeutral->setName('Chaotique Neutre');
        $manager->persist($chaoticNeutral);
        $this->addReference(self::ALIGNMENT_CHAOTIC_NEUTRAL, $chaoticNeutral);

        $lawfulEvil = new Alignment();
        $lawfulEvil->setName('Loyal Mauvais');
        $manager->persist($lawfulEvil);
        $this->addReference(self::ALIGNMENT_LAWFUL_EVIL, $lawfulEvil);

        $neutralEvil = new Alignment();
        $neutralEvil->setName('Neutre Mauvais');
        $manager->persist($neutralEvil);
        $this->addReference(self::ALIGNMENT_NEUTRAL_EVIL, $neutralEvil);

        $chaoticEvil = new Alignment();
        $chaoticEvil->setName('Chaotique Mauvais');
        $manager->persist($chaoticEvil);
        $this->addReference(self::ALIGNMENT_CHAOTIC_EVIL, $chaoticEvil);

        $manager->flush();
    }
}