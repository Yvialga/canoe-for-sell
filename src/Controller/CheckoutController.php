<?php

namespace App\Controller;

use App\Repository\BoatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class CheckoutController extends AbstractController
{
    #[Route('/checkout/{id}', name: 'app_checkout')]
    public function checkoutSession(BoatRepository $boatRepository, int $id): Response
    {
        $boat = $boatRepository->find($id);
        $boatPrice = $boat->getPrice();

        require_once(realpath(dirname(__DIR__) . '../../private/key.php'));
        \Stripe\Stripe::setApiKey($stripeSecretKey);

        $checkout_session = \Stripe\Checkout\Session::create([
            'mode' => 'payment',
            'line_items' => [[
                'price_data' => [
                    'unit_amount_decimal' => $boatPrice*100,
                    'currency' => 'EUR',
                    'product_data' => [
                        'name' => $boat->getTitle(),
                        'images' => [$boat->getPictureFilename()]
                    ]
                ],
                'quantity' => 1,
            ]],
            'success_url' => $this->generateUrl('app_success_checkout', array('type' => 'param'), UrlGeneratorInterface::ABSOLUTE_URL),
            'cancel_url' => $this->generateUrl('app_cancel_checkout', array('type' => 'param'), UrlGeneratorInterface::ABSOLUTE_URL),
        ]);

        try {
            return $this->redirect($checkout_session->url);
        } catch (RouteNotFoundException $e) {
            throw new RouteNotFoundException("Impossible d'accéder à la page de paiement", 1);
            
        }
        
    }

    #[Route('/cancel-checkout', name: 'app_cancel_checkout')]
    public function cancelCheckout(): Response
    {
        return $this->render('pages/payement/cancel.html.twig', [
        ]);
    }

    #[Route('/success-checkout', name: 'app_success_checkout')]
    public function successCheckout(): Response
    {
        return $this->render('pages/payement/success.html.twig', [
        ]);
    }
}
