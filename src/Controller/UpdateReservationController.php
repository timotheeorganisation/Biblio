<?php


namespace App\Controller;


use App\Form\AddEmployeeType;
use App\Repository\ReserveRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

class UpdateReservationController extends AbstractController
{
    public function index(int $id, ReserveRepository $reserveRepository, FormFactoryInterface $formFactory, Request $request)
    {
        $reservation = $reserveRepository->find($id);
        $reservation->setState(1);
        $em = $this->getDoctrine()->getManager();
        $em->persist($reservation);
        $em->flush();
        return  $this->redirectToRoute('read_reservations');
    }
}