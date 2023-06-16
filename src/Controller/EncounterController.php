<?php

namespace App\Controller;

use App\Entity\Encounter;
use App\Repository\EncounterListRepository;
use App\Repository\MonsterRepository;
use App\Repository\PlayerCharacterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EncounterController extends AbstractController
{
    #[Route('/encounter', name: 'app_encounter')]
    public function index(PlayerCharacterRepository $playerCharacterRepository, MonsterRepository $monsterRepository, EncounterListRepository $encounterListRepository): Response
    {
        //d'abord on créé une instance de encounter
        $encounter = new Encounter();
        // on récupère les personnages et les monstres de l'encounter
        $characters = $encounter->getPlayers();
        $monsters = $encounter->getMonsters();
        // on les convertit en tableau
        $characters = $characters->toArray();
        $monsters = $monsters->toArray();
        // on les met dans un tableau
        $units = array_merge($characters, $monsters);

        // on trie les unités par initiative
        $encounter->sortUnitsByInitiative($units);

        return $this->render('encounter/init.html.twig', [
            'controller_name' => 'EncounterController',
            'characters' => $characters,
            'monsters' => $monsters,
            'units' => $units,
        ]);
    }

        // start encounter only if initiative is set and monsters and characters are added (message if not correctly set)
        // end encounter
        // reset encounter









    // add new unit > character or monster
    // load single unit > character or monster
    // load saved list (options : load and add, load and replace, load and merge)
    // clear list
    // save as new list

    // roll initiative for all monsters
    // roll initiative for all characters
    // order by initiative

}
