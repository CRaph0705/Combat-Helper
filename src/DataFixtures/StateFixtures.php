<?php

namespace App\DataFixtures;

use App\Entity\State;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StateFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // à terre
        $prone = new State();
        $prone->setName('à terre');
        $prone->setDescription("
        La seule option de mouvement possible pour une créature à terre est de ramper, à moins qu'elle ne se relève et mette alors un terme à son état. 
        La créature a un désavantage aux jets d'attaque. 
        Un jet d'attaque contre la créature a un avantage si l'attaquant est à 1,50 mètre ou moins de la créature. Sinon, le jet d'attaque a un désavantage.
        ");
        $manager->persist($prone);

        // agrippé
        $grappled = new State();
        $grappled->setName('agrippé');
        $grappled->setDescription("
        La vitesse d'une créature agrippée passe à 0, et elle ne peut bénéficier d'aucun bonus à sa vitesse.
        L'état prend fin si la créature qui agrippe est incapable d'agir (voir l'état).
        L'état se termine également si un effet met la créature agrippée hors de portée de la créature ou de l'effet qui l'agrippe, comme par exemple lorsqu'une créature est projetée par le sort vague tonnante.
        ");
        $manager->persist($grappled);

        // assourdi
        $deafened = new State();
        $deafened->setName('assourdi');
        $deafened->setDescription("
        Une créature assourdie ne peut entendre et automatiquement échoue à tout jet de sauvegarde qui nécessite l'ouïe.
        ");
        $manager->persist($deafened);

        // aveuglé
        $blinded = new State();
        $blinded->setName('aveuglé');
        $blinded->setDescription("
        Une créature aveuglée ne voit pas et rate automatiquement tout jet de sauvegarde qui nécessite la vue.
        Les jets d'attaque contre la créature ont un avantage, et les jets d'attaque de la créature ont un désavantage.
        ");
        $manager->persist($blinded);

        // charmé
        $charmed = new State();
        $charmed->setName('charmé');
        $charmed->setDescription("
        Une créature charmée ne peut attaquer la créature qui l'a charmée ou cibler la créature avec des capacités ou des effets magiques nuisibles.
        Le charmeur a un avantage à ses jets de caractéristique pour interagir socialement avec la créature.
        ");
        $manager->persist($charmed);

         // effrayé
         $frightened = new State();
         $frightened->setName('effrayé');
         $frightened->setDescription("
        Une créature effrayée a un désavantage aux jets de caractéristique et aux jets d'attaque tant que la source de sa peur est dans sa ligne de vue.
        La créature ne peut se rapprocher volontairement de la source de sa peur.
        ");
         $manager->persist($frightened);

        // empoisonné
        $poisoned = new State();
        $poisoned->setName('empoisonné');
        $poisoned->setDescription("
        Une créature empoisonnée a un désavantage à ses jets de caractéristique et à ses jets d'attaque.
        ");
        $manager->persist($poisoned);
       
        // entravé
        $restrained = new State();
        $restrained->setName('entravé');
        $restrained->setDescription("
        La vitesse d'une créature entravée passe à 0, et elle ne peut bénéficier d'aucun bonus à sa vitesse.
        Les jets d'attaque contre la créature ont un avantage, et les jets d'attaque de la créature ont un désavantage.
        La créature a un désavantage aux jets de sauvegarde de Dextérité.
        ");
        $manager->persist($restrained);

        // étourdi
        $stunned = new State();
        $stunned->setName('étourdi');
        $stunned->setDescription("
        Une créature étourdie est incapable d'agir (voir l'état), ne peut plus bouger et parle de manière hésitante.
        La créature rate automatiquement ses jets de sauvegarde de Force et de Dextérité.
        Les jets d'attaque contre la créature ont un avantage.
        ");
        $manager->persist($stunned);

        // Incapable d'agir / Neutralisé [Incapacitated]
        $incapacitated = new State();
        $incapacitated->setName('neutralisé');
        $incapacitated->setDescription("
        Une créature neutralisée ne peut pas effectuer d'actions ou de réactions.
        ");
        $manager->persist($incapacitated);

        // inconscient
        $unconscious = new State();
        $unconscious->setName('inconscient');
        $unconscious->setDescription("
        Une créature inconsciente est incapable d'agir (voir l'état), ne peut plus bouger ni parler, et n'est plus consciente de ce qui se passe autour d'elle.
        La créature lâche ce qu'elle tenait et tombe à terre.
        La créature rate automatiquement ses jets de sauvegarde de Force et de Dextérité.
        Les jets d'attaque contre la créature ont un avantage.
        Toute attaque qui touche la créature est un coup critique si l'attaquant est à 1,50 mètre ou moins de la créature.
        ");
        $manager->persist($unconscious);

        // invisible
        $invisible = new State();
        $invisible->setName('invisible');
        $invisible->setDescription("
        Une créature invisible ne peut être vue sans l'aide de la magie ou un sens particulier. En ce qui concerne le fait de se cacher, la créature est considérée dans une zone à visibilité nulle. L'emplacement de la créature peut être détecté par un bruit qu'elle fait ou par les traces qu'elle laisse.
        Les jets d'attaque contre la créature ont un désavantage, et les jets d'attaque de la créature ont un avantage.
        ");
        $manager->persist($invisible);

   
        // paralysé
        $paralyzed = new State();
        $paralyzed->setName('paralysé');
        $paralyzed->setDescription("
        Une créature paralysée est incapable d'agir (voir l'état) et ne peut plus bouger ni parler.
        La créature rate automatiquement ses jets de sauvegarde de Force et de Dextérité.
        Les jets d'attaque contre la créature ont un avantage.
        Toute attaque qui touche la créature est un coup critique si l'attaquant est à 1,50 mètre ou moins de la créature.
        ");
        $manager->persist($paralyzed);

        // pétrifié
        $petrified = new State();
        $petrified->setName('pétrifié');
        $petrified->setDescription("
        Une créature pétrifiée est transformée, ainsi que tout objet non magique qu'elle porte, en une substance inanimée solide (généralement en pierre). Son poids est multiplié par dix et son vieillissement cesse.
        La créature est incapable d'agir (voir l'état), ne peut plus bouger ni parler, et n'est plus consciente de ce qui se passe autour d'elle.
        Les jets d'attaque contre la créature ont un avantage.
        La créature rate automatiquement ses jets de sauvegarde de Force et de Dextérité.
        La créature obtient la résistance contre tous les types de dégâts.
        La créature est immunisée contre le poison et la maladie, mais un poison ou une maladie déjà dans son organisme est seulement suspendu, pas neutralisé.
        ");
        $manager->persist($petrified);

       

        $manager->flush();
    }
}