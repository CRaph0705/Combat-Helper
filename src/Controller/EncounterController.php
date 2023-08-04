<?php

namespace App\Controller;

use App\Entity\Encounter;
use App\Form\EncounterType;
use App\Repository\EncounterRepository;
use App\Repository\MonsterRepository;
use App\Repository\PlayerCharacterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/encounter')]
class EncounterController extends AbstractController
{
    #[Route('/', name: 'app_encounter_index', methods: ['GET'])]
    public function index(EncounterRepository $encounterRepository): Response
    {
        return $this->render('encounter/index.html.twig', [
            'encounters' => $encounterRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_encounter_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EncounterRepository $encounterRepository): Response
    {
        $encounter = new Encounter();
        $form = $this->createForm(EncounterType::class, $encounter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $encounterRepository->save($encounter, true);

            return $this->redirectToRoute('app_encounter_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('encounter/new.html.twig', [
            'encounter' => $encounter,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_encounter_show', methods: ['GET'])]
    public function show(Encounter $encounter): Response
    {
        $monsters = $encounter->getMonsters()->toArray();
        $players = $encounter->getPlayers()->toArray();
        $units = array_merge($monsters, $players);
        return $this->render('encounter/show.html.twig', [
            'encounter' => $encounter,
            'monsters' => $monsters,
            'players' => $players,
            'units' => $units,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_encounter_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Encounter $encounter, EncounterRepository $encounterRepository): Response
    {
        $form = $this->createForm(EncounterType::class, $encounter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $encounterRepository->save($encounter, true);

            return $this->redirectToRoute('app_encounter_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('encounter/edit.html.twig', [
            'encounter' => $encounter,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_encounter_delete', methods: ['POST'])]
    public function delete(Request $request, Encounter $encounter, EncounterRepository $encounterRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$encounter->getId(), $request->request->get('_token'))) {
            $encounterRepository->remove($encounter, true);
        }

        return $this->redirectToRoute('app_encounter_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/init/{id}', name: 'app_encounter_init', methods: ['GET'])]
    public function init(Encounter $encounter, EncounterRepository $encounterRepository): Response
    {
        //si l'encounter n'a pas d'units, on empêche l'init
        if (count($encounter->getMonsters()) == 0 && count($encounter->getPlayers()) == 0) {
            $this->addFlash('danger', 'L\'encounter n\'a pas d\'unités');
            return $this->redirectToRoute('app_encounter_show', ['id' => $encounter->getId()]);
        } else {
            //on récupère les monstres et les joueurs
            $monsters = $encounter->getMonsters()->toArray();
            $players = $encounter->getPlayers()->toArray();
            //on les fusionne
            $units = array_merge($monsters, $players);
            //on les ajoute à l'encounter
            $encounter->setUnits($units);
            // on les trie dynamiquement par initiative
            usort($units, function ($a, $b) {
                return $b->getInitiative() <=> $a->getInitiative();
            });

            //on initialise le compteur de tours
            // $encounter->setTurn(1);
            //on initialise le compteur d'initiative
            // $encounter->setInitiative(0);
            //on sauvegarde
            $encounterRepository->save($encounter, true);
            //on redirige vers la page de l'encounter
            return $this->render('encounter/init.html.twig', [
                'controller_name' => 'EncounterController',
                'encounter' => $encounter,
                'units' => $units,
                'monsters' => $monsters,
                'players' => $players,
            ]);
        }
    }
}
