<?php

namespace App\DataFixtures;

use App\Entity\Monster;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MonsterFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $rat = new Monster();
        $rat->setName('Rat');
        $rat->setHp(1);
        $rat->setAc(10);
        $rat->setSpeed('6 m');
        $rat->setStrength(2);
        $rat->setDexterity(11);
        $rat->setConstitution(9);
        $rat->setIntelligence(2);
        $rat->setWisdom(10);
        $rat->setCharisma(4);
        $rat->setDifficulty('0');
        $manager->persist($rat);

        $goblin = new Monster();
        $goblin->setName('Gobelin');
        $goblin->setHp(7);
        $goblin->setAc(15);
        $goblin->setSpeed('9 m');
        $goblin->setStrength(8);
        $goblin->setDexterity(14);
        $goblin->setConstitution(10);
        $goblin->setIntelligence(10);
        $goblin->setWisdom(8);
        $goblin->setCharisma(8);
        $goblin->setDifficulty('1/4');
        $manager->persist($goblin);

        $wolf = new Monster();
        $wolf->setName('Loup');
        $wolf->setHp(11);
        $wolf->setAc(13);
        $wolf->setSpeed('12 m');
        $wolf->setStrength(12);
        $wolf->setDexterity(15);
        $wolf->setConstitution(12);
        $wolf->setIntelligence(3);
        $wolf->setWisdom(12);
        $wolf->setCharisma(6);
        $wolf->setDifficulty('1/4');
        $manager->persist($wolf);

        $giantSpider = new Monster();
        $giantSpider->setName('Araignée géante');
        $giantSpider->setHp(26);
        $giantSpider->setAc(14);
        $giantSpider->setSpeed('9 m, escalade 9 m');
        $giantSpider->setStrength(14);
        $giantSpider->setDexterity(16);
        $giantSpider->setConstitution(12);
        $giantSpider->setIntelligence(2);
        $giantSpider->setWisdom(11);
        $giantSpider->setCharisma(4);
        $giantSpider->setDifficulty('1');
        $manager->persist($giantSpider);

        $pseudodragon = new Monster();
        $pseudodragon->setName('Pseudodragon');
        $pseudodragon->setHp(7);
        $pseudodragon->setAc(13);
        $pseudodragon->setSpeed('4,50 m, vol 18 m');
        $pseudodragon->setStrength(6);
        $pseudodragon->setDexterity(15);
        $pseudodragon->setConstitution(13);
        $pseudodragon->setIntelligence(10);
        $pseudodragon->setWisdom(12);
        $pseudodragon->setCharisma(10);
        $pseudodragon->setDifficulty('1/4');
        $manager->persist($pseudodragon);

        $troll = new Monster();
        $troll->setName('Troll');
        $troll->setHp(84);
        $troll->setAc(15);
        $troll->setSpeed('9 m');
        $troll->setStrength(18);
        $troll->setDexterity(13);
        $troll->setConstitution(20);
        $troll->setIntelligence(7);
        $troll->setWisdom(9);
        $troll->setCharisma(7);
        $troll->setDifficulty('5');
        $manager->persist($troll);

        $fireGiant = new Monster();
        $fireGiant->setName('Géant du feu');
        $fireGiant->setHp(162);
        $fireGiant->setAc(18);
        $fireGiant->setSpeed('9 m');
        $fireGiant->setStrength(25);
        $fireGiant->setDexterity(9);
        $fireGiant->setConstitution(23);
        $fireGiant->setIntelligence(10);
        $fireGiant->setWisdom(14);
        $fireGiant->setCharisma(13);
        $fireGiant->setDifficulty('9');
        $manager->persist($fireGiant);

        $shadowDemon = new Monster();
        $shadowDemon->setName('Démon des ombres');
        $shadowDemon->setHp(66);
        $shadowDemon->setAc(13);
        $shadowDemon->setSpeed('9 m, vol 9m');
        $shadowDemon->setStrength(1);
        $shadowDemon->setDexterity(17);
        $shadowDemon->setConstitution(12);
        $shadowDemon->setIntelligence(14);
        $shadowDemon->setWisdom(13);
        $shadowDemon->setCharisma(14);
        $shadowDemon->setDifficulty('4');
        $manager->persist($shadowDemon);

        $ghost = new Monster();
        $ghost->setName('Fantôme');
        $ghost->setHp(45);
        $ghost->setAc(11);
        $ghost->setSpeed('0 m, vol 12m stationnaire');
        $ghost->setStrength(7);
        $ghost->setDexterity(13);
        $ghost->setConstitution(10);
        $ghost->setIntelligence(10);
        $ghost->setWisdom(12);
        $ghost->setCharisma(17);
        $ghost->setDifficulty('4');
        $manager->persist($ghost);

        $zombie = new Monster();
        $zombie->setName('Zombi');
        $zombie->setHp(22);
        $zombie->setAc(8);
        $zombie->setSpeed('6 m');
        $zombie->setStrength(13);
        $zombie->setDexterity(6);
        $zombie->setConstitution(16);
        $zombie->setIntelligence(3);
        $zombie->setWisdom(6);
        $zombie->setCharisma(5);
        $zombie->setDifficulty('1/4');
        $manager->persist($zombie);

        $skeleton = new Monster();
        $skeleton->setName('Squelette');
        $skeleton->setHp(13);
        $skeleton->setAc(13);
        $skeleton->setSpeed('9 m');
        $skeleton->setStrength(10);
        $skeleton->setDexterity(14);
        $skeleton->setConstitution(15);
        $skeleton->setIntelligence(6);
        $skeleton->setWisdom(8);
        $skeleton->setCharisma(5);
        $skeleton->setDifficulty('1/4');
        $manager->persist($skeleton);

        $vampire = new Monster();
        $vampire->setName('Vampire');
        $vampire->setHp(144);
        $vampire->setAc(16);
        $vampire->setSpeed('9 m');
        $vampire->setStrength(18);
        $vampire->setDexterity(18);
        $vampire->setConstitution(18);
        $vampire->setIntelligence(17);
        $vampire->setWisdom(15);
        $vampire->setCharisma(18);
        $vampire->setDifficulty('13');
        $manager->persist($vampire);

        $lich = new Monster();
        $lich->setName('Liche');
        $lich->setHp(135);
        $lich->setAc(17);
        $lich->setSpeed('9 m');
        $lich->setStrength(11);
        $lich->setDexterity(16);
        $lich->setConstitution(16);
        $lich->setIntelligence(20);
        $lich->setWisdom(14);
        $lich->setCharisma(16);
        $lich->setDifficulty('21');
        $manager->persist($lich);
        
        $manager->flush();
    }
}
