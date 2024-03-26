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
    public function add(SessionInterface $session, $id)
    {
	$cart = $session->get('cart', []);
        
        if (!empty($cart[$id])) {
            $cart[$id]++;
        } else {
            $cart[$id] = 1;
        }
        
        $session->set('cart', $cart);
        
        return $this->redirectToRoute('app_show_cart');
    }    
    
    #[Route('/api/total/show/cart/', name: 'app_show_cart')]
    public function show(SessionInterface $session, PropertyRepository $property): Response
    {
        $cart = $session->get('cart');

        $cartWithData = [];

        foreach ($cart as $id => $quantity) {
            $cartWithData[] = [
                'product' => $property->find($id),
                'quantity' => $quantity
            ];
        }

        $total = 0;

        foreach ($cartWithData as $item) {
            $totalItem = $item['product']->getPropPrice() * $item['quantity'];
            $total += $totalItem;
        }

        return $this->render('cart/cart.html.twig', [
            'items' => $cartWithData,
            'total' => $total,
            'breadcrumb_title' => 'Cart',
        ]);
    }
    
    #[Route('/api/total/remove/cart/{id}', name: 'app_remove_cart')]
    public function remove(SessionInterface $session, $id)
    {
        $cart = $session->get('cart', []);
        
        if (!empty($cart[$id])) {
            unset($cart[$id]);
        }
        
        $session->set('cart', $cart);
        
        return $this->redirectToRoute('app_show_cart');
    }

    #[Route('/api/total/cart/payment', name: 'app_payment')]
    public function pay(SessionInterface $session, $id)
    {
        $cart = $session->get('cart', []);
        
        if (!empty($cart[$id])) {
            unset($cart[$id]);
        }
        
        $session->set('cart', $cart);
        
        return $this->redirectToRoute('app_show_cart');
    }
}
