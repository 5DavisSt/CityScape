<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PropertyDetailsController extends AbstractController
{
    #[Route('/property-details', name: 'app_property_details')]
    public function index(): Response
    {
        return $this->render('property_details/property_details.html.twig', [
            'controller_name' => 'PropertyDetailsController',
			'breadcrumb_title' => 'Property Details',
        ]);
    }
}
