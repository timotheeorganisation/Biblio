<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class StocksController extends AbstractController
{
    /**
     * @Route("/stocks", name="stocks")
     */
    public function index()
    {
        return $this->render('stocks/search_books.html.twig', [
            'controller_name' => 'StocksController',
        ]);
    }

}
