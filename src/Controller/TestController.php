<?php

namespace App\Controller;
use App\Repository\FicheTechniqueRepository;
use App\Repository\VoitureRepository;
use App\Repository\FactureRepository;
use App\Repository\ReservationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route('/back', name: 'app_back')]
    public function back(): Response
    {
        return $this->render('back.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }

    #[Route('/front', name: 'app_front')]
    public function front(): Response
    {
        return $this->render('frontt.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }


    #[Route('/indexbackfacture', name: 'app_back_facture', methods: ['GET'])]
    public function indexs(FactureRepository $factureRepository): Response
    {
        return $this->render('facture/indexback.html.twig', [
            'factures' => $factureRepository->findAll(),
        ]);

       
    }
    
    #[Route('/indexbackreservation', name: 'app_back_reservation', methods: ['GET'])]
    public function indexr(ReservationRepository $reservationRepository): Response
    {
        return $this->render('reservation/indexback.html.twig', [
            'reservations' => $reservationRepository->findAll(),
        ]);

       
    }
    #[Route('/indexbackfiche', name: 'app_back_fichetechnique', methods: ['GET'])]
    public function indexf(FicheTechniqueRepository $fichetechniqueRepository): Response
    {
        return $this->render('fiche_technique/indexback.html.twig', [
            'fiche_techniques' => $fichetechniqueRepository->findAll(),
        ]);

       
    }
    #[Route('/indexbackvoiture', name: 'app_back_voiture', methods: ['GET'])]
    public function indexg(VoitureRepository $voitureRepository): Response
    {
        return $this->render('voiture/indexback.html.twig', [
            'voitures' => $voitureRepository->findAll(),
        ]);

       
    }
}
