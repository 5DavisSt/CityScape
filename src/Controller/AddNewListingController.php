<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AddNewListingController extends AbstractController
{
    #[Route('/add-new-listing', name: 'app_add_new_listing')]
    public function index(): Response
    {
        return $this->render('add_new_listing/add-listing.html.twig', [
            'controller_name' => 'AddNewListingController',
			'breadcrumb_title' => 'Add New Listing',
        ]);
    }
}
