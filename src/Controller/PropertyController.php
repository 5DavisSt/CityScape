<?php

namespace App\Controller;

use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PropertyController extends AbstractController
{
    #[Route('/property', name: 'app_property')]
    public function index(PropertyRepository $property): Response
    {
        return $this->render('property/property.html.twig', [
            'properties' => $property->findAll(),
			'breadcrumb_title' => 'Property',
        ]);
    }
}
