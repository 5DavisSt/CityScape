<?php

namespace App\Controller\Cart;

use App\Repository\PropertyRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Stripe\Stripe;

class AddCartController extends AbstractController
{
    #[Route('/api/add/cart/{id}', name: 'app_add_cart')]
    #[IsGranted('ROLE_USER')]
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
    #[IsGranted('ROLE_USER')]
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
    #[IsGranted('ROLE_USER')]
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
    #[IsGranted('ROLE_USER')]
    public function payment(SessionInterface $session, PropertyRepository $propertyRepository): Response
    {
        $stripeSK = $_ENV['STRIPE_SK'];
        Stripe::setApiKey($stripeSK);
        
        $cart = $session->get('cart', []);
        
        $lineItems = [];
        
        foreach ($cart as $id => $quantity) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $propertyRepository->find($id)->getPropTitle()
                    ],
                    'unit_amount' => $propertyRepository->find($id)->getPropPrice() * 100
                ],
                'quantity' => $quantity
            ];
        }
        
        $session_payment = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card', 'bancontact', 'ideal', 'sepa_debit'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => 'https://localhost:8000/success?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => $this->generateUrl('app_cancel_cart', [], UrlGeneratorInterface::ABSOLUTE_URL)
        ]);
        
        return $this->redirect($session_payment->url, 303);
    }
    
    #[Route('/success', name: 'app_success')]
    #[IsGranted('ROLE_USER')]
    public function success(SessionInterface $session): Response
    {
        $session->set('cart', []);
        
        return $this->render('cart/success.html.twig');
    }
    
    #[Route('/cart/total/remove/cancel', name: 'app_cancel_cart')]
    #[IsGranted('ROLE_USER')]
    public function cancel_cart(): Response
    {
        return $this->render('cart/cancel_cart.html.twig');
    }
}
