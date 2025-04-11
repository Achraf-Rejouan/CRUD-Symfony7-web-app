<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    //Old way of defining routes
    // #[Route('/', name: 'homepage')]
    // public function home(): Response
    // {
    //     return new Response('<h1>Ma première page Symfony</h1>');
    // }

    // New way of defining routes using annotations
    #[Route('/acceuil', name: 'homepage1')]
    public function home1(): Response
    {
        return $this->render('index.html.twig');
    }

    #[Route('/acceuil/{name}', name: 'homepage2')]
    public function home2($name): Response
    {
        return $this->render('index1.html.twig', [
            'prenom' => $name
        ]);
    }
}
