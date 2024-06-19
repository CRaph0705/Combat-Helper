<?php

namespace App\DataFixtures;

use App\Entity\Size;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SizeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $tiny = new Size();
        $tiny->setName('Très petit');
        $manager->persist($tiny);

        $small = new Size();
        $small->setName('Petit');
        $manager->persist($small);

        $medium = new Size();
        $medium->setName('Moyen');
        $manager->persist($medium);

        $large = new Size();
        $large->setName('Grand');
        $manager->persist($large);

        $huge = new Size();
        $huge->setName('Très grand');
        $manager->persist($huge);

        $gargantuan = new Size();
        $gargantuan->setName('Gigantesque');
        $manager->persist($gargantuan);

        $manager->flush();
    }
}