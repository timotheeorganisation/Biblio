<?php


namespace App\Controller;


use App\Repository\ReserveRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReadCustomerReservationController extends AbstractController
{
    public function index(ReserveRepository $reserveRepository, UserRepository $userRepository)
    {
        $user = $userRepository->find($this->getUser()->getId());
        $rep =$reserveRepository->findUserReservation($user);

        return $this->render('main/read_customer_reservation.html.twig', [
            'reservations' => $rep
        ]);
    }
}