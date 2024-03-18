<?php

namespace App\Controller;

use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PropertyDetailsController extends AbstractController
{
    #[Route('/property/details/{slug}', name: 'app_property_details')]
    public function index(PropertyRepository $property): Response
    {
        return $this->render('property_details/property_details.html.twig', [
            'property' => $property,
			'breadcrumb_title' => 'Property Details',
        ]);
    }
}
