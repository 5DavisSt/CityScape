<?php

namespace App\Controller;

use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PropertyController extends AbstractController
{
    #[Route('/property', name: 'app_property')]
    public function index(PropertyRepository $property, EntityManagerInterface $em, PaginatorInterface $paginator, Request $request): Response
    {
		$properties = $property->filterPropertyByCategory();
		
		$pagination = $paginator->paginate(
			$properties, /* query NOT result */
			$request->query->getInt('page', 1), /*page number*/
			10 /*limit per page*/
		);
		
        return $this->render('property/property.html.twig', [
            'properties' => $pagination,
			'breadcrumb_title' => 'Property',
        ]);
    }
}
