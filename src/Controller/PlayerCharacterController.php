<?php

namespace App\Controller;

use App\Entity\PlayerCharacter;
use App\Form\PlayerCharacterType;
use App\Repository\PlayerCharacterRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/player-character')]
class PlayerCharacterController extends AbstractController
{

    public function __construct(
        private EntityManagerInterface $em
    ){}

    #[Route('/', name: 'app_player_character_index', methods: ['GET'])]
    public function index(PlayerCharacterRepository $playerCharacterRepository): Response
    {
        return $this->render('player_character/index.html.twig', [
            'player_characters' => $playerCharacterRepository->findAll(),
        ]);
    }

    // #[Route('/new', name: 'app_player_character_new', methods: ['GET', 'POST'])]
    // public function new(Request $request, PlayerCharacterRepository $playerCharacterRepository): Response
    // {
    //     $playerCharacter = new PlayerCharacter();

    //     $form = $this->createForm(PlayerCharacterType::class, $playerCharacter);
    //     $form->handleRequest($request);

        



    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $playerCharacterRepository->save($playerCharacter, true);

    //         return $this->redirectToRoute('app_player_character_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->renderForm('player_character/new.html.twig', [
    //         'player_character' => $playerCharacter,
    //         'form' => $form,
    //     ]);
    // }

    #[Route('/new', name: 'app_player_character_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PlayerCharacterRepository $playerCharacterRepository): Response
    {
        $playerCharacter = new PlayerCharacter();

        $form = $this->createForm(PlayerCharacterType::class, $playerCharacter);
        $form->remove('conditions');
        $form->remove('encounterLists');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $playerCharacterRepository->save($playerCharacter, true);

            return $this->redirectToRoute('app_player_character_index', [], Response::HTTP_SEE_OTHER);
        }


        return $this->renderForm('player_character/new.html.twig', [
            'player_character' => $playerCharacter,
            'form' => $form,
        ]);
    }


    #[Route('/{id}', name: 'app_player_character_show', methods: ['GET'])]
    public function show(PlayerCharacter $playerCharacter): Response
    {
        return $this->render('player_character/show.html.twig', [
            'player_character' => $playerCharacter,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_player_character_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PlayerCharacter $playerCharacter, PlayerCharacterRepository $playerCharacterRepository): Response
    {
        $form = $this->createForm(PlayerCharacterType::class, $playerCharacter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $playerCharacterRepository->save($playerCharacter, true);

            return $this->redirectToRoute('app_player_character_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('player_character/edit.html.twig', [
            'player_character' => $playerCharacter,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_player_character_delete', methods: ['POST'])]
    public function delete(Request $request, PlayerCharacter $playerCharacter, PlayerCharacterRepository $playerCharacterRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$playerCharacter->getId(), $request->request->get('_token'))) {
            $playerCharacterRepository->remove($playerCharacter, true);
        }

        return $this->redirectToRoute('app_player_character_index', [], Response::HTTP_SEE_OTHER);
    }


//save route :
#[Route('/save', name: 'app_player_character_save', methods: ['POST'])]
//save function :
    public function save(
        PlayerCharacter $playerCharacter,
        bool $flush = false,
    ){
        $this->em->persist($playerCharacter);
        if ($flush) {
            $this->em->flush();
        }
    }
//load route :
#[Route('/load', name: 'app_player_character_load', methods: ['GET'])]
//load function :
    public function load(
        int $id
    ){
        return $this->em->getRepository(PlayerCharacter::class)->find($id);
    }
}
