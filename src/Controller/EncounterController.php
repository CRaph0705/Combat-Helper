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
        return $this->render('encounter/index.html.twig', [
            'controller_name' => 'EncounterController',
        ]);
    }
}
