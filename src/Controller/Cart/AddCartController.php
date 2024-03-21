<?php

namespace App\Controller\Cart;

use App\Repository\PropertyRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AddCartController extends AbstractController
{	
    #[Route('/api/add/cart/{id}', name: 'app_add_cart')]
    public function index(int $id, SessionInterface $session, PropertyRepository $property): Response
    {
		//$this->cartService->add($id);

        return $this->render('cart/cart.html.twig', [
            'controller_name' => 'AddCartController',
			'breadcrumb_title' => 'Add Cart',
        ]);
    }
}
