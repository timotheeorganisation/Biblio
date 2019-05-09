<?php


namespace App\Controller;


use App\Repository\BookRepository;
use App\Repository\SubscriptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReservationController extends AbstractController
{
    public function index(BookRepository $bookRepository)
    {
        $rep =$bookRepository->findAll();

        return $this->render('main/reservation_modal.html.twig', [
            'books' => $rep
        ]);
    }
}