<?php

namespace App\Controller;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ReadBookController extends AbstractController
{
    //affiche tous les livres de la base de données en stock
    public function index(BookRepository $bookRepository)
    {
        $rep = $bookRepository->findAll();

        return $this->render('stocks/read_books.html.twig', [
            'controller_name' => 'ReadBookController',
            'books' => $rep
        ]);
    }
}
