<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class User2logController extends AbstractController
{
    #[Route('/user2log', name: 'app_user2log')]
    public function index(): Response
    {
        return $this->render('user2log/index.html.twig', [
            'controller_name' => 'User2logController',
        ]);
    }
}
