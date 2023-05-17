<?php

namespace App\Controller;

use App\Entity\EncounterList;
use App\Entity\PlayerCharacter;
use App\Form\EncounterListType;
use App\Repository\EncounterListRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/encounter/list')]
class EncounterListController extends AbstractController
{

    //construct
    public function __construct(
        private EntityManagerInterface $em
    ){}

    #[Route('/', name: 'app_encounter_list_index', methods: ['GET'])]
    public function index(EncounterListRepository $encounterListRepository): Response
    {
        return $this->render('encounter_list/index.html.twig', [
            'encounter_lists' => $encounterListRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_encounter_list_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EncounterListRepository $encounterListRepository, EntityManagerInterface $em): Response
    {
        $encounterList = new EncounterList();
        $form = $this->createForm(EncounterListType::class, $encounterList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $encounterListRepository->save($encounterList, true);

            foreach ($encounterList->getPlayerCharacters() as $playerCharacter) {
                $playerCharacter->addEncounterList($encounterList);
                $em->persist($playerCharacter);
            }
            $em->persist($encounterList);
            $em->flush();
            

            return $this->redirectToRoute('app_encounter_list_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('encounter_list/new.html.twig', [
            'encounter_list' => $encounterList,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_encounter_list_show', methods: ['GET'])]
    public function show(EncounterList $encounterList): Response
    {
        //get the list of monsters or player characters
        $playerCharacters = $encounterList->getPlayerCharacters();
        $monsters = $encounterList->getMonsters();
        return $this->render('encounter_list/show.html.twig', [
            'encounter_list' => $encounterList,
            'player_characters' => $playerCharacters,
            'listContent' => $encounterList->isIsPcList() ? $playerCharacters : $monsters,
            'listCategory' => $encounterList->isIsPcList() ? 'Players' : 'Monsters',
        ]);
    }

    #[Route('/{id}/edit', name: 'app_encounter_list_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EncounterList $encounterList, EncounterListRepository $encounterListRepository, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(EncounterListType::class, $encounterList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $encounterListRepository->save($encounterList, true);

            foreach ($encounterList->getPlayerCharacters() as $playerCharacter) {
                $playerCharacter->addEncounterList($encounterList);
                $em->persist($playerCharacter);
            }
            $em->persist($encounterList);
            $em->flush();
            return $this->redirectToRoute('app_encounter_list_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('encounter_list/edit.html.twig', [
            'encounter_list' => $encounterList,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_encounter_list_delete', methods: ['POST'])]
    public function delete(Request $request, EncounterList $encounterList, EncounterListRepository $encounterListRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$encounterList->getId(), $request->request->get('_token'))) {
            $encounterListRepository->remove($encounterList, true);
        }

        return $this->redirectToRoute('app_encounter_list_index', [], Response::HTTP_SEE_OTHER);
    }


    #[Route('/{id}/remove/{playerId}', name: 'app_encounter_list_remove', methods: ['GET', 'POST'])]
    public function removeEntityFromThisList(
        Request $request, 
        EncounterList $encounterList, 
        EncounterListRepository $encounterListRepository, 
        EntityManagerInterface $em,
        int $playerId
    ): Response
    {
        //on récupère l'entité à supprimer
        $playerCharacter = $em->getRepository(PlayerCharacter::class)->find($playerId);
        //on la supprime de la liste
        $encounterList->removePlayerCharacter($playerCharacter);
        //on la persiste
        $em->persist($encounterList);
        //on flush
        $em->flush();
        //on redirige vers la liste
        return $this->redirectToRoute('app_encounter_list_show', ['id' => $encounterList->getId()], Response::HTTP_SEE_OTHER);
    }
}
