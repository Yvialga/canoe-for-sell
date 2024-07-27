<?php

namespace App\Controller;

use App\Entity\Boat;
use App\Entity\User;
use App\Form\BoatAdType;
use App\Repository\BoatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Clock\Clock;
use Symfony\Component\Clock\MockClock;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BoatController extends AbstractController
{

    #[Route('/new-ad', name: 'app_new_ad')]
    public function manageBoatAdForm(Request $request, EntityManagerInterface $entityManager): Response
    {

        $boatAd = new Boat();
        $form = $this->createForm(BoatAdType::class, $boatAd);
        Clock::set(new MockClock());
        $clock = Clock::get();
        $user = $this->getUser();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $boatAd = $form->getData();
            $boatAd->setDateCreation($clock->now());
            $boatAd->setFKBoatUser($user);
            $entityManager->persist($boatAd);
            $entityManager->flush();
            // $posted = $this->generateUrl('/ad-post-success');
            return $this->redirectToRoute('app_ad_post_success');
        }

        return $this->render('pages/boat_ad_form/index.html.twig', [
            'form' => $form,
        ]);
    }
}
