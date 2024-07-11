<?php

namespace App\DataFixtures;

use App\Entity\Alignment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AlignmentFixtures extends Fixture
{
    public const ALIGNMENT_LAWFUL_GOOD = 'lawful good';
    public const ALIGNMENT_NEUTRAL_GOOD = 'neutral good';
    public const ALIGNMENT_CHAOTIC_GOOD = 'chaotic good';
    public const ALIGNMENT_LAWFUL_NEUTRAL = 'lawful neutral';
    public const ALIGNMENT_TRUE_NEUTRAL = 'true neutral';
    public const ALIGNMENT_CHAOTIC_NEUTRAL = 'chaotic neutral';
    public const ALIGNMENT_LAWFUL_EVIL = 'lawful evil';
    public const ALIGNMENT_NEUTRAL_EVIL = 'neutral evil';
    public const ALIGNMENT_CHAOTIC_EVIL = 'chaotic evil';
    public const ALIGNMENT_UNALIGNED = 'unaligned';
    public const ALIGNMENT_ANY = 'any alignment';
    public const ALIGNMENT_ANY_NON_GOOD = 'any non good alignment';
    public const ALIGNMENT_ANY_GOOD = 'any good alignment';
    public const ALIGNMENT_ANY_NEUTRAL = 'any neutral alignment';
    public const ALIGNMENT_ANY_CHAOTIC = 'any chaotic alignment';
    public const ALIGNMENT_ANY_LAWFUL = 'any lawful alignment';
    public const ALIGNMENT_ANY_NON_LAWFUL = 'any non lawful alignment';
    public const ALIGNMENT_ANY_EVIL = 'any evil alignment';


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

        $unaligned = new Alignment();
        $unaligned->setName('Non aligné');
        $manager->persist($unaligned);
        $this->addReference(self::ALIGNMENT_UNALIGNED, $unaligned);

        $anyAlignment = new Alignment();
        $anyAlignment->setName('Tout alignement');
        $manager->persist($anyAlignment);
        $this->addReference(self::ALIGNMENT_ANY, $anyAlignment);

        $anyNonGoodAlignment = new Alignment();
        $anyNonGoodAlignment->setName('Tout alignement sauf bon');
        $manager->persist($anyNonGoodAlignment);
        $this->addReference(self::ALIGNMENT_ANY_NON_GOOD, $anyNonGoodAlignment);

        $anyGoodAlignment = new Alignment();
        $anyGoodAlignment->setName('Tout alignement bon');
        $manager->persist($anyGoodAlignment);
        $this->addReference(self::ALIGNMENT_ANY_GOOD, $anyGoodAlignment);

        $anyNeutralAlignment = new Alignment();
        $anyNeutralAlignment->setName('Tout alignement neutre');
        $manager->persist($anyNeutralAlignment);
        $this->addReference(self::ALIGNMENT_ANY_NEUTRAL, $anyNeutralAlignment);

        $anyChaoticAlignment = new Alignment();
        $anyChaoticAlignment->setName('Tout alignement chaotique');
        $manager->persist($anyChaoticAlignment);
        $this->addReference(self::ALIGNMENT_ANY_CHAOTIC, $anyChaoticAlignment);

        $anyLawfulAlignment = new Alignment();
        $anyLawfulAlignment->setName('Tout alignement loyal');
        $manager->persist($anyLawfulAlignment);
        $this->addReference(self::ALIGNMENT_ANY_LAWFUL, $anyLawfulAlignment);
        
        $anyNonLawfulAlignment = new Alignment();
        $anyNonLawfulAlignment->setName('Tout alignement non loyal');
        $manager->persist($anyNonLawfulAlignment);
        $this->addReference(self::ALIGNMENT_ANY_NON_LAWFUL, $anyNonLawfulAlignment);

        $anyEvilAlignment = new Alignment();
        $anyEvilAlignment->setName('Tout alignement mauvais');
        $manager->persist($anyEvilAlignment);
        $this->addReference(self::ALIGNMENT_ANY_EVIL, $anyEvilAlignment);

        $manager->flush();
    }
}