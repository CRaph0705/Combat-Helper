<?php

namespace App\Controller;

use App\Entity\Encounter;
use App\Entity\Monster;
use App\Repository\EncounterListRepository;
use App\Repository\MonsterRepository;
use App\Repository\PlayerCharacterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EncounterController extends AbstractController
{
    #[Route('/encounter', name: 'app_encounter')]
    public function index(PlayerCharacterRepository $playerCharacterRepository, MonsterRepository $monsterRepository, EncounterListRepository $encounterListRepository): Response
    {
        $encounter = new Encounter();
        $round = $encounter->getRound();
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
            'round' => $round,
        ]);
    }


        public function loadMonsters(Request $request, MonsterRepository $monsterRepository)
    {
        // Logique pour charger les entités Monster depuis la base de données
        $monsters = $monsterRepository->findAll();

        // Renvoyer les entités chargées à la vue pour les afficher
        return $this->render('encounter/load_unit.html.twig', [
            'units' => $monsters,
        ]);
    }

    public function loadPlayers(Request $request, PlayerCharacterRepository $playerCharacterRepository)
    {
        // Logique pour charger les entités Player depuis la base de données
        $players = $playerCharacterRepository->findAll();

        // Renvoyer les entités chargées à la vue pour les afficher
        return $this->render('encounter/load_unit.html.twig', [
            'units' => $players,
        ]);
    }


}
