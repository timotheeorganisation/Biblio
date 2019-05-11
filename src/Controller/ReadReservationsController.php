<?php


namespace App\Controller;


use App\Repository\ReserveRepository;
use App\Repository\SubscriptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReadReservationsController extends AbstractController
{
    public function index(ReserveRepository $reserveRepository)
    {
        $rep = $reserveRepository->findAllCurrentReservation();

        return $this->render('reserve/read_reservations.html.twig', [
            'reservations' => $rep
        ]);
    }
}