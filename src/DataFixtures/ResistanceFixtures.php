<?php

namespace App\DataFixtures;

use App\Entity\Resistance;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ResistanceFixtures extends Fixture
{
    public const RESISTANCE_ACID = 'resistance-acid';
    public const RESISTANCE_BLUDGEONING = 'resistance-bludgeoning';
    public const RESISTANCE_COLD = 'resistance-cold';
    public const RESISTANCE_FIRE = 'resistance-fire';
    public const RESISTANCE_FORCE = 'resistance-force';
    public const RESISTANCE_LIGHTNING = 'resistance-lightning';
    public const RESISTANCE_NECROTIC = 'resistance-necrotic';
    public const RESISTANCE_PIERCING = 'resistance-piercing';
    public const RESISTANCE_POISON = 'resistance-poison';
    public const RESISTANCE_PSYCHIC = 'resistance-psychic';
    public const RESISTANCE_RADIANT = 'resistance-radiant';
    public const RESISTANCE_SLASHING = 'resistance-slashing';
    public const RESISTANCE_THUNDER = 'resistance-thunder';
    public const RESISTANCE_NON_MAGICAL_BLUDGEONING = 'resistance-non-magical-bludgeoning';
    public const RESISTANCE_NON_COLD_IRON_BLUDGEONING = 'resistance-non-cold-iron-bludgeoning';
    public const RESISTANCE_NON_ADAMANTINE_BLUDGEONING = 'resistance-non-adamantine-bludgeoning';
    public const RESISTANCE_NON_SILVER_BLUDGEONING = 'resistance-non-silver-bludgeoning';
    public const RESISTANCE_NON_MAGICAL_PIERCING = 'resistance-non-magical-piercing';
    public const RESISTANCE_NON_COLD_IRON_PIERCING = 'resistance-non-cold-iron-piercing';
    public const RESISTANCE_NON_ADAMANTINE_PIERCING = 'resistance-non-adamantine-piercing';
    public const RESISTANCE_NON_SILVER_PIERCING = 'resistance-non-silver-piercing';
    public const RESISTANCE_NON_MAGICAL_SLASHING = 'resistance-non-magical-slashing';
    public const RESISTANCE_NON_COLD_IRON_SLASHING = 'resistance-non-cold-iron-slashing';
    public const RESISTANCE_NON_ADAMANTINE_SLASHING = 'resistance-non-adamantine-slashing';
    public const RESISTANCE_NON_SILVER_SLASHING = 'resistance-non-silver-slashing';
    public const RESISTANCE_NON_MAGICAL_PIERCING_AND_SLASHING = 'resistance-non-magical-piercing-and-slashing';
    public const RESISTANCE_NON_COLD_IRON_PIERCING_AND_SLASHING = 'resistance-non-cold-iron-piercing-and-slashing';
    public const RESISTANCE_NON_ADAMANTINE_PIERCING_AND_SLASHING = 'resistance-non-adamantine-piercing-and-slashing';
    public const RESISTANCE_NON_SILVER_PIERCING_AND_SLASHING = 'resistance-non-silver-piercing-and-slashing';
    public const RESISTANCE_NON_MAGICAL_BLUDGEONING_AND_SLASHING = 'resistance-non-magical-bludgeoning-and-slashing';
    public const RESISTANCE_NON_COLD_IRON_BLUDGEONING_AND_SLASHING = 'resistance-non-cold-iron-bludgeoning-and-slashing';
    public const RESISTANCE_NON_ADAMANTINE_BLUDGEONING_AND_SLASHING = 'resistance-non-adamantine-bludgeoning-and-slashing';
    public const RESISTANCE_NON_SILVER_BLUDGEONING_AND_SLASHING = 'resistance-non-silver-bludgeoning-and-slashing';
    public const RESISTANCE_NON_MAGICAL_BLUDGEONING_AND_PIERCING = 'resistance-non-magical-bludgeoning-and-piercing';
    public const RESISTANCE_NON_COLD_IRON_BLUDGEONING_AND_PIERCING = 'resistance-non-cold-iron-bludgeoning-and-piercing';
    public const RESISTANCE_NON_ADAMANTINE_BLUDGEONING_AND_PIERCING = 'resistance-non-adamantine-bludgeoning-and-piercing';
    public const RESISTANCE_NON_SILVER_BLUDGEONING_AND_PIERCING = 'resistance-non-silver-bludgeoning-and-piercing';
    public const RESISTANCE_NON_MAGICAL_BLUDGEONING_AND_PIERCING_AND_SLASHING = 'resistance-non-magical-bludgeoning-and-piercing-and-slashing';
    public const RESISTANCE_NON_COLD_IRON_BLUDGEONING_AND_PIERCING_AND_SLASHING = 'resistance-non-cold-iron-bludgeoning-and-piercing-and-slashing';
    public const RESISTANCE_NON_ADAMANTINE_BLUDGEONING_AND_PIERCING_AND_SLASHING = 'resistance-non-adamantine-bludgeoning-and-piercing-and-slashing';
    public const RESISTANCE_NON_SILVER_BLUDGEONING_AND_PIERCING_AND_SLASHING = 'resistance-non-silver-bludgeoning-and-piercing-and-slashing';

    public function load(ObjectManager $manager): void
    {
        $acid = new Resistance();
        $acid->setName('d\'acide');
        $manager->persist($acid);
        $this->addReference(self::RESISTANCE_ACID, $acid);

        $bludgeoning = new Resistance();
        $bludgeoning->setName('contondants');
        $manager->persist($bludgeoning);
        $this->addReference(self::RESISTANCE_BLUDGEONING, $bludgeoning);

        $cold = new Resistance();
        $cold->setName('de froid');
        $manager->persist($cold);
        $this->addReference(self::RESISTANCE_COLD, $cold);

        $fire = new Resistance();
        $fire->setName('de feu');
        $manager->persist($fire);
        $this->addReference(self::RESISTANCE_FIRE, $fire);

        $force = new Resistance();
        $force->setName('de force');
        $manager->persist($force);
        $this->addReference(self::RESISTANCE_FORCE, $force);

        $lightning = new Resistance();
        $lightning->setName('de foudre');
        $manager->persist($lightning);
        $this->addReference(self::RESISTANCE_LIGHTNING, $lightning);

        $necrotic = new Resistance();
        $necrotic->setName('nécrotiques');
        $manager->persist($necrotic);
        $this->addReference(self::RESISTANCE_NECROTIC, $necrotic);

        $piercing = new Resistance();
        $piercing->setName('perforants');
        $manager->persist($piercing);
        $this->addReference(self::RESISTANCE_PIERCING, $piercing);

        $poison = new Resistance();
        $poison->setName('de poison');
        $manager->persist($poison);
        $this->addReference(self::RESISTANCE_POISON, $poison);

        $psychic = new Resistance();
        $psychic->setName('psychiques');
        $manager->persist($psychic);
        $this->addReference(self::RESISTANCE_PSYCHIC, $psychic);

        $radiant = new Resistance();
        $radiant->setName('radiants');
        $manager->persist($radiant);
        $this->addReference(self::RESISTANCE_RADIANT, $radiant);

        $slashing = new Resistance();
        $slashing->setName('tranchants');
        $manager->persist($slashing);
        $this->addReference(self::RESISTANCE_SLASHING, $slashing);

        $thunder = new Resistance();
        $thunder->setName('de tonnerre');
        $manager->persist($thunder);
        $this->addReference(self::RESISTANCE_THUNDER, $thunder);

        //contondants infligés par des attaques non-magiques
        $nonMagicalBludgeoning = new Resistance();
        $nonMagicalBludgeoning->setName('contondants infligés par des attaques non-magiques');
        $manager->persist($nonMagicalBludgeoning);
        $this->addReference(self::RESISTANCE_NON_MAGICAL_BLUDGEONING, $nonMagicalBludgeoning);

        // contondants infligés par des armes qui ne sont pas en fer froid
        $nonColdIronBludgeoning = new Resistance();
        $nonColdIronBludgeoning->setName('contondants infligés par des armes qui ne sont pas en fer froid');
        $manager->persist($nonColdIronBludgeoning);
        $this->addReference(self::RESISTANCE_NON_COLD_IRON_BLUDGEONING, $nonColdIronBludgeoning);

        // contondants infligés par des attaques non-magiques qui ne sont pas en adamantium
        $nonAdamantineBludgeoning = new Resistance();
        $nonAdamantineBludgeoning->setName('contondants infligés par des attaques non-magiques qui ne sont pas en adamantium');
        $manager->persist($nonAdamantineBludgeoning);
        $this->addReference(self::RESISTANCE_NON_ADAMANTINE_BLUDGEONING, $nonAdamantineBludgeoning);


        // contondants infligés par des attaques non-magiques qui ne sont pas en argent
        $nonSilverBludgeoning = new Resistance();
        $nonSilverBludgeoning->setName('contondants infligés par des attaques non-magiques qui ne sont pas en argent');
        $manager->persist($nonSilverBludgeoning);
        $this->addReference(self::RESISTANCE_NON_SILVER_BLUDGEONING, $nonSilverBludgeoning);

        //perforants infligés par des attaques non-magiques
        $nonMagicalPiercing = new Resistance();
        $nonMagicalPiercing->setName('perforants infligés par des attaques non-magiques');
        $manager->persist($nonMagicalPiercing);
        $this->addReference(self::RESISTANCE_NON_MAGICAL_PIERCING, $nonMagicalPiercing);

        // perforants infligés par des armes qui ne sont pas en fer froid
        $nonColdIronPiercing = new Resistance();
        $nonColdIronPiercing->setName('perforants infligés par des armes qui ne sont pas en fer froid');
        $manager->persist($nonColdIronPiercing);
        $this->addReference(self::RESISTANCE_NON_COLD_IRON_PIERCING, $nonColdIronPiercing);

        // perforants infligés par des attaques non-magiques qui ne sont pas en adamantium
        $nonAdamantinePiercing = new Resistance();
        $nonAdamantinePiercing->setName('perforants infligés par des attaques non-magiques qui ne sont pas en adamantium');
        $manager->persist($nonAdamantinePiercing);
        $this->addReference(self::RESISTANCE_NON_ADAMANTINE_PIERCING, $nonAdamantinePiercing);

        // perforants infligés par des attaques non-magiques qui ne sont pas en argent
        $nonSilverPiercing = new Resistance();
        $nonSilverPiercing->setName('perforants infligés par des attaques non-magiques qui ne sont pas en argent');
        $manager->persist($nonSilverPiercing);
        $this->addReference(self::RESISTANCE_NON_SILVER_PIERCING, $nonSilverPiercing);

        // tranchants infligés par des attaques non-magiques
        $nonMagicalSlashing = new Resistance();
        $nonMagicalSlashing->setName('tranchants infligés par des attaques non-magiques');
        $manager->persist($nonMagicalSlashing);
        $this->addReference(self::RESISTANCE_NON_MAGICAL_SLASHING, $nonMagicalSlashing);

        // tranchants infligés par des armes qui ne sont pas en fer froid
        $nonColdIronSlashing = new Resistance();
        $nonColdIronSlashing->setName('tranchants infligés par des armes qui ne sont pas en fer froid');
        $manager->persist($nonColdIronSlashing);
        $this->addReference(self::RESISTANCE_NON_COLD_IRON_SLASHING, $nonColdIronSlashing);

        // tranchants infligés par des attaques non-magiques qui ne sont pas en adamantium
        $nonAdamantineSlashing = new Resistance();
        $nonAdamantineSlashing->setName('tranchants infligés par des attaques non-magiques qui ne sont pas en adamantium');
        $manager->persist($nonAdamantineSlashing);
        $this->addReference(self::RESISTANCE_NON_ADAMANTINE_SLASHING, $nonAdamantineSlashing);

        // tranchants infligés par des attaques non-magiques qui ne sont pas en argent
        $nonSilverSlashing = new Resistance();
        $nonSilverSlashing->setName('tranchants infligés par des attaques non-magiques qui ne sont pas en argent');
        $manager->persist($nonSilverSlashing);
        $this->addReference(self::RESISTANCE_NON_SILVER_SLASHING, $nonSilverSlashing);

        // perforants, et tranchants infligés par des attaques non-magiques
        $nonMagicalPiercingAndSlashing = new Resistance();
        $nonMagicalPiercingAndSlashing->setName('perforants, et tranchants infligés par des attaques non-magiques');
        $manager->persist($nonMagicalPiercingAndSlashing);
        $this->addReference(self::RESISTANCE_NON_MAGICAL_PIERCING_AND_SLASHING, $nonMagicalPiercingAndSlashing);

        // perforants, et tranchants infligés par des armes qui ne sont pas en fer froid
        $nonColdIronPiercingAndSlashing = new Resistance();
        $nonColdIronPiercingAndSlashing->setName('perforants, et tranchants infligés par des armes qui ne sont pas en fer froid');
        $manager->persist($nonColdIronPiercingAndSlashing);
        $this->addReference(self::RESISTANCE_NON_COLD_IRON_PIERCING_AND_SLASHING, $nonColdIronPiercingAndSlashing);

        // perforants, et tranchants infligés par des attaques non-magiques qui ne sont pas en adamantium
        $nonAdamantinePiercingAndSlashing = new Resistance();
        $nonAdamantinePiercingAndSlashing->setName('perforants, et tranchants infligés par des attaques non-magiques qui ne sont pas en adamantium');
        $manager->persist($nonAdamantinePiercingAndSlashing);
        $this->addReference(self::RESISTANCE_NON_ADAMANTINE_PIERCING_AND_SLASHING, $nonAdamantinePiercingAndSlashing);

        // perforants, et tranchants infligés par des attaques non-magiques qui ne sont pas en argent
        $nonSilverPiercingAndSlashing = new Resistance();
        $nonSilverPiercingAndSlashing->setName('perforants, et tranchants infligés par des attaques non-magiques qui ne sont pas en argent');
        $manager->persist($nonSilverPiercingAndSlashing);
        $this->addReference(self::RESISTANCE_NON_SILVER_PIERCING_AND_SLASHING, $nonSilverPiercingAndSlashing);

        // contondants et tranchants infligés par des attaques non-magiques
        $nonMagicalBludgeoningAndSlashing = new Resistance();
        $nonMagicalBludgeoningAndSlashing->setName('contondants et tranchants infligés par des attaques non-magiques');
        $manager->persist($nonMagicalBludgeoningAndSlashing);
        $this->addReference(self::RESISTANCE_NON_MAGICAL_BLUDGEONING_AND_SLASHING, $nonMagicalBludgeoningAndSlashing);

        // contondants et tranchants infligés par des armes qui ne sont pas en fer froid
        $nonColdIronBludgeoningAndSlashing = new Resistance();
        $nonColdIronBludgeoningAndSlashing->setName('contondants et tranchants infligés par des armes qui ne sont pas en fer froid');
        $manager->persist($nonColdIronBludgeoningAndSlashing);
        $this->addReference(self::RESISTANCE_NON_COLD_IRON_BLUDGEONING_AND_SLASHING, $nonColdIronBludgeoningAndSlashing);

        // contondants et tranchants infligés par des attaques non-magiques qui ne sont pas en adamantium
        $nonAdamantineBludgeoningAndSlashing = new Resistance();
        $nonAdamantineBludgeoningAndSlashing->setName('contondants et tranchants infligés par des attaques non-magiques qui ne sont pas en adamantium');
        $manager->persist($nonAdamantineBludgeoningAndSlashing);
        $this->addReference(self::RESISTANCE_NON_ADAMANTINE_BLUDGEONING_AND_SLASHING, $nonAdamantineBludgeoningAndSlashing);

        // contondants et tranchants infligés par des attaques non-magiques qui ne sont pas en argent
        $nonSilverBludgeoningAndSlashing = new Resistance();
        $nonSilverBludgeoningAndSlashing->setName('contondants et tranchants infligés par des attaques non-magiques qui ne sont pas en argent');
        $manager->persist($nonSilverBludgeoningAndSlashing);
        $this->addReference(self::RESISTANCE_NON_SILVER_BLUDGEONING_AND_SLASHING, $nonSilverBludgeoningAndSlashing);

        // contondants et perforants infligés par des attaques non-magiques
        $nonMagicalBludgeoningAndPiercing = new Resistance();
        $nonMagicalBludgeoningAndPiercing->setName('contondants et perforants infligés par des attaques non-magiques');
        $manager->persist($nonMagicalBludgeoningAndPiercing);
        $this->addReference(self::RESISTANCE_NON_MAGICAL_BLUDGEONING_AND_PIERCING, $nonMagicalBludgeoningAndPiercing);

        // contondants et perforants infligés par des armes qui ne sont pas en fer froid
        $nonColdIronBludgeoningAndPiercing = new Resistance();
        $nonColdIronBludgeoningAndPiercing->setName('contondants et perforants infligés par des armes qui ne sont pas en fer froid');
        $manager->persist($nonColdIronBludgeoningAndPiercing);
        $this->addReference(self::RESISTANCE_NON_COLD_IRON_BLUDGEONING_AND_PIERCING, $nonColdIronBludgeoningAndPiercing);

        // contondants et perforants infligés par des attaques non-magiques qui ne sont pas en adamantium
        $nonAdamantineBludgeoningAndPiercing = new Resistance();
        $nonAdamantineBludgeoningAndPiercing->setName('contondants et perforants infligés par des attaques non-magiques qui ne sont pas en adamantium');
        $manager->persist($nonAdamantineBludgeoningAndPiercing);
        $this->addReference(self::RESISTANCE_NON_ADAMANTINE_BLUDGEONING_AND_PIERCING, $nonAdamantineBludgeoningAndPiercing);

        // contondants et perforants infligés par des attaques non-magiques qui ne sont pas en argent
        $nonSilverBludgeoningAndPiercing = new Resistance();
        $nonSilverBludgeoningAndPiercing->setName('contondants et perforants infligés par des attaques non-magiques qui ne sont pas en argent');
        $manager->persist($nonSilverBludgeoningAndPiercing);
        $this->addReference(self::RESISTANCE_NON_SILVER_BLUDGEONING_AND_PIERCING, $nonSilverBludgeoningAndPiercing);

        // contondants, perforants et tranchants infligés par des attaques non-magiques
        $nonMagicalBludgeoningAndPiercingAndSlashing = new Resistance();
        $nonMagicalBludgeoningAndPiercingAndSlashing->setName('contondants, perforants et tranchants infligés par des attaques non-magiques');
        $manager->persist($nonMagicalBludgeoningAndPiercingAndSlashing);
        $this->addReference(self::RESISTANCE_NON_MAGICAL_BLUDGEONING_AND_PIERCING_AND_SLASHING, $nonMagicalBludgeoningAndPiercingAndSlashing);

        // contondants, perforants et tranchants infligés par des armes qui ne sont pas en fer froid
        $nonColdIronBludgeoningAndPiercingAndSlashing = new Resistance();
        $nonColdIronBludgeoningAndPiercingAndSlashing->setName('contondants, perforants et tranchants infligés par des armes qui ne sont pas en fer froid');
        $manager->persist($nonColdIronBludgeoningAndPiercingAndSlashing);
        $this->addReference(self::RESISTANCE_NON_COLD_IRON_BLUDGEONING_AND_PIERCING_AND_SLASHING, $nonColdIronBludgeoningAndPiercingAndSlashing);

        // contondants, perforants et tranchants infligés par des attaques non-magiques qui ne sont pas en adamantium
        $nonAdamantineBludgeoningAndPiercingAndSlashing = new Resistance();
        $nonAdamantineBludgeoningAndPiercingAndSlashing->setName('contondants, perforants et tranchants infligés par des attaques non-magiques qui ne sont pas en adamantium');
        $manager->persist($nonAdamantineBludgeoningAndPiercingAndSlashing);
        $this->addReference(self::RESISTANCE_NON_ADAMANTINE_BLUDGEONING_AND_PIERCING_AND_SLASHING, $nonAdamantineBludgeoningAndPiercingAndSlashing);

        // contondants, perforants et tranchants infligés par des attaques non-magiques qui ne sont pas en argent
        $nonSilverBludgeoningAndPiercingAndSlashing = new Resistance();
        $nonSilverBludgeoningAndPiercingAndSlashing->setName('contondants, perforants et tranchants infligés par des attaques non-magiques qui ne sont pas en argent');
        $manager->persist($nonSilverBludgeoningAndPiercingAndSlashing);
        $this->addReference(self::RESISTANCE_NON_SILVER_BLUDGEONING_AND_PIERCING_AND_SLASHING, $nonSilverBludgeoningAndPiercingAndSlashing);

        $manager->flush();
    }
}