<?php


namespace App\Controller;


use App\Form\AddEmployeeType;
use App\Form\ReservationType;
use App\Repository\BookRepository;
use App\Repository\ReserveRepository;
use App\Repository\SubscriptionRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class ReservationController extends AbstractController
{
    public function index(BookRepository $bookRepository, FormFactoryInterface $formFactory, Request $request,
                          ReserveRepository $reserveRepository, UserRepository $userRepository)
    {
        $rep =$bookRepository->findAll();
        $form = $formFactory->createBuilder(ReservationType::class)->getForm();
        $form->handleRequest($request);
        $nbRes = ($reserveRepository->countUserRes($userRepository->find($this->getUser())));
    //   $nbRes =  $reserveRepository->getNb();

        if($nbRes>3)
        {
            return $this->render('main/too_much_reservation.html.twig');
        }
        if($form->isSubmitted() && $form->isValid())
        {
            $reservation = $form->getData();
            $reservation->setState(0);
            $reservation->setReserveDate(new \DateTime('now'));
            $reservation->setUser($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($reservation);
            $em->flush();
            //envoi d'e-mail confirmant la résa
            return new RedirectResponse('/main');
        }

        return $this->render('main/reservation_modal.html.twig', [
            'books' => $rep,
            'form' => $form->createView(),
            'nbRes' => $nbRes
        ]);
    }
}