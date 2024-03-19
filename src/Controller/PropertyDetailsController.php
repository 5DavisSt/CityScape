<?php

namespace App\Controller;

use App\Entity\Property;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PropertyDetailsController extends AbstractController
{
    #[Route('/property/details/{propSlug}', name: 'app_property_details')]
    public function index(Property $property): Response
    {
        return $this->render('property_details/property_details.html.twig', [
            'property' => $property,
			'breadcrumb_title' => 'Property Details',
        ]);
    }
}
