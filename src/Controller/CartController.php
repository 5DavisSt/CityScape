<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CartController extends AbstractController
{	
    #[Route('/cart', name: 'app_cart')]
    public function index(SessionInterface $session): Response
    {
        /*$cart = $session->get('cart', []);

        $cartWithData = [];

        foreach ($cart as $id => $quantity) {

        }

        foreach ($cartWithData as $item) {
            $totalItem = $item['product']->getPrice() * $item['quantity'];
        }
		*/
        return $this->render('cart/cart.html.twig', [
            'controller_name' => 'CartController',
            'breadcrumb_title' => 'Cart',
        ]);
    }
}