<?php

namespace App\DataFixtures;

use App\Entity\Challenge;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ChallengeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $challenge1 = new Challenge();
        $challenge1->setName('0');
        $challenge1->setXp(10);
        $manager->persist($challenge1);

        $challenge2 = new Challenge();
        $challenge2->setName('1/8');
        $challenge2->setXp(25);
        $manager->persist($challenge2);

        $challenge3 = new Challenge();
        $challenge3->setName('1/4');
        $challenge3->setXp(50);
        $manager->persist($challenge3);

        $challenge4 = new Challenge();
        $challenge4->setName('1/2');
        $challenge4->setXp(100);
        $manager->persist($challenge4);

        $challenge5 = new Challenge();
        $challenge5->setName('1');
        $challenge5->setXp(200);
        $manager->persist($challenge5);

        $challenge6 = new Challenge();
        $challenge6->setName('2');
        $challenge6->setXp(450);
        $manager->persist($challenge6);

        $challenge7 = new Challenge();
        $challenge7->setName('3');
        $challenge7->setXp(700);
        $manager->persist($challenge7);

        $challenge8 = new Challenge();
        $challenge8->setName('4');
        $challenge8->setXp(1100);
        $manager->persist($challenge8);

        $challenge9 = new Challenge();
        $challenge9->setName('5');
        $challenge9->setXp(1800);
        $manager->persist($challenge9);

        $challenge10 = new Challenge();
        $challenge10->setName('6');
        $challenge10->setXp(2300);
        $manager->persist($challenge10);

        $challenge11 = new Challenge();
        $challenge11->setName('7');
        $challenge11->setXp(2900);
        $manager->persist($challenge11);

        $challenge12 = new Challenge();
        $challenge12->setName('8');
        $challenge12->setXp(3900);
        $manager->persist($challenge12);

        $challenge13 = new Challenge();
        $challenge13->setName('9');
        $challenge13->setXp(5000);
        $manager->persist($challenge13);

        $challenge14 = new Challenge();
        $challenge14->setName('10');
        $challenge14->setXp(5900);
        $manager->persist($challenge14);

        $challenge15 = new Challenge();
        $challenge15->setName('11');
        $challenge15->setXp(7200);
        $manager->persist($challenge15);

        $challenge16 = new Challenge();
        $challenge16->setName('12');
        $challenge16->setXp(8400);
        $manager->persist($challenge16);

        $challenge17 = new Challenge();
        $challenge17->setName('13');
        $challenge17->setXp(10000);
        $manager->persist($challenge17);

        $challenge18 = new Challenge();
        $challenge18->setName('14');
        $challenge18->setXp(11500);
        $manager->persist($challenge18);

        $challenge19 = new Challenge();
        $challenge19->setName('15');
        $challenge19->setXp(13000);
        $manager->persist($challenge19);

        $challenge20 = new Challenge();
        $challenge20->setName('16');
        $challenge20->setXp(15000);
        $manager->persist($challenge20);

        $challenge21 = new Challenge();
        $challenge21->setName('17');
        $challenge21->setXp(18000);
        $manager->persist($challenge21);

        $challenge22 = new Challenge();
        $challenge22->setName('18');
        $challenge22->setXp(20000);
        $manager->persist($challenge22);

        $challenge23 = new Challenge();
        $challenge23->setName('19');
        $challenge23->setXp(22000);
        $manager->persist($challenge23);

        $challenge24 = new Challenge();
        $challenge24->setName('20');
        $challenge24->setXp(25000);
        $manager->persist($challenge24);

        $challenge25 = new Challenge();
        $challenge25->setName('21');
        $challenge25->setXp(33000);
        $manager->persist($challenge25);

        $challenge26 = new Challenge();
        $challenge26->setName('22');
        $challenge26->setXp(41000);
        $manager->persist($challenge26);

        $challenge27 = new Challenge();
        $challenge27->setName('23');
        $challenge27->setXp(50000);
        $manager->persist($challenge27);

        $challenge28 = new Challenge();
        $challenge28->setName('24');
        $challenge28->setXp(62000);
        $manager->persist($challenge28);

        $challenge29 = new Challenge();
        $challenge29->setName('25');
        $challenge29->setXp(75000);
        $manager->persist($challenge29);

        $challenge30 = new Challenge();
        $challenge30->setName('26');
        $challenge30->setXp(90000);
        $manager->persist($challenge30);

        $challenge31 = new Challenge();
        $challenge31->setName('27');
        $challenge31->setXp(105000);
        $manager->persist($challenge31);

        $challenge32 = new Challenge();
        $challenge32->setName('28');
        $challenge32->setXp(120000);
        $manager->persist($challenge32);

        $challenge33 = new Challenge();
        $challenge33->setName('29');
        $challenge33->setXp(135000);
        $manager->persist($challenge33);

        $challenge34 = new Challenge();
        $challenge34->setName('30');
        $challenge34->setXp(155000);
        $manager->persist($challenge34);


        $manager->flush();
    }
}