<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class IndexController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(EntityManagerInterface $entityManager): Response
    {

        $boatControllerAccess = new BoatController();
        $boatsList = $boatControllerAccess->getAllboat($entityManager);

        return $this->render('index.html.twig', [
            'boatsList' => $boatsList
        ]);
    }

}
