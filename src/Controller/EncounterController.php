<?php

namespace App\Controller;

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
        $characters = $playerCharacterRepository->findAll();
        $monsters = $monsterRepository->findAll();
        $encounterLists = $encounterListRepository->findAll();

        $units = array_merge($characters, $monsters);
        // on trie les unités par initiative
        usort($units, function ($a, $b) {
            return $b->getInitiative() <=> $a->getInitiative();
        });

        return $this->render('encounter/init.html.twig', [
            'controller_name' => 'EncounterController',
            'characters' => $characters,
            'monsters' => $monsters,
            'encounterLists' => $encounterLists,
            'units' => $units,
        ]);
    }

    // 
    // add new unit > character or monster
    // load single unit > character or monster
    // load saved list (options : load and add, load and replace, load and merge)
    // start encounter only if initiative is set and monsters and characters are added (message if not correctly set)
    // end encounter
    // reset encounter
}
