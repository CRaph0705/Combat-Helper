<?php

namespace App\DataFixtures;

use App\Entity\Size;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SizeFixtures extends Fixture
{

    public const SIZE_TINY = 'tiny';
    public const SIZE_SMALL = 'small';
    public const SIZE_MEDIUM = 'medium';
    public const SIZE_LARGE = 'large';
    public const SIZE_HUGE = 'huge';
    public const SIZE_GARGANTUAN = 'gargantuan';

    public function load(ObjectManager $manager): void
    {
        $tiny = new Size();
        $tiny->setName('Très petit');
        $manager->persist($tiny);
        $this->addReference(self::SIZE_TINY, $tiny);

        $small = new Size();
        $small->setName('Petit');
        $manager->persist($small);
        $this->addReference(self::SIZE_SMALL, $small);

        $medium = new Size();
        $medium->setName('Moyen');
        $manager->persist($medium);
        $this->addReference(self::SIZE_MEDIUM, $medium);

        $large = new Size();
        $large->setName('Grand');
        $manager->persist($large);
        $this->addReference(self::SIZE_LARGE, $large);

        $huge = new Size();
        $huge->setName('Très grand');
        $manager->persist($huge);
        $this->addReference(self::SIZE_HUGE, $huge);

        $gargantuan = new Size();
        $gargantuan->setName('Gigantesque');
        $manager->persist($gargantuan);
        $this->addReference(self::SIZE_GARGANTUAN, $gargantuan);

        $manager->flush();
    }
}