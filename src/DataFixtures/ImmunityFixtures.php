<?php

namespace App\DataFixtures;

use App\Entity\Immunity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ImmunityFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $acid = new Immunity();
        $acid->setName('d\'acide');
        $manager->persist($acid);

        $bludgeoning = new Immunity();
        $bludgeoning->setName('contondants');
        $manager->persist($bludgeoning);

        $cold = new Immunity();
        $cold->setName('de froid');
        $manager->persist($cold);

        $fire = new Immunity();
        $fire->setName('de feu');
        $manager->persist($fire);

        $force = new Immunity();
        $force->setName('de force');
        $manager->persist($force);

        $lightning = new Immunity();
        $lightning->setName('de foudre');
        $manager->persist($lightning);

        $necrotic = new Immunity();
        $necrotic->setName('nécrotiques');
        $manager->persist($necrotic);

        $piercing = new Immunity();
        $piercing->setName('perforants');
        $manager->persist($piercing);

        $poison = new Immunity();
        $poison->setName('de poison');
        $manager->persist($poison);

        $psychic = new Immunity();
        $psychic->setName('psychiques');
        $manager->persist($psychic);

        $radiant = new Immunity();
        $radiant->setName('radiants');
        $manager->persist($radiant);

        $slashing = new Immunity();
        $slashing->setName('tranchants');
        $manager->persist($slashing);

        $thunder = new Immunity();
        $thunder->setName('de tonnerre');
        $manager->persist($thunder);

        //contondants infligés par des attaques non-magiques
        $nonMagicalBludgeoning = new Immunity();
        $nonMagicalBludgeoning->setName('contondants infligés par des attaques non-magiques');
        $manager->persist($nonMagicalBludgeoning);

        // contondants infligés par des armes qui ne sont pas en fer froid
        $nonColdIronBludgeoning = new Immunity();
        $nonColdIronBludgeoning->setName('contondants infligés par des armes qui ne sont pas en fer froid');
        $manager->persist($nonColdIronBludgeoning);

        // contondants infligés par des attaques non-magiques qui ne sont pas en adamantium
        $nonAdamantineBludgeoning = new Immunity();
        $nonAdamantineBludgeoning->setName('contondants infligés par des attaques non-magiques qui ne sont pas en adamantium');
        $manager->persist($nonAdamantineBludgeoning);


        // contondants infligés par des attaques non-magiques qui ne sont pas en argent
        $nonSilverBludgeoning = new Immunity();
        $nonSilverBludgeoning->setName('contondants infligés par des attaques non-magiques qui ne sont pas en argent');
        $manager->persist($nonSilverBludgeoning);

        //perforants infligés par des attaques non-magiques
        $nonMagicalPiercing = new Immunity();
        $nonMagicalPiercing->setName('perforants infligés par des attaques non-magiques');
        $manager->persist($nonMagicalPiercing);

        // perforants infligés par des armes qui ne sont pas en fer froid
        $nonColdIronPiercing = new Immunity();
        $nonColdIronPiercing->setName('perforants infligés par des armes qui ne sont pas en fer froid');
        $manager->persist($nonColdIronPiercing);

        // perforants infligés par des attaques non-magiques qui ne sont pas en adamantium
        $nonAdamantinePiercing = new Immunity();
        $nonAdamantinePiercing->setName('perforants infligés par des attaques non-magiques qui ne sont pas en adamantium');
        $manager->persist($nonAdamantinePiercing);

        // perforants infligés par des attaques non-magiques qui ne sont pas en argent
        $nonSilverPiercing = new Immunity();
        $nonSilverPiercing->setName('perforants infligés par des attaques non-magiques qui ne sont pas en argent');
        $manager->persist($nonSilverPiercing);

        // tranchants infligés par des attaques non-magiques
        $nonMagicalSlashing = new Immunity();
        $nonMagicalSlashing->setName('tranchants infligés par des attaques non-magiques');
        $manager->persist($nonMagicalSlashing);

        // tranchants infligés par des armes qui ne sont pas en fer froid
        $nonColdIronSlashing = new Immunity();
        $nonColdIronSlashing->setName('tranchants infligés par des armes qui ne sont pas en fer froid');
        $manager->persist($nonColdIronSlashing);

        // tranchants infligés par des attaques non-magiques qui ne sont pas en adamantium
        $nonAdamantineSlashing = new Immunity();
        $nonAdamantineSlashing->setName('tranchants infligés par des attaques non-magiques qui ne sont pas en adamantium');
        $manager->persist($nonAdamantineSlashing);

        // tranchants infligés par des attaques non-magiques qui ne sont pas en argent
        $nonSilverSlashing = new Immunity();
        $nonSilverSlashing->setName('tranchants infligés par des attaques non-magiques qui ne sont pas en argent');
        $manager->persist($nonSilverSlashing);

        // perforants, et tranchants infligés par des attaques non-magiques
        $nonMagicalPiercingAndSlashing = new Immunity();
        $nonMagicalPiercingAndSlashing->setName('perforants, et tranchants infligés par des attaques non-magiques');
        $manager->persist($nonMagicalPiercingAndSlashing);

        // perforants, et tranchants infligés par des armes qui ne sont pas en fer froid
        $nonColdIronPiercingAndSlashing = new Immunity();
        $nonColdIronPiercingAndSlashing->setName('perforants, et tranchants infligés par des armes qui ne sont pas en fer froid');
        $manager->persist($nonColdIronPiercingAndSlashing);

        // perforants, et tranchants infligés par des attaques non-magiques qui ne sont pas en adamantium
        $nonAdamantinePiercingAndSlashing = new Immunity();
        $nonAdamantinePiercingAndSlashing->setName('perforants, et tranchants infligés par des attaques non-magiques qui ne sont pas en adamantium');
        $manager->persist($nonAdamantinePiercingAndSlashing);

        // perforants, et tranchants infligés par des attaques non-magiques qui ne sont pas en argent
        $nonSilverPiercingAndSlashing = new Immunity();
        $nonSilverPiercingAndSlashing->setName('perforants, et tranchants infligés par des attaques non-magiques qui ne sont pas en argent');
        $manager->persist($nonSilverPiercingAndSlashing);

        // contondants et tranchants infligés par des attaques non-magiques
        $nonMagicalBludgeoningAndSlashing = new Immunity();
        $nonMagicalBludgeoningAndSlashing->setName('contondants et tranchants infligés par des attaques non-magiques');
        $manager->persist($nonMagicalBludgeoningAndSlashing);

        // contondants et tranchants infligés par des armes qui ne sont pas en fer froid
        $nonColdIronBludgeoningAndSlashing = new Immunity();
        $nonColdIronBludgeoningAndSlashing->setName('contondants et tranchants infligés par des armes qui ne sont pas en fer froid');
        $manager->persist($nonColdIronBludgeoningAndSlashing);

        // contondants et tranchants infligés par des attaques non-magiques qui ne sont pas en adamantium
        $nonAdamantineBludgeoningAndSlashing = new Immunity();
        $nonAdamantineBludgeoningAndSlashing->setName('contondants et tranchants infligés par des attaques non-magiques qui ne sont pas en adamantium');
        $manager->persist($nonAdamantineBludgeoningAndSlashing);

        // contondants et tranchants infligés par des attaques non-magiques qui ne sont pas en argent
        $nonSilverBludgeoningAndSlashing = new Immunity();
        $nonSilverBludgeoningAndSlashing->setName('contondants et tranchants infligés par des attaques non-magiques qui ne sont pas en argent');
        $manager->persist($nonSilverBludgeoningAndSlashing);

        // contondants et perforants infligés par des attaques non-magiques
        $nonMagicalBludgeoningAndPiercing = new Immunity();
        $nonMagicalBludgeoningAndPiercing->setName('contondants et perforants infligés par des attaques non-magiques');
        $manager->persist($nonMagicalBludgeoningAndPiercing);

        // contondants et perforants infligés par des armes qui ne sont pas en fer froid
        $nonColdIronBludgeoningAndPiercing = new Immunity();
        $nonColdIronBludgeoningAndPiercing->setName('contondants et perforants infligés par des armes qui ne sont pas en fer froid');
        $manager->persist($nonColdIronBludgeoningAndPiercing);

        // contondants et perforants infligés par des attaques non-magiques qui ne sont pas en adamantium
        $nonAdamantineBludgeoningAndPiercing = new Immunity();
        $nonAdamantineBludgeoningAndPiercing->setName('contondants et perforants infligés par des attaques non-magiques qui ne sont pas en adamantium');
        $manager->persist($nonAdamantineBludgeoningAndPiercing);

        // contondants et perforants infligés par des attaques non-magiques qui ne sont pas en argent
        $nonSilverBludgeoningAndPiercing = new Immunity();
        $nonSilverBludgeoningAndPiercing->setName('contondants et perforants infligés par des attaques non-magiques qui ne sont pas en argent');
        $manager->persist($nonSilverBludgeoningAndPiercing);

        // contondants, perforants et tranchants infligés par des attaques non-magiques
        $nonMagicalBludgeoningAndPiercingAndSlashing = new Immunity();
        $nonMagicalBludgeoningAndPiercingAndSlashing->setName('contondants, perforants et tranchants infligés par des attaques non-magiques');
        $manager->persist($nonMagicalBludgeoningAndPiercingAndSlashing);

        // contondants, perforants et tranchants infligés par des armes qui ne sont pas en fer froid
        $nonColdIronBludgeoningAndPiercingAndSlashing = new Immunity();
        $nonColdIronBludgeoningAndPiercingAndSlashing->setName('contondants, perforants et tranchants infligés par des armes qui ne sont pas en fer froid');
        $manager->persist($nonColdIronBludgeoningAndPiercingAndSlashing);

        // contondants, perforants et tranchants infligés par des attaques non-magiques qui ne sont pas en adamantium
        $nonAdamantineBludgeoningAndPiercingAndSlashing = new Immunity();
        $nonAdamantineBludgeoningAndPiercingAndSlashing->setName('contondants, perforants et tranchants infligés par des attaques non-magiques qui ne sont pas en adamantium');
        $manager->persist($nonAdamantineBludgeoningAndPiercingAndSlashing);

        // contondants, perforants et tranchants infligés par des attaques non-magiques qui ne sont pas en argent
        $nonSilverBludgeoningAndPiercingAndSlashing = new Immunity();
        $nonSilverBludgeoningAndPiercingAndSlashing->setName('contondants, perforants et tranchants infligés par des attaques non-magiques qui ne sont pas en argent');
        $manager->persist($nonSilverBludgeoningAndPiercingAndSlashing);

        $manager->flush();
    }
}