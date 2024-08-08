<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CancelCheckoutController extends AbstractController
{
    #[Route('/cancel-checkout', name: 'app_cancel_checkout')]
    public function index(): Response
    {
        return $this->render('pages/payement/cancel.html.twig', [
        ]);
    }
}
