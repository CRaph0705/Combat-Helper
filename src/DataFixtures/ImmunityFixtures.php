<?php

namespace App\DataFixtures;

use App\Entity\Immunity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ImmunityFixtures extends Fixture
{
    public const IMMUNITY_ACID = 'immunity-acid';
    public const IMMUNITY_BLUDGEONING = 'immunity-bludgeoning';
    public const IMMUNITY_COLD = 'immunity-cold';
    public const IMMUNITY_FIRE = 'immunity-fire';
    public const IMMUNITY_FORCE = 'immunity-force';
    public const IMMUNITY_LIGHTNING = 'immunity-lightning';
    public const IMMUNITY_NECROTIC = 'immunity-necrotic';
    public const IMMUNITY_PIERCING = 'immunity-piercing';
    public const IMMUNITY_POISON = 'immunity-poison';
    public const IMMUNITY_PSYCHIC = 'immunity-psychic';
    public const IMMUNITY_RADIANT = 'immunity-radiant';
    public const IMMUNITY_SLASHING = 'immunity-slashing';
    public const IMMUNITY_THUNDER = 'immunity-thunder';
    public const IMMUNITY_NON_MAGICAL_BLUDGEONING = 'immunity-non-magical-bludgeoning';
    public const IMMUNITY_NON_COLD_IRON_BLUDGEONING = 'immunity-non-cold-iron-bludgeoning';
    public const IMMUNITY_NON_ADAMANTINE_BLUDGEONING = 'immunity-non-adamantine-bludgeoning';
    public const IMMUNITY_NON_SILVER_BLUDGEONING = 'immunity-non-silver-bludgeoning';
    public const IMMUNITY_NON_MAGICAL_PIERCING = 'immunity-non-magical-piercing';
    public const IMMUNITY_NON_COLD_IRON_PIERCING = 'immunity-non-cold-iron-piercing';
    public const IMMUNITY_NON_ADAMANTINE_PIERCING = 'immunity-non-adamantine-piercing';
    public const IMMUNITY_NON_SILVER_PIERCING = 'immunity-non-silver-piercing';
    public const IMMUNITY_NON_MAGICAL_SLASHING = 'immunity-non-magical-slashing';
    public const IMMUNITY_NON_COLD_IRON_SLASHING = 'immunity-non-cold-iron-slashing';
    public const IMMUNITY_NON_ADAMANTINE_SLASHING = 'immunity-non-adamantine-slashing';
    public const IMMUNITY_NON_SILVER_SLASHING = 'immunity-non-silver-slashing';
    public const IMMUNITY_NON_MAGICAL_PIERCING_AND_SLASHING = 'immunity-non-magical-piercing-and-slashing';
    public const IMMUNITY_NON_COLD_IRON_PIERCING_AND_SLASHING = 'immunity-non-cold-iron-piercing-and-slashing';
    public const IMMUNITY_NON_ADAMANTINE_PIERCING_AND_SLASHING = 'immunity-non-adamantine-piercing-and-slashing';
    public const IMMUNITY_NON_SILVER_PIERCING_AND_SLASHING = 'immunity-non-silver-piercing-and-slashing';
    public const IMMUNITY_NON_MAGICAL_BLUDGEONING_AND_SLASHING = 'immunity-non-magical-bludgeoning-and-slashing';
    public const IMMUNITY_NON_COLD_IRON_BLUDGEONING_AND_SLASHING = 'immunity-non-cold-iron-bludgeoning-and-slashing';
    public const IMMUNITY_NON_ADAMANTINE_BLUDGEONING_AND_SLASHING = 'immunity-non-adamantine-bludgeoning-and-slashing';
    public const IMMUNITY_NON_SILVER_BLUDGEONING_AND_SLASHING = 'immunity-non-silver-bludgeoning-and-slashing';
    public const IMMUNITY_NON_MAGICAL_BLUDGEONING_AND_PIERCING = 'immunity-non-magical-bludgeoning-and-piercing';
    public const IMMUNITY_NON_COLD_IRON_BLUDGEONING_AND_PIERCING = 'immunity-non-cold-iron-bludgeoning-and-piercing';
    public const IMMUNITY_NON_ADAMANTINE_BLUDGEONING_AND_PIERCING = 'immunity-non-adamantine-bludgeoning-and-piercing';
    public const IMMUNITY_NON_SILVER_BLUDGEONING_AND_PIERCING = 'immunity-non-silver-bludgeoning-and-piercing';
    public const IMMUNITY_NON_MAGICAL_BLUDGEONING_AND_PIERCING_AND_SLASHING = 'immunity-non-magical-bludgeoning-and-piercing-and-slashing';
    public const IMMUNITY_NON_COLD_IRON_BLUDGEONING_AND_PIERCING_AND_SLASHING = 'immunity-non-cold-iron-bludgeoning-and-piercing-and-slashing';
    public const IMMUNITY_NON_ADAMANTINE_BLUDGEONING_AND_PIERCING_AND_SLASHING = 'immunity-non-adamantine-bludgeoning-and-piercing-and-slashing';
    public const IMMUNITY_NON_SILVER_BLUDGEONING_AND_PIERCING_AND_SLASHING = 'immunity-non-silver-bludgeoning-and-piercing-and-slashing';
    public const IMMUNITY_NON_MAGICAL_NON_ADAMANTINE_BLUDGEONING_AND_PIERCING_AND_SLASHING = 'immunity-non-magical-non-adamantine-bludgeoning-and-piercing-and-slashing';
    public const IMMUNITY_NON_MAGICAL_NON_SILVER_BLUDGEONING_AND_PIERCING_AND_SLASHING = 'immunity-non-magical-non-silver-bludgeoning-and-piercing-and-slashing';

    public function load(ObjectManager $manager): void
    {
        $acid = new Immunity();
        $acid->setName('d\'acide');
        $manager->persist($acid);
        $this->addReference(self::IMMUNITY_ACID, $acid);

        $bludgeoning = new Immunity();
        $bludgeoning->setName('contondants');
        $manager->persist($bludgeoning);
        $this->addReference(self::IMMUNITY_BLUDGEONING, $bludgeoning);

        $cold = new Immunity();
        $cold->setName('de froid');
        $manager->persist($cold);
        $this->addReference(self::IMMUNITY_COLD, $cold);

        $fire = new Immunity();
        $fire->setName('de feu');
        $manager->persist($fire);
        $this->addReference(self::IMMUNITY_FIRE, $fire);

        $force = new Immunity();
        $force->setName('de force');
        $manager->persist($force);
        $this->addReference(self::IMMUNITY_FORCE, $force);

        $lightning = new Immunity();
        $lightning->setName('de foudre');
        $manager->persist($lightning);
        $this->addReference(self::IMMUNITY_LIGHTNING, $lightning);

        $necrotic = new Immunity();
        $necrotic->setName('nécrotiques');
        $manager->persist($necrotic);
        $this->addReference(self::IMMUNITY_NECROTIC, $necrotic);

        $piercing = new Immunity();
        $piercing->setName('perforants');
        $manager->persist($piercing);
        $this->addReference(self::IMMUNITY_PIERCING, $piercing);

        $poison = new Immunity();
        $poison->setName('de poison');
        $manager->persist($poison);
        $this->addReference(self::IMMUNITY_POISON, $poison);

        $psychic = new Immunity();
        $psychic->setName('psychiques');
        $manager->persist($psychic);
        $this->addReference(self::IMMUNITY_PSYCHIC, $psychic);

        $radiant = new Immunity();
        $radiant->setName('radiants');
        $manager->persist($radiant);
        $this->addReference(self::IMMUNITY_RADIANT, $radiant);

        $slashing = new Immunity();
        $slashing->setName('tranchants');
        $manager->persist($slashing);
        $this->addReference(self::IMMUNITY_SLASHING, $slashing);

        $thunder = new Immunity();
        $thunder->setName('de tonnerre');
        $manager->persist($thunder);
        $this->addReference(self::IMMUNITY_THUNDER, $thunder);

        //contondants infligés par des attaques non-magiques
        $nonMagicalBludgeoning = new Immunity();
        $nonMagicalBludgeoning->setName('contondants infligés par des attaques non-magiques');
        $manager->persist($nonMagicalBludgeoning);
        $this->addReference(self::IMMUNITY_NON_MAGICAL_BLUDGEONING, $nonMagicalBludgeoning);

        // contondants infligés par des armes qui ne sont pas en fer froid
        $nonColdIronBludgeoning = new Immunity();
        $nonColdIronBludgeoning->setName('contondants infligés par des armes qui ne sont pas en fer froid');
        $manager->persist($nonColdIronBludgeoning);
        $this->addReference(self::IMMUNITY_NON_COLD_IRON_BLUDGEONING, $nonColdIronBludgeoning);

        // contondants infligés par des attaques non-magiques qui ne sont pas en adamantium
        $nonAdamantineBludgeoning = new Immunity();
        $nonAdamantineBludgeoning->setName('contondants infligés par des attaques non-magiques qui ne sont pas en adamantium');
        $manager->persist($nonAdamantineBludgeoning);
        $this->addReference(self::IMMUNITY_NON_ADAMANTINE_BLUDGEONING, $nonAdamantineBludgeoning);


        // contondants infligés par des attaques non-magiques qui ne sont pas en argent
        $nonSilverBludgeoning = new Immunity();
        $nonSilverBludgeoning->setName('contondants infligés par des attaques non-magiques qui ne sont pas en argent');
        $manager->persist($nonSilverBludgeoning);
        $this->addReference(self::IMMUNITY_NON_SILVER_BLUDGEONING, $nonSilverBludgeoning);

        //perforants infligés par des attaques non-magiques
        $nonMagicalPiercing = new Immunity();
        $nonMagicalPiercing->setName('perforants infligés par des attaques non-magiques');
        $manager->persist($nonMagicalPiercing);
        $this->addReference(self::IMMUNITY_NON_MAGICAL_PIERCING, $nonMagicalPiercing);

        // perforants infligés par des armes qui ne sont pas en fer froid
        $nonColdIronPiercing = new Immunity();
        $nonColdIronPiercing->setName('perforants infligés par des armes qui ne sont pas en fer froid');
        $manager->persist($nonColdIronPiercing);
        $this->addReference(self::IMMUNITY_NON_COLD_IRON_PIERCING, $nonColdIronPiercing);

        // perforants infligés par des attaques non-magiques qui ne sont pas en adamantium
        $nonAdamantinePiercing = new Immunity();
        $nonAdamantinePiercing->setName('perforants infligés par des attaques non-magiques qui ne sont pas en adamantium');
        $manager->persist($nonAdamantinePiercing);
        $this->addReference(self::IMMUNITY_NON_ADAMANTINE_PIERCING, $nonAdamantinePiercing);

        // perforants infligés par des attaques non-magiques qui ne sont pas en argent
        $nonSilverPiercing = new Immunity();
        $nonSilverPiercing->setName('perforants infligés par des attaques non-magiques qui ne sont pas en argent');
        $manager->persist($nonSilverPiercing);
        $this->addReference(self::IMMUNITY_NON_SILVER_PIERCING, $nonSilverPiercing);

        // tranchants infligés par des attaques non-magiques
        $nonMagicalSlashing = new Immunity();
        $nonMagicalSlashing->setName('tranchants infligés par des attaques non-magiques');
        $manager->persist($nonMagicalSlashing);
        $this->addReference(self::IMMUNITY_NON_MAGICAL_SLASHING, $nonMagicalSlashing);

        // tranchants infligés par des armes qui ne sont pas en fer froid
        $nonColdIronSlashing = new Immunity();
        $nonColdIronSlashing->setName('tranchants infligés par des armes qui ne sont pas en fer froid');
        $manager->persist($nonColdIronSlashing);
        $this->addReference(self::IMMUNITY_NON_COLD_IRON_SLASHING, $nonColdIronSlashing);

        // tranchants infligés par des attaques non-magiques qui ne sont pas en adamantium
        $nonAdamantineSlashing = new Immunity();
        $nonAdamantineSlashing->setName('tranchants infligés par des attaques non-magiques qui ne sont pas en adamantium');
        $manager->persist($nonAdamantineSlashing);
        $this->addReference(self::IMMUNITY_NON_ADAMANTINE_SLASHING, $nonAdamantineSlashing);

        // tranchants infligés par des attaques non-magiques qui ne sont pas en argent
        $nonSilverSlashing = new Immunity();
        $nonSilverSlashing->setName('tranchants infligés par des attaques non-magiques qui ne sont pas en argent');
        $manager->persist($nonSilverSlashing);
        $this->addReference(self::IMMUNITY_NON_SILVER_SLASHING, $nonSilverSlashing);

        // perforants, et tranchants infligés par des attaques non-magiques
        $nonMagicalPiercingAndSlashing = new Immunity();
        $nonMagicalPiercingAndSlashing->setName('perforants, et tranchants infligés par des attaques non-magiques');
        $manager->persist($nonMagicalPiercingAndSlashing);
        $this->addReference(self::IMMUNITY_NON_MAGICAL_PIERCING_AND_SLASHING, $nonMagicalPiercingAndSlashing);

        // perforants, et tranchants infligés par des armes qui ne sont pas en fer froid
        $nonColdIronPiercingAndSlashing = new Immunity();
        $nonColdIronPiercingAndSlashing->setName('perforants, et tranchants infligés par des armes qui ne sont pas en fer froid');
        $manager->persist($nonColdIronPiercingAndSlashing);
        $this->addReference(self::IMMUNITY_NON_COLD_IRON_PIERCING_AND_SLASHING, $nonColdIronPiercingAndSlashing);

        // perforants, et tranchants infligés par des attaques non-magiques qui ne sont pas en adamantium
        $nonAdamantinePiercingAndSlashing = new Immunity();
        $nonAdamantinePiercingAndSlashing->setName('perforants, et tranchants infligés par des attaques non-magiques qui ne sont pas en adamantium');
        $manager->persist($nonAdamantinePiercingAndSlashing);
        $this->addReference(self::IMMUNITY_NON_ADAMANTINE_PIERCING_AND_SLASHING, $nonAdamantinePiercingAndSlashing);

        // perforants, et tranchants infligés par des attaques non-magiques qui ne sont pas en argent
        $nonSilverPiercingAndSlashing = new Immunity();
        $nonSilverPiercingAndSlashing->setName('perforants, et tranchants infligés par des attaques non-magiques qui ne sont pas en argent');
        $manager->persist($nonSilverPiercingAndSlashing);
        $this->addReference(self::IMMUNITY_NON_SILVER_PIERCING_AND_SLASHING, $nonSilverPiercingAndSlashing);

        // contondants et tranchants infligés par des attaques non-magiques
        $nonMagicalBludgeoningAndSlashing = new Immunity();
        $nonMagicalBludgeoningAndSlashing->setName('contondants et tranchants infligés par des attaques non-magiques');
        $manager->persist($nonMagicalBludgeoningAndSlashing);
        $this->addReference(self::IMMUNITY_NON_MAGICAL_BLUDGEONING_AND_SLASHING, $nonMagicalBludgeoningAndSlashing);

        // contondants et tranchants infligés par des armes qui ne sont pas en fer froid
        $nonColdIronBludgeoningAndSlashing = new Immunity();
        $nonColdIronBludgeoningAndSlashing->setName('contondants et tranchants infligés par des armes qui ne sont pas en fer froid');
        $manager->persist($nonColdIronBludgeoningAndSlashing);
        $this->addReference(self::IMMUNITY_NON_COLD_IRON_BLUDGEONING_AND_SLASHING, $nonColdIronBludgeoningAndSlashing);

        // contondants et tranchants infligés par des attaques non-magiques qui ne sont pas en adamantium
        $nonAdamantineBludgeoningAndSlashing = new Immunity();
        $nonAdamantineBludgeoningAndSlashing->setName('contondants et tranchants infligés par des attaques non-magiques qui ne sont pas en adamantium');
        $manager->persist($nonAdamantineBludgeoningAndSlashing);
        $this->addReference(self::IMMUNITY_NON_ADAMANTINE_BLUDGEONING_AND_SLASHING, $nonAdamantineBludgeoningAndSlashing);

        // contondants et tranchants infligés par des attaques non-magiques qui ne sont pas en argent
        $nonSilverBludgeoningAndSlashing = new Immunity();
        $nonSilverBludgeoningAndSlashing->setName('contondants et tranchants infligés par des attaques non-magiques qui ne sont pas en argent');
        $manager->persist($nonSilverBludgeoningAndSlashing);
        $this->addReference(self::IMMUNITY_NON_SILVER_BLUDGEONING_AND_SLASHING, $nonSilverBludgeoningAndSlashing);

        // contondants et perforants infligés par des attaques non-magiques
        $nonMagicalBludgeoningAndPiercing = new Immunity();
        $nonMagicalBludgeoningAndPiercing->setName('contondants et perforants infligés par des attaques non-magiques');
        $manager->persist($nonMagicalBludgeoningAndPiercing);
        $this->addReference(self::IMMUNITY_NON_MAGICAL_BLUDGEONING_AND_PIERCING, $nonMagicalBludgeoningAndPiercing);

        // contondants et perforants infligés par des armes qui ne sont pas en fer froid
        $nonColdIronBludgeoningAndPiercing = new Immunity();
        $nonColdIronBludgeoningAndPiercing->setName('contondants et perforants infligés par des armes qui ne sont pas en fer froid');
        $manager->persist($nonColdIronBludgeoningAndPiercing);
        $this->addReference(self::IMMUNITY_NON_COLD_IRON_BLUDGEONING_AND_PIERCING, $nonColdIronBludgeoningAndPiercing);

        // contondants et perforants infligés par des attaques non-magiques qui ne sont pas en adamantium
        $nonAdamantineBludgeoningAndPiercing = new Immunity();
        $nonAdamantineBludgeoningAndPiercing->setName('contondants et perforants infligés par des attaques non-magiques qui ne sont pas en adamantium');
        $manager->persist($nonAdamantineBludgeoningAndPiercing);
        $this->addReference(self::IMMUNITY_NON_ADAMANTINE_BLUDGEONING_AND_PIERCING, $nonAdamantineBludgeoningAndPiercing);

        // contondants et perforants infligés par des attaques non-magiques qui ne sont pas en argent
        $nonSilverBludgeoningAndPiercing = new Immunity();
        $nonSilverBludgeoningAndPiercing->setName('contondants et perforants infligés par des attaques non-magiques qui ne sont pas en argent');
        $manager->persist($nonSilverBludgeoningAndPiercing);
        $this->addReference(self::IMMUNITY_NON_SILVER_BLUDGEONING_AND_PIERCING, $nonSilverBludgeoningAndPiercing);

        // contondants, perforants et tranchants infligés par des attaques non-magiques
        $nonMagicalBludgeoningAndPiercingAndSlashing = new Immunity();
        $nonMagicalBludgeoningAndPiercingAndSlashing->setName('contondants, perforants et tranchants infligés par des attaques non-magiques');
        $manager->persist($nonMagicalBludgeoningAndPiercingAndSlashing);
        $this->addReference(self::IMMUNITY_NON_MAGICAL_BLUDGEONING_AND_PIERCING_AND_SLASHING, $nonMagicalBludgeoningAndPiercingAndSlashing);

        // contondants, perforants et tranchants infligés par des armes qui ne sont pas en fer froid
        $nonColdIronBludgeoningAndPiercingAndSlashing = new Immunity();
        $nonColdIronBludgeoningAndPiercingAndSlashing->setName('contondants, perforants et tranchants infligés par des armes qui ne sont pas en fer froid');
        $manager->persist($nonColdIronBludgeoningAndPiercingAndSlashing);
        $this->addReference(self::IMMUNITY_NON_COLD_IRON_BLUDGEONING_AND_PIERCING_AND_SLASHING, $nonColdIronBludgeoningAndPiercingAndSlashing);

        // contondants, perforants et tranchants infligés par des attaques non-magiques qui ne sont pas en adamantium
        $nonAdamantineBludgeoningAndPiercingAndSlashing = new Immunity();
        $nonAdamantineBludgeoningAndPiercingAndSlashing->setName('contondants, perforants et tranchants infligés par des attaques non-magiques qui ne sont pas en adamantium');
        $manager->persist($nonAdamantineBludgeoningAndPiercingAndSlashing);
        $this->addReference(self::IMMUNITY_NON_ADAMANTINE_BLUDGEONING_AND_PIERCING_AND_SLASHING, $nonAdamantineBludgeoningAndPiercingAndSlashing);

        // contondants, perforants et tranchants infligés par des attaques non-magiques qui ne sont pas en argent
        $nonSilverBludgeoningAndPiercingAndSlashing = new Immunity();
        $nonSilverBludgeoningAndPiercingAndSlashing->setName('contondants, perforants et tranchants infligés par des attaques non-magiques qui ne sont pas en argent');
        $manager->persist($nonSilverBludgeoningAndPiercingAndSlashing);
        $this->addReference(self::IMMUNITY_NON_SILVER_BLUDGEONING_AND_PIERCING_AND_SLASHING, $nonSilverBludgeoningAndPiercingAndSlashing);


        //contondants, perforants et tranchants infligés par des attaques non-magiques qui ne sont pas en adamantium
        $nonMagicalNonAdamantineBludgeoningAndPiercingAndSlashing = new Immunity();
        $nonMagicalNonAdamantineBludgeoningAndPiercingAndSlashing->setName('contondants, perforants et tranchants infligés par des attaques non-magiques qui ne sont pas en adamantium');
        $manager->persist($nonMagicalNonAdamantineBludgeoningAndPiercingAndSlashing);
        $this->addReference(self::IMMUNITY_NON_MAGICAL_NON_ADAMANTINE_BLUDGEONING_AND_PIERCING_AND_SLASHING, $nonMagicalNonAdamantineBludgeoningAndPiercingAndSlashing);

        // contondants, perforants et tranchants infligés par des armes non-magiques qui ne sont pas en argent
        $nonMagicalNonSilverBludgeoningAndPiercingAndSlashing = new Immunity();
        $nonMagicalNonSilverBludgeoningAndPiercingAndSlashing->setName('contondants, perforants et tranchants infligés par des armes non-magiques qui ne sont pas en argent');
        $manager->persist($nonMagicalNonSilverBludgeoningAndPiercingAndSlashing);
        $this->addReference(self::IMMUNITY_NON_MAGICAL_NON_SILVER_BLUDGEONING_AND_PIERCING_AND_SLASHING, $nonMagicalNonSilverBludgeoningAndPiercingAndSlashing);
    
        $manager->flush();
    }
}