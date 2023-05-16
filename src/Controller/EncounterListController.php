<?php

namespace App\Controller;

use App\Entity\EncounterList;
use App\Form\EncounterListType;
use App\Repository\EncounterListRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/encounter/list')]
class EncounterListController extends AbstractController
{
    #[Route('/', name: 'app_encounter_list_index', methods: ['GET'])]
    public function index(EncounterListRepository $encounterListRepository): Response
    {
        return $this->render('encounter_list/index.html.twig', [
            'encounter_lists' => $encounterListRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_encounter_list_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EncounterListRepository $encounterListRepository): Response
    {
        $encounterList = new EncounterList();
        $form = $this->createForm(EncounterListType::class, $encounterList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $encounterListRepository->save($encounterList, true);

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
        return $this->render('encounter_list/show.html.twig', [
            'encounter_list' => $encounterList,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_encounter_list_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EncounterList $encounterList, EncounterListRepository $encounterListRepository): Response
    {
        $form = $this->createForm(EncounterListType::class, $encounterList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $encounterListRepository->save($encounterList, true);

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
}
