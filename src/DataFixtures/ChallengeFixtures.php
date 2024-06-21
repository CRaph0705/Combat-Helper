<?php

namespace App\DataFixtures;

use App\Entity\Challenge;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ChallengeFixtures extends Fixture
{
    public const CHALLENGE_0 = 'challenge0';
    public const CHALLENGE_1_8 = 'challenge1/8';
    public const CHALLENGE_1_4 = 'challenge1/4';
    public const CHALLENGE_1_2 = 'challenge1/2';
    public const CHALLENGE_1 = 'challenge1';
    public const CHALLENGE_2 = 'challenge2';
    public const CHALLENGE_3 = 'challenge3';
    public const CHALLENGE_4 = 'challenge4';
    public const CHALLENGE_5 = 'challenge5';
    public const CHALLENGE_6 = 'challenge6';
    public const CHALLENGE_7 = 'challenge7';
    public const CHALLENGE_8 = 'challenge8';
    public const CHALLENGE_9 = 'challenge9';
    public const CHALLENGE_10 = 'challenge10';
    public const CHALLENGE_11 = 'challenge11';
    public const CHALLENGE_12 = 'challenge12';
    public const CHALLENGE_13 = 'challenge13';
    public const CHALLENGE_14 = 'challenge14';
    public const CHALLENGE_15 = 'challenge15';
    public const CHALLENGE_16 = 'challenge16';
    public const CHALLENGE_17 = 'challenge17';
    public const CHALLENGE_18 = 'challenge18';
    public const CHALLENGE_19 = 'challenge19';
    public const CHALLENGE_20 = 'challenge20';
    public const CHALLENGE_21 = 'challenge21';
    public const CHALLENGE_22 = 'challenge22';
    public const CHALLENGE_23 = 'challenge23';
    public const CHALLENGE_24 = 'challenge24';
    public const CHALLENGE_25 = 'challenge25';
    public const CHALLENGE_26 = 'challenge26';
    public const CHALLENGE_27 = 'challenge27';
    public const CHALLENGE_28 = 'challenge28';
    public const CHALLENGE_29 = 'challenge29';
    public const CHALLENGE_30 = 'challenge30';


    public function load(ObjectManager $manager): void
    {
        $challenge1 = new Challenge();
        $challenge1->setName('0');
        $challenge1->setXp(10);
        $manager->persist($challenge1);
        $this->addReference(self::CHALLENGE_0, $challenge1);

        $challenge2 = new Challenge();
        $challenge2->setName('1/8');
        $challenge2->setXp(25);
        $manager->persist($challenge2);
        $this->addReference(self::CHALLENGE_1_8, $challenge2);

        $challenge3 = new Challenge();
        $challenge3->setName('1/4');
        $challenge3->setXp(50);
        $manager->persist($challenge3);
        $this->addReference(self::CHALLENGE_1_4, $challenge3);

        $challenge4 = new Challenge();
        $challenge4->setName('1/2');
        $challenge4->setXp(100);
        $manager->persist($challenge4);
        $this->addReference(self::CHALLENGE_1_2, $challenge4);

        $challenge5 = new Challenge();
        $challenge5->setName('1');
        $challenge5->setXp(200);
        $manager->persist($challenge5);
        $this->addReference(self::CHALLENGE_1, $challenge5);

        $challenge6 = new Challenge();
        $challenge6->setName('2');
        $challenge6->setXp(450);
        $manager->persist($challenge6);
        $this->addReference(self::CHALLENGE_2, $challenge6);

        $challenge7 = new Challenge();
        $challenge7->setName('3');
        $challenge7->setXp(700);
        $manager->persist($challenge7);
        $this->addReference(self::CHALLENGE_3, $challenge7);

        $challenge8 = new Challenge();
        $challenge8->setName('4');
        $challenge8->setXp(1100);
        $manager->persist($challenge8);
        $this->addReference(self::CHALLENGE_4, $challenge8);

        $challenge9 = new Challenge();
        $challenge9->setName('5');
        $challenge9->setXp(1800);
        $manager->persist($challenge9);
        $this->addReference(self::CHALLENGE_5, $challenge9);

        $challenge10 = new Challenge();
        $challenge10->setName('6');
        $challenge10->setXp(2300);
        $manager->persist($challenge10);
        $this->addReference(self::CHALLENGE_6, $challenge10);

        $challenge11 = new Challenge();
        $challenge11->setName('7');
        $challenge11->setXp(2900);
        $manager->persist($challenge11);
        $this->addReference(self::CHALLENGE_7, $challenge11);

        $challenge12 = new Challenge();
        $challenge12->setName('8');
        $challenge12->setXp(3900);
        $manager->persist($challenge12);
        $this->addReference(self::CHALLENGE_8, $challenge12);

        $challenge13 = new Challenge();
        $challenge13->setName('9');
        $challenge13->setXp(5000);
        $manager->persist($challenge13);
        $this->addReference(self::CHALLENGE_9, $challenge13);

        $challenge14 = new Challenge();
        $challenge14->setName('10');
        $challenge14->setXp(5900);
        $manager->persist($challenge14);
        $this->addReference(self::CHALLENGE_10, $challenge14);

        $challenge15 = new Challenge();
        $challenge15->setName('11');
        $challenge15->setXp(7200);
        $manager->persist($challenge15);
        $this->addReference(self::CHALLENGE_11, $challenge15);

        $challenge16 = new Challenge();
        $challenge16->setName('12');
        $challenge16->setXp(8400);
        $manager->persist($challenge16);
        $this->addReference(self::CHALLENGE_12, $challenge16);

        $challenge17 = new Challenge();
        $challenge17->setName('13');
        $challenge17->setXp(10000);
        $manager->persist($challenge17);
        $this->addReference(self::CHALLENGE_13, $challenge17);

        $challenge18 = new Challenge();
        $challenge18->setName('14');
        $challenge18->setXp(11500);
        $manager->persist($challenge18);
        $this->addReference(self::CHALLENGE_14, $challenge18);

        $challenge19 = new Challenge();
        $challenge19->setName('15');
        $challenge19->setXp(13000);
        $manager->persist($challenge19);
        $this->addReference(self::CHALLENGE_15, $challenge19);

        $challenge20 = new Challenge();
        $challenge20->setName('16');
        $challenge20->setXp(15000);
        $manager->persist($challenge20);
        $this->addReference(self::CHALLENGE_16, $challenge20);

        $challenge21 = new Challenge();
        $challenge21->setName('17');
        $challenge21->setXp(18000);
        $manager->persist($challenge21);
        $this->addReference(self::CHALLENGE_17, $challenge21);

        $challenge22 = new Challenge();
        $challenge22->setName('18');
        $challenge22->setXp(20000);
        $manager->persist($challenge22);
        $this->addReference(self::CHALLENGE_18, $challenge22);

        $challenge23 = new Challenge();
        $challenge23->setName('19');
        $challenge23->setXp(22000);
        $manager->persist($challenge23);
        $this->addReference(self::CHALLENGE_19, $challenge23);

        $challenge24 = new Challenge();
        $challenge24->setName('20');
        $challenge24->setXp(25000);
        $manager->persist($challenge24);
        $this->addReference(self::CHALLENGE_20, $challenge24);

        $challenge25 = new Challenge();
        $challenge25->setName('21');
        $challenge25->setXp(33000);
        $manager->persist($challenge25);
        $this->addReference(self::CHALLENGE_21, $challenge25);

        $challenge26 = new Challenge();
        $challenge26->setName('22');
        $challenge26->setXp(41000);
        $manager->persist($challenge26);
        $this->addReference(self::CHALLENGE_22, $challenge26);

        $challenge27 = new Challenge();
        $challenge27->setName('23');
        $challenge27->setXp(50000);
        $manager->persist($challenge27);
        $this->addReference(self::CHALLENGE_23, $challenge27);

        $challenge28 = new Challenge();
        $challenge28->setName('24');
        $challenge28->setXp(62000);
        $manager->persist($challenge28);
        $this->addReference(self::CHALLENGE_24, $challenge28);

        $challenge29 = new Challenge();
        $challenge29->setName('25');
        $challenge29->setXp(75000);
        $manager->persist($challenge29);
        $this->addReference(self::CHALLENGE_25, $challenge29);

        $challenge30 = new Challenge();
        $challenge30->setName('26');
        $challenge30->setXp(90000);
        $manager->persist($challenge30);
        $this->addReference(self::CHALLENGE_26, $challenge30);

        $challenge31 = new Challenge();
        $challenge31->setName('27');
        $challenge31->setXp(105000);
        $manager->persist($challenge31);
        $this->addReference(self::CHALLENGE_27, $challenge31);

        $challenge32 = new Challenge();
        $challenge32->setName('28');
        $challenge32->setXp(120000);
        $manager->persist($challenge32);
        $this->addReference(self::CHALLENGE_28, $challenge32);

        $challenge33 = new Challenge();
        $challenge33->setName('29');
        $challenge33->setXp(135000);
        $manager->persist($challenge33);
        $this->addReference(self::CHALLENGE_29, $challenge33);

        $challenge34 = new Challenge();
        $challenge34->setName('30');
        $challenge34->setXp(155000);
        $manager->persist($challenge34);
        $this->addReference(self::CHALLENGE_30, $challenge34);


        $manager->flush();
    }
}