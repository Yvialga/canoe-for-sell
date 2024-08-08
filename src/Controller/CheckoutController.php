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
    public function index(BoatRepository $boatRepository, int $id): Response
    {
        $boat = $boatRepository->find($id);
        $boatPrice = $boat->getPrice();

        require_once(realpath(dirname(__DIR__) . '../../private/key.php'));
        \Stripe\Stripe::setApiKey($stripeSecretKey);

        $checkout_session = \Stripe\Checkout\Session::create([
            'mode' => 'payment',
            'line_items' => [[
                'price_data' => [
                    'unit_amount_decimal' => $boatPrice,
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

        header("HTTP/1.1 303 See Other");
        header("Location: " . $checkout_session->url);

        try {
            return $this->redirectToRoute($checkout_session->url);
        } catch (RouteNotFoundException $e) {
            throw new RouteNotFoundException("La page n'a pas été trouvé", 1);
            
        }
        
    }
}
