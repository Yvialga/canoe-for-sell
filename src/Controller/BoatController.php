<?php

namespace App\Controller;

use App\Entity\Boat;
use App\Form\BoatAdType;
use App\Repository\BoatRepository;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Clock\Clock;
use Symfony\Component\Clock\MockClock;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BoatController extends AbstractController
{

    public function getAllboat(EntityManagerInterface $entityManager): array {
        
        $boats = $entityManager->getRepository(Boat::class)->findAll();

        return $boats;
    }

    #[Route('/boat/{id}', name: 'boat_show')]
    public function show(BoatRepository $boatRepository, int $id): Response {

        $boat = $boatRepository->find($id);

        if (!$boat) {
            throw $this->createNotFoundException('No boat with id' . $id . ' exist');
        }

        return $this->render('pages/boat/show.html.twig', [
            'boat' => $boat,
            
        ]);
    }

    #[Route('/new-ad', name: 'app_new_ad')]
    public function handleBoatAdForm(
        Request $request,
        EntityManagerInterface $entityManager,
        FileUploader $fileUploader
        ): Response {

        $boatAd = new Boat();
        $form = $this->createForm(BoatAdType::class, $boatAd);
        Clock::set(new MockClock());
        $clock = Clock::get();
        $user = $this->getUser();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $pictureFile = $form->get('picture')->getData();

            if ($pictureFile) { // check if a file is upload and processed it only in this case
                $pictureFilename = $fileUploader->upload($pictureFile);
                // updates the pictureFilename property to store the Image file instead of its contents
                $boatAd->setPictureFilename($pictureFilename);
            }
            
            $boatAd = $form->getData();
            $boatAd->setDateCreation($clock->now());
            $boatAd->setFKBoatUser($user);

            $entityManager->persist($boatAd);
            $entityManager->flush();

            return $this->redirectToRoute('app_index');
        }

        return $this->render('pages/boat_ad_form/index.html.twig', [
            'form' => $form,
        ]);
    }
}
