<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EncounterController extends AbstractController
{
    #[Route('/encounter', name: 'app_encounter')]
    public function index(): Response
    {
        return $this->render('encounter/init.html.twig', [
            'controller_name' => 'EncounterController',
        ]);
    }

    #[Route('/encounter/new', name: 'app_encounter_new')]
    public function new(): Response
    {
        return $this->render('encounter/new.html.twig', [
            'controller_name' => 'EncounterController',
        ]);
    }
    // 
    // add new character or monster
    // load single character or monster
    // load list of characters or monsters (ajouter à la liste)
    // start encounter only if initiative is set and monsters and characters are added (message if not correctly set)
    // end encounter
    // reset encounter
}
