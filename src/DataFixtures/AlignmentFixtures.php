<?php

namespace App\DataFixtures;

use App\Entity\Alignment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AlignmentFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $lawfulGood = new Alignment();
        $lawfulGood->setName('Loyal Bon');
        $manager->persist($lawfulGood);

        $neutralGood = new Alignment();
        $neutralGood->setName('Neutre Bon');
        $manager->persist($neutralGood);

        $chaoticGood = new Alignment();
        $chaoticGood->setName('Chaotique Bon');
        $manager->persist($chaoticGood);

        $lawfulNeutral = new Alignment();
        $lawfulNeutral->setName('Loyal Neutre');
        $manager->persist($lawfulNeutral);

        $trueNeutral = new Alignment();
        $trueNeutral->setName('Neutre');
        $manager->persist($trueNeutral);

        $chaoticNeutral = new Alignment();
        $chaoticNeutral->setName('Chaotique Neutre');
        $manager->persist($chaoticNeutral);

        $lawfulEvil = new Alignment();
        $lawfulEvil->setName('Loyal Mauvais');
        $manager->persist($lawfulEvil);

        $neutralEvil = new Alignment();
        $neutralEvil->setName('Neutre Mauvais');
        $manager->persist($neutralEvil);

        $chaoticEvil = new Alignment();
        $chaoticEvil->setName('Chaotique Mauvais');
        $manager->persist($chaoticEvil);

        $manager->flush();
    }
}