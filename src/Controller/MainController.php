<?php

namespace App\Controller;

use App\Entity\Calendar;
use App\Repository\CalendarRepository;
use App\Repository\ReservationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/main', name: 'app_main')]
    public function index(ReservationRepository $calendar): Response
    {
        $events = $calendar->findAll();
       foreach($events as $event){
        $rdvs[] = [
            'id' => $event->getId_res(),
            'start' => $event->getDateDebut()->format('Y-m-d H:i:s'),
            'end' => $event->getDateFin()->format('Y-m-d H:i:s'),
           
            
        ];
       }
       $data = json_encode($rdvs);

        return $this->render('main/index.html.twig', compact('data'));
    }
}