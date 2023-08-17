<?php

namespace App\Controller;

use App\Entity\Encounter;
use App\Form\EncounterType;
use App\Repository\EncounterRepository;
use App\Repository\MonsterRepository;
use Doctrine\ORM\Mapping\Id;
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


    ############################################################################################################

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

            return $this->redirectToRoute('app_encounter_show', ['id' => $encounter->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('encounter/new.html.twig', [
            'encounter' => $encounter,
            'form' => $form,
            'current_encounter' => $encounter,
            'shortName' => $shortName,
        ]);
    }


    ############################################################################################################

    #[Route('/{id}', name: 'app_encounter_show', methods: ['GET'])]
    public function show(Encounter $encounter): Response
    {
        $playerEncounter=$encounter->getEncounterPlayerCharacters();
        $players=[];
        foreach($playerEncounter as $encounterPlayer) {
            $players[]=$encounterPlayer->getPlayerCharacter();
        }

        $encounterMonsters=$encounter->getEncounterMonsters();
        $monstersArray=[
            'monsters' => [],
            'quantities' => [],
        ];
        foreach($encounterMonsters as $encounterMonster) {
            $monstersArray[
                'monsters'
            ][]=$encounterMonster->getMonster();
            $monstersArray[
                'quantities'
            ][]=$encounterMonster->getQuantity();
        }

        return $this->render('encounter/show.html.twig', [
            'encounter' => $encounter,
            'players' => $players,
            'monstersArray' => $monstersArray,
            'encounterMonsters' => $encounterMonsters,
        ]);
    }

    ############################################################################################################


    #[Route('/{id}/edit', name: 'app_encounter_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Encounter $encounter, EncounterRepository $encounterRepository, MonsterRepository $monsterRepository): Response
    {
        $form = $this->createForm(EncounterType::class, $encounter);
        $form->handleRequest($request);

        $encounterPlayerCharacters=$encounter->getEncounterPlayerCharacters();
        $players=[];
        foreach($encounterPlayerCharacters as $player) {
            $players[]=$player->getPlayerCharacter();
        }

        $encounterMonsters=$encounter->getEncounterMonsters();
        $monsters=[];
        foreach($encounterMonsters as $monster) {
            $monsters[]=$monster->getMonster();
        }


        if ($form->isSubmitted() && $form->isValid()) {
            // Save the encounter
            $encounterRepository->save($encounter, true);

            // Get the submitted form data
            $formData = $form->getData();
            // Loop through submitted monsters and update quantities
            foreach ($formData->getEncounterMonsters() as $encounterMonster) {
                $quantity = $encounterMonster->getQuantity();  // Nouvelle façon d'obtenir la quantité
                // Set the quantity to the EncounterMonster
                $encounterMonster->setQuantity($quantity);

            }

            //redirect to encounter show of this encounter
            return $this->redirectToRoute('app_encounter_show', ['id' => $encounter->getId()], Response::HTTP_SEE_OTHER);
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


    ############################################################################################################


    #[Route('/{id}', name: 'app_encounter_delete', methods: ['POST'])]
    public function delete(Request $request, Encounter $encounter, EncounterRepository $encounterRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$encounter->getId(), $request->request->get('_token'))) {
            $encounterRepository->remove($encounter, true);
        }

        return $this->redirectToRoute('app_encounter_index', [], Response::HTTP_SEE_OTHER);
    }


    ############################################################################################################

    //encounter init
    // after creating or editing an encounter, the DM can click on init to start the encounter
    // this will redirect to the encounter/init page
    // this page will display the encounter with the players and monsters
    // the DM can then click the monsters to roll initiative
    // the DM will have to enter the initiative of the players manually
    // the monsters and players will be sorted by initiative

    //then the DM can click on start encounter
    //no redirection, just js to hide the init button and display the next button and the stop button

    //the DM can then click on next to start the first round
    //the DM can click on stop to stop the encounter at any time
    // it will display the start button and hide the next button

    //if the DM clicks on start, the encounter will start again but not from the beginning
    //the DM can click on next to go to the next unit in the initiative order
    //the next unit will be highlighted

    //the DM can click on previous to go to the previous unit in the initiative order
    //the current unit will be highlighted


    //the DM can click on end to end the encounter
    //the DM can click on restart to restart the encounter

    //the DM can click on a monster to display its stats
    //the DM can click on a player to display its stats

    //the DM can modify the initiative of a player or monster by clicking on it and entering the new initiative
    //the DM can modify the HP of a player or monster by clicking on it and entering the new HP
    //the DM can modify the AC of a player or monster by clicking on it and entering the new AC


    //encounter/init
    #[Route('/{id}/init', name: 'app_encounter_init', methods: ['GET', 'POST'])]
    public function init(Encounter $encounter): Response
    {
        $playerEncounter=$encounter->getEncounterPlayerCharacters();
        $players=[];
        foreach($playerEncounter as $encounterPlayer) {
            $players[]=$encounterPlayer->getPlayerCharacter();
        }
        $monsterEncounter=$encounter->getEncounterMonsters();
        $monsters=[];
        foreach($monsterEncounter as $encounterMonster) {
            $monsters[]=$encounterMonster->getMonster();
        }
        $units=array_merge($players, $monsters);

        return $this->render('encounter/init.html.twig', [
            'encounter' => $encounter,
            'players' => $players,
            'monsters' => $monsters,
            'units' => $units,
        ]);
    }

    ############################################################################################################

}
