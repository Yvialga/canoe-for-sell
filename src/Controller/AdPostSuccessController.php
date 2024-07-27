<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdPostSuccessController extends AbstractController
{
    #[Route('/ad-post-success', name: 'app_ad_post_success')]
    public function index(): Response
    {
        return $this->render('pages/ad_post_success/index.html.twig', [
            'controller_name' => 'AdPostSuccessController',
        ]);
    }
}
