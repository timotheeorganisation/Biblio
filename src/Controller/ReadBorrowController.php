<?php


namespace App\Controller;


use App\Repository\BorrowRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReadBorrowController extends AbstractController
{

    public function index(BorrowRepository $borrowRepository)
    {
        $rep =$borrowRepository->findAll();

        return $this->render('borrow/read_borrow.html.twig', [
            'borrows' => $rep
        ]);
    }
}