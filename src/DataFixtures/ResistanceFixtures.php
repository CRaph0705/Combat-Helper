<?php

namespace App\DataFixtures;

use App\Entity\Resistance;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ResistanceFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $acid = new Resistance();
        $acid->setName('d\'acide');
        $manager->persist($acid);

        $bludgeoning = new Resistance();
        $bludgeoning->setName('contondants');
        $manager->persist($bludgeoning);

        $cold = new Resistance();
        $cold->setName('de froid');
        $manager->persist($cold);

        $fire = new Resistance();
        $fire->setName('de feu');
        $manager->persist($fire);

        $force = new Resistance();
        $force->setName('de force');
        $manager->persist($force);

        $lightning = new Resistance();
        $lightning->setName('de foudre');
        $manager->persist($lightning);

        $necrotic = new Resistance();
        $necrotic->setName('nécrotiques');
        $manager->persist($necrotic);

        $piercing = new Resistance();
        $piercing->setName('perforants');
        $manager->persist($piercing);

        $poison = new Resistance();
        $poison->setName('de poison');
        $manager->persist($poison);

        $psychic = new Resistance();
        $psychic->setName('psychiques');
        $manager->persist($psychic);

        $radiant = new Resistance();
        $radiant->setName('radiants');
        $manager->persist($radiant);

        $slashing = new Resistance();
        $slashing->setName('tranchants');
        $manager->persist($slashing);

        $thunder = new Resistance();
        $thunder->setName('de tonnerre');
        $manager->persist($thunder);

        //contondants infligés par des attaques non-magiques
        $nonMagicalBludgeoning = new Resistance();
        $nonMagicalBludgeoning->setName('contondants infligés par des attaques non-magiques');
        $manager->persist($nonMagicalBludgeoning);

        // contondants infligés par des armes qui ne sont pas en fer froid
        $nonColdIronBludgeoning = new Resistance();
        $nonColdIronBludgeoning->setName('contondants infligés par des armes qui ne sont pas en fer froid');
        $manager->persist($nonColdIronBludgeoning);

        // contondants infligés par des attaques non-magiques qui ne sont pas en adamantium
        $nonAdamantineBludgeoning = new Resistance();
        $nonAdamantineBludgeoning->setName('contondants infligés par des attaques non-magiques qui ne sont pas en adamantium');
        $manager->persist($nonAdamantineBludgeoning);


        // contondants infligés par des attaques non-magiques qui ne sont pas en argent
        $nonSilverBludgeoning = new Resistance();
        $nonSilverBludgeoning->setName('contondants infligés par des attaques non-magiques qui ne sont pas en argent');
        $manager->persist($nonSilverBludgeoning);

        //perforants infligés par des attaques non-magiques
        $nonMagicalPiercing = new Resistance();
        $nonMagicalPiercing->setName('perforants infligés par des attaques non-magiques');
        $manager->persist($nonMagicalPiercing);

        // perforants infligés par des armes qui ne sont pas en fer froid
        $nonColdIronPiercing = new Resistance();
        $nonColdIronPiercing->setName('perforants infligés par des armes qui ne sont pas en fer froid');
        $manager->persist($nonColdIronPiercing);

        // perforants infligés par des attaques non-magiques qui ne sont pas en adamantium
        $nonAdamantinePiercing = new Resistance();
        $nonAdamantinePiercing->setName('perforants infligés par des attaques non-magiques qui ne sont pas en adamantium');
        $manager->persist($nonAdamantinePiercing);

        // perforants infligés par des attaques non-magiques qui ne sont pas en argent
        $nonSilverPiercing = new Resistance();
        $nonSilverPiercing->setName('perforants infligés par des attaques non-magiques qui ne sont pas en argent');
        $manager->persist($nonSilverPiercing);

        // tranchants infligés par des attaques non-magiques
        $nonMagicalSlashing = new Resistance();
        $nonMagicalSlashing->setName('tranchants infligés par des attaques non-magiques');
        $manager->persist($nonMagicalSlashing);

        // tranchants infligés par des armes qui ne sont pas en fer froid
        $nonColdIronSlashing = new Resistance();
        $nonColdIronSlashing->setName('tranchants infligés par des armes qui ne sont pas en fer froid');
        $manager->persist($nonColdIronSlashing);

        // tranchants infligés par des attaques non-magiques qui ne sont pas en adamantium
        $nonAdamantineSlashing = new Resistance();
        $nonAdamantineSlashing->setName('tranchants infligés par des attaques non-magiques qui ne sont pas en adamantium');
        $manager->persist($nonAdamantineSlashing);

        // tranchants infligés par des attaques non-magiques qui ne sont pas en argent
        $nonSilverSlashing = new Resistance();
        $nonSilverSlashing->setName('tranchants infligés par des attaques non-magiques qui ne sont pas en argent');
        $manager->persist($nonSilverSlashing);

        // perforants, et tranchants infligés par des attaques non-magiques
        $nonMagicalPiercingAndSlashing = new Resistance();
        $nonMagicalPiercingAndSlashing->setName('perforants, et tranchants infligés par des attaques non-magiques');
        $manager->persist($nonMagicalPiercingAndSlashing);

        // perforants, et tranchants infligés par des armes qui ne sont pas en fer froid
        $nonColdIronPiercingAndSlashing = new Resistance();
        $nonColdIronPiercingAndSlashing->setName('perforants, et tranchants infligés par des armes qui ne sont pas en fer froid');
        $manager->persist($nonColdIronPiercingAndSlashing);

        // perforants, et tranchants infligés par des attaques non-magiques qui ne sont pas en adamantium
        $nonAdamantinePiercingAndSlashing = new Resistance();
        $nonAdamantinePiercingAndSlashing->setName('perforants, et tranchants infligés par des attaques non-magiques qui ne sont pas en adamantium');
        $manager->persist($nonAdamantinePiercingAndSlashing);

        // perforants, et tranchants infligés par des attaques non-magiques qui ne sont pas en argent
        $nonSilverPiercingAndSlashing = new Resistance();
        $nonSilverPiercingAndSlashing->setName('perforants, et tranchants infligés par des attaques non-magiques qui ne sont pas en argent');
        $manager->persist($nonSilverPiercingAndSlashing);

        // contondants et tranchants infligés par des attaques non-magiques
        $nonMagicalBludgeoningAndSlashing = new Resistance();
        $nonMagicalBludgeoningAndSlashing->setName('contondants et tranchants infligés par des attaques non-magiques');
        $manager->persist($nonMagicalBludgeoningAndSlashing);

        // contondants et tranchants infligés par des armes qui ne sont pas en fer froid
        $nonColdIronBludgeoningAndSlashing = new Resistance();
        $nonColdIronBludgeoningAndSlashing->setName('contondants et tranchants infligés par des armes qui ne sont pas en fer froid');
        $manager->persist($nonColdIronBludgeoningAndSlashing);

        // contondants et tranchants infligés par des attaques non-magiques qui ne sont pas en adamantium
        $nonAdamantineBludgeoningAndSlashing = new Resistance();
        $nonAdamantineBludgeoningAndSlashing->setName('contondants et tranchants infligés par des attaques non-magiques qui ne sont pas en adamantium');
        $manager->persist($nonAdamantineBludgeoningAndSlashing);

        // contondants et tranchants infligés par des attaques non-magiques qui ne sont pas en argent
        $nonSilverBludgeoningAndSlashing = new Resistance();
        $nonSilverBludgeoningAndSlashing->setName('contondants et tranchants infligés par des attaques non-magiques qui ne sont pas en argent');
        $manager->persist($nonSilverBludgeoningAndSlashing);

        // contondants et perforants infligés par des attaques non-magiques
        $nonMagicalBludgeoningAndPiercing = new Resistance();
        $nonMagicalBludgeoningAndPiercing->setName('contondants et perforants infligés par des attaques non-magiques');
        $manager->persist($nonMagicalBludgeoningAndPiercing);

        // contondants et perforants infligés par des armes qui ne sont pas en fer froid
        $nonColdIronBludgeoningAndPiercing = new Resistance();
        $nonColdIronBludgeoningAndPiercing->setName('contondants et perforants infligés par des armes qui ne sont pas en fer froid');
        $manager->persist($nonColdIronBludgeoningAndPiercing);

        // contondants et perforants infligés par des attaques non-magiques qui ne sont pas en adamantium
        $nonAdamantineBludgeoningAndPiercing = new Resistance();
        $nonAdamantineBludgeoningAndPiercing->setName('contondants et perforants infligés par des attaques non-magiques qui ne sont pas en adamantium');
        $manager->persist($nonAdamantineBludgeoningAndPiercing);

        // contondants et perforants infligés par des attaques non-magiques qui ne sont pas en argent
        $nonSilverBludgeoningAndPiercing = new Resistance();
        $nonSilverBludgeoningAndPiercing->setName('contondants et perforants infligés par des attaques non-magiques qui ne sont pas en argent');
        $manager->persist($nonSilverBludgeoningAndPiercing);

        // contondants, perforants et tranchants infligés par des attaques non-magiques
        $nonMagicalBludgeoningAndPiercingAndSlashing = new Resistance();
        $nonMagicalBludgeoningAndPiercingAndSlashing->setName('contondants, perforants et tranchants infligés par des attaques non-magiques');
        $manager->persist($nonMagicalBludgeoningAndPiercingAndSlashing);

        // contondants, perforants et tranchants infligés par des armes qui ne sont pas en fer froid
        $nonColdIronBludgeoningAndPiercingAndSlashing = new Resistance();
        $nonColdIronBludgeoningAndPiercingAndSlashing->setName('contondants, perforants et tranchants infligés par des armes qui ne sont pas en fer froid');
        $manager->persist($nonColdIronBludgeoningAndPiercingAndSlashing);

        // contondants, perforants et tranchants infligés par des attaques non-magiques qui ne sont pas en adamantium
        $nonAdamantineBludgeoningAndPiercingAndSlashing = new Resistance();
        $nonAdamantineBludgeoningAndPiercingAndSlashing->setName('contondants, perforants et tranchants infligés par des attaques non-magiques qui ne sont pas en adamantium');
        $manager->persist($nonAdamantineBludgeoningAndPiercingAndSlashing);

        // contondants, perforants et tranchants infligés par des attaques non-magiques qui ne sont pas en argent
        $nonSilverBludgeoningAndPiercingAndSlashing = new Resistance();
        $nonSilverBludgeoningAndPiercingAndSlashing->setName('contondants, perforants et tranchants infligés par des attaques non-magiques qui ne sont pas en argent');
        $manager->persist($nonSilverBludgeoningAndPiercingAndSlashing);

        $manager->flush();
    }
}