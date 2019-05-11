<?php


namespace App\Controller;


use App\Repository\BorrowRepository;
use App\Repository\ReserveRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReadCustomerBorrowController extends AbstractController
{
    public function index(BorrowRepository $borrowRepository, UserRepository $userRepository)
    {
        $user = $userRepository->find($this->getUser()->getId());
        $rep =$borrowRepository->findUserBorrowing($user);

        return $this->render('main/read_customer_borrow.html.twig', [
            'borrowing' => $rep
        ]);
    }
}