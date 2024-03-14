<?php

namespace App\Controller\Back;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DashboardController extends AbstractController
{
    #[Route('/back/dashboard', name: 'app_dashboard')]
	#[IsGranted('ROLE_USER', message: 'Vous devez vous connecter pour accéder à cette page.', statusCode: 404, exceptionCode: '404')]
    
	public function index(): Response
    {
        return $this->render('back/dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }
}
