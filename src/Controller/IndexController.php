<?php

namespace App\Controller;

use App\Repository\BoatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class IndexController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(BoatRepository $boatRepository): Response
    {

        return $this->render('index.html.twig', [
            'boats' => $boatRepository->findAll()
        ]);
    }

}
