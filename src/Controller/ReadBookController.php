<?php

namespace App\Controller;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ReadBookController extends AbstractController
{
    /**
     * @Route("/read/book", name="read_book")
     */
    public function index(BookRepository $bookRepository)
    {
    $rep =$bookRepository->findAll();

        return $this->render('stocks/read_books.html.twig', [
            'controller_name' => 'ReadBookController',
            'books' => $rep
        ]);
    }
}
