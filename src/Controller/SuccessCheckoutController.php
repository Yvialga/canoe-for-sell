<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SuccessCheckoutController extends AbstractController
{
    #[Route('/success-checkout', name: 'app_success_checkout')]
    public function index(): Response
    {
        return $this->render('pages/payement/success.html.twig', [
            'controller_name' => 'SuccessCheckoutController',
        ]);
    }
}
