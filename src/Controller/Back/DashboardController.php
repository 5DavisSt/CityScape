<?php

namespace App\Controller\Back;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class DashboardController extends AbstractController
{
    #[Route('/back/dashboard', name: 'app_dashboard')]
	#[IsGranted('ROLE_USER', message: 'You need to log in to access this page.', statusCode: 404, exceptionCode: '404')]
	public function index(): Response
    {
        return $this->render('back/dashboard/dashboard.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }
}
