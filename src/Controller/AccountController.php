<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\BoatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class AccountController extends AbstractController
{
    #[Route('/your-ads', name: 'app_ads_list')]
    public function adsList(#[CurrentUser()] ?User $user, BoatRepository $boatRepository): Response
    {

        if (null === $user) {
            return $this->redirectToRoute('app_index');
        }
        // $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user->getId();
        $userBoats = $boatRepository->findBy(['fk_boat_user' => $user]);


        return $this->render('account_pages/ads_list/index.html.twig', [
            'boats' => $userBoats
        ]);
    }
}
