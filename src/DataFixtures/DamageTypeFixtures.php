<?php

namespace App\DataFixtures;

use App\Entity\DamageType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DamageTypeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $acid = new DamageType();
        $acid->setName('d\'acide');
        $manager->persist($acid);

        $bludgeoning = new DamageType();
        $bludgeoning->setName('contondants');
        $manager->persist($bludgeoning);

        $cold = new DamageType();
        $cold->setName('de froid');
        $manager->persist($cold);

        $fire = new DamageType();
        $fire->setName('de feu');
        $manager->persist($fire);

        $force = new DamageType();
        $force->setName('de force');
        $manager->persist($force);

        $lightning = new DamageType();
        $lightning->setName('de foudre');
        $manager->persist($lightning);

        $necrotic = new DamageType();
        $necrotic->setName('nécrotiques');
        $manager->persist($necrotic);

        $piercing = new DamageType();
        $piercing->setName('perforants');
        $manager->persist($piercing);

        $poison = new DamageType();
        $poison->setName('de poison');
        $manager->persist($poison);

        $psychic = new DamageType();
        $psychic->setName('psychiques');
        $manager->persist($psychic);

        $radiant = new DamageType();
        $radiant->setName('radiants');
        $manager->persist($radiant);

        $slashing = new DamageType();
        $slashing->setName('tranchants');
        $manager->persist($slashing);

        $thunder = new DamageType();
        $thunder->setName('de tonnerre');
        $manager->persist($thunder);

        //contondants infligés par des attaques non-magiques
        $nonMagicalBludgeoning = new DamageType();
        $nonMagicalBludgeoning->setName('contondants infligés par des attaques non-magiques');
        $manager->persist($nonMagicalBludgeoning);

        // contondants infligés par des armes qui ne sont pas en fer froid
        $nonColdIronBludgeoning = new DamageType();
        $nonColdIronBludgeoning->setName('contondants infligés par des armes qui ne sont pas en fer froid');
        $manager->persist($nonColdIronBludgeoning);

        // contondants infligés par des attaques non-magiques qui ne sont pas en adamantium
        $nonAdamantineBludgeoning = new DamageType();
        $nonAdamantineBludgeoning->setName('contondants infligés par des attaques non-magiques qui ne sont pas en adamantium');
        $manager->persist($nonAdamantineBludgeoning);


        // contondants infligés par des attaques non-magiques qui ne sont pas en argent
        $nonSilverBludgeoning = new DamageType();
        $nonSilverBludgeoning->setName('contondants infligés par des attaques non-magiques qui ne sont pas en argent');
        $manager->persist($nonSilverBludgeoning);

        //perforants infligés par des attaques non-magiques
        $nonMagicalPiercing = new DamageType();
        $nonMagicalPiercing->setName('perforants infligés par des attaques non-magiques');
        $manager->persist($nonMagicalPiercing);

        // perforants infligés par des armes qui ne sont pas en fer froid
        $nonColdIronPiercing = new DamageType();
        $nonColdIronPiercing->setName('perforants infligés par des armes qui ne sont pas en fer froid');
        $manager->persist($nonColdIronPiercing);

        // perforants infligés par des attaques non-magiques qui ne sont pas en adamantium
        $nonAdamantinePiercing = new DamageType();
        $nonAdamantinePiercing->setName('perforants infligés par des attaques non-magiques qui ne sont pas en adamantium');
        $manager->persist($nonAdamantinePiercing);

        // perforants infligés par des attaques non-magiques qui ne sont pas en argent
        $nonSilverPiercing = new DamageType();
        $nonSilverPiercing->setName('perforants infligés par des attaques non-magiques qui ne sont pas en argent');
        $manager->persist($nonSilverPiercing);

        // tranchants infligés par des attaques non-magiques
        $nonMagicalSlashing = new DamageType();
        $nonMagicalSlashing->setName('tranchants infligés par des attaques non-magiques');
        $manager->persist($nonMagicalSlashing);

        // tranchants infligés par des armes qui ne sont pas en fer froid
        $nonColdIronSlashing = new DamageType();
        $nonColdIronSlashing->setName('tranchants infligés par des armes qui ne sont pas en fer froid');
        $manager->persist($nonColdIronSlashing);

        // tranchants infligés par des attaques non-magiques qui ne sont pas en adamantium
        $nonAdamantineSlashing = new DamageType();
        $nonAdamantineSlashing->setName('tranchants infligés par des attaques non-magiques qui ne sont pas en adamantium');
        $manager->persist($nonAdamantineSlashing);

        // tranchants infligés par des attaques non-magiques qui ne sont pas en argent
        $nonSilverSlashing = new DamageType();
        $nonSilverSlashing->setName('tranchants infligés par des attaques non-magiques qui ne sont pas en argent');
        $manager->persist($nonSilverSlashing);

        // perforants, et tranchants infligés par des attaques non-magiques
        $nonMagicalPiercingAndSlashing = new DamageType();
        $nonMagicalPiercingAndSlashing->setName('perforants, et tranchants infligés par des attaques non-magiques');
        $manager->persist($nonMagicalPiercingAndSlashing);

        // perforants, et tranchants infligés par des armes qui ne sont pas en fer froid
        $nonColdIronPiercingAndSlashing = new DamageType();
        $nonColdIronPiercingAndSlashing->setName('perforants, et tranchants infligés par des armes qui ne sont pas en fer froid');
        $manager->persist($nonColdIronPiercingAndSlashing);

        // perforants, et tranchants infligés par des attaques non-magiques qui ne sont pas en adamantium
        $nonAdamantinePiercingAndSlashing = new DamageType();
        $nonAdamantinePiercingAndSlashing->setName('perforants, et tranchants infligés par des attaques non-magiques qui ne sont pas en adamantium');
        $manager->persist($nonAdamantinePiercingAndSlashing);

        // perforants, et tranchants infligés par des attaques non-magiques qui ne sont pas en argent
        $nonSilverPiercingAndSlashing = new DamageType();
        $nonSilverPiercingAndSlashing->setName('perforants, et tranchants infligés par des attaques non-magiques qui ne sont pas en argent');
        $manager->persist($nonSilverPiercingAndSlashing);

        // contondants et tranchants infligés par des attaques non-magiques
        $nonMagicalBludgeoningAndSlashing = new DamageType();
        $nonMagicalBludgeoningAndSlashing->setName('contondants et tranchants infligés par des attaques non-magiques');
        $manager->persist($nonMagicalBludgeoningAndSlashing);

        // contondants et tranchants infligés par des armes qui ne sont pas en fer froid
        $nonColdIronBludgeoningAndSlashing = new DamageType();
        $nonColdIronBludgeoningAndSlashing->setName('contondants et tranchants infligés par des armes qui ne sont pas en fer froid');
        $manager->persist($nonColdIronBludgeoningAndSlashing);

        // contondants et tranchants infligés par des attaques non-magiques qui ne sont pas en adamantium
        $nonAdamantineBludgeoningAndSlashing = new DamageType();
        $nonAdamantineBludgeoningAndSlashing->setName('contondants et tranchants infligés par des attaques non-magiques qui ne sont pas en adamantium');
        $manager->persist($nonAdamantineBludgeoningAndSlashing);

        // contondants et tranchants infligés par des attaques non-magiques qui ne sont pas en argent
        $nonSilverBludgeoningAndSlashing = new DamageType();
        $nonSilverBludgeoningAndSlashing->setName('contondants et tranchants infligés par des attaques non-magiques qui ne sont pas en argent');
        $manager->persist($nonSilverBludgeoningAndSlashing);

        // contondants et perforants infligés par des attaques non-magiques
        $nonMagicalBludgeoningAndPiercing = new DamageType();
        $nonMagicalBludgeoningAndPiercing->setName('contondants et perforants infligés par des attaques non-magiques');
        $manager->persist($nonMagicalBludgeoningAndPiercing);

        // contondants et perforants infligés par des armes qui ne sont pas en fer froid
        $nonColdIronBludgeoningAndPiercing = new DamageType();
        $nonColdIronBludgeoningAndPiercing->setName('contondants et perforants infligés par des armes qui ne sont pas en fer froid');
        $manager->persist($nonColdIronBludgeoningAndPiercing);

        // contondants et perforants infligés par des attaques non-magiques qui ne sont pas en adamantium
        $nonAdamantineBludgeoningAndPiercing = new DamageType();
        $nonAdamantineBludgeoningAndPiercing->setName('contondants et perforants infligés par des attaques non-magiques qui ne sont pas en adamantium');
        $manager->persist($nonAdamantineBludgeoningAndPiercing);

        // contondants et perforants infligés par des attaques non-magiques qui ne sont pas en argent
        $nonSilverBludgeoningAndPiercing = new DamageType();
        $nonSilverBludgeoningAndPiercing->setName('contondants et perforants infligés par des attaques non-magiques qui ne sont pas en argent');
        $manager->persist($nonSilverBludgeoningAndPiercing);

        // contondants, perforants et tranchants infligés par des attaques non-magiques
        $nonMagicalBludgeoningAndPiercingAndSlashing = new DamageType();
        $nonMagicalBludgeoningAndPiercingAndSlashing->setName('contondants, perforants et tranchants infligés par des attaques non-magiques');
        $manager->persist($nonMagicalBludgeoningAndPiercingAndSlashing);

        // contondants, perforants et tranchants infligés par des armes qui ne sont pas en fer froid
        $nonColdIronBludgeoningAndPiercingAndSlashing = new DamageType();
        $nonColdIronBludgeoningAndPiercingAndSlashing->setName('contondants, perforants et tranchants infligés par des armes qui ne sont pas en fer froid');
        $manager->persist($nonColdIronBludgeoningAndPiercingAndSlashing);

        // contondants, perforants et tranchants infligés par des attaques non-magiques qui ne sont pas en adamantium
        $nonAdamantineBludgeoningAndPiercingAndSlashing = new DamageType();
        $nonAdamantineBludgeoningAndPiercingAndSlashing->setName('contondants, perforants et tranchants infligés par des attaques non-magiques qui ne sont pas en adamantium');
        $manager->persist($nonAdamantineBludgeoningAndPiercingAndSlashing);

        // contondants, perforants et tranchants infligés par des attaques non-magiques qui ne sont pas en argent
        $nonSilverBludgeoningAndPiercingAndSlashing = new DamageType();
        $nonSilverBludgeoningAndPiercingAndSlashing->setName('contondants, perforants et tranchants infligés par des attaques non-magiques qui ne sont pas en argent');
        $manager->persist($nonSilverBludgeoningAndPiercingAndSlashing);

        $manager->flush();
    }
}