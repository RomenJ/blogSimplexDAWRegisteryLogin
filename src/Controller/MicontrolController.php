<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MicontrolController extends AbstractController
{
    #[Route('/micontrol', name: 'app_micontrol')]
    public function index(): Response
    {
        return $this->render('micontrol/index.html.twig', [
            'controller_name' => 'MicontrolController',
        ]);
    }
}
