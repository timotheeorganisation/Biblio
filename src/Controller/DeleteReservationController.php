<?php


namespace App\Controller;


use App\Repository\BorrowRepository;
use App\Repository\ReserveRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class DeleteReservationController extends AbstractController
{
    public function index(int $id, ReserveRepository $reserveRepository)
    {
        $reservation = $reserveRepository->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($reservation);
        $em->flush();

        return new RedirectResponse('/admin/read/reservations');
    }
}