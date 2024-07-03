<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\MonstersApiCall;

class HelloController extends AbstractController
{
    public function __construct(private MonstersApiCall $monstersApiCall)
    {
    }

    #[Route('/', name: 'app_hello')]
    public function index(): Response
    {
        return $this->render('hello/index.html.twig', [
            'controller_name' => 'HelloController',
        ]);
    }

    #[Route('/hello', name: 'app_hello_hello')]
    public function hello(): Response
    {
        $jsonResponse = $this->monstersApiCall->getAllMonsters();
        dd($jsonResponse);
        return new Response(json_encode($jsonResponse));
    }
}
