<?php

namespace App\Controller;

use App\Entity\Encounter;
use App\Form\EncounterType;
use App\Repository\EncounterRepository;
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

        //new name = date + hash of random bytes and check if unique in db
        $newname = date('Y-m-d H:i', time() + 7200) .'-'. hash('sha256', random_bytes(32));
        while ($encounterRepository->findOneBy(['name' => $newname])) {
            $newname = date('Y-m-d H:i', time() + 7200) .'-'. hash('sha256', random_bytes(32));
        }
        $shortName = substr($newname, 0, 20). '...';

        $encounter->setName($newname);
        $encounter->setShortName($shortName);
        $form = $this->createForm(EncounterType::class, $encounter, [
            'current_encounter' => $encounter, // Pass the current encounter as an option
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $encounterRepository->save($encounter, true);

            return $this->redirectToRoute('app_encounter_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('encounter/new.html.twig', [
            'encounter' => $encounter,
            'form' => $form,
            'current_encounter' => $encounter,
            'shortName' => $shortName,
        ]);
    }

    #[Route('/{id}', name: 'app_encounter_show', methods: ['GET'])]
    public function show(Encounter $encounter): Response
    {
        $playerEncounter=$encounter->getEncounterPlayerCharacters();
        $players=[];
        foreach($playerEncounter as $player){
            $players[]=$player->getPlayerCharacter();
        }

        $monsterEncounter=$encounter->getEncounterMonsters();
        $monsters=[];
        foreach($monsterEncounter as $monster){
            $monsters[]=$monster->getMonster();
        }


        return $this->render('encounter/show.html.twig', [
            'encounter' => $encounter,
            'players' => $players,
            'monsters' => $monsters,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_encounter_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Encounter $encounter, EncounterRepository $encounterRepository): Response
    {
        $form = $this->createForm(EncounterType::class, $encounter);
        $form->handleRequest($request);

        $encounterPlayerCharacters=$encounter->getEncounterPlayerCharacters();
        $players=[];
        foreach($encounterPlayerCharacters as $player){
            $players[]=$player->getPlayerCharacter();
        }

        $encounterMonsters=$encounter->getEncounterMonsters();
        $monsters=[];
        foreach($encounterMonsters as $monster){
            $monsters[]=$monster->getMonster();
        }
        


        if ($form->isSubmitted() && $form->isValid()) {
            $encounterRepository->save($encounter, true);

            return $this->redirectToRoute('app_encounter_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('encounter/edit.html.twig', [
            'encounter' => $encounter,
            'encounterMonsters' => $encounterMonsters,
            'encounterPlayers' => $encounterPlayerCharacters,
            'form' => $form,
            'monsters' => $monsters,
            'players' => $players,
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
}
