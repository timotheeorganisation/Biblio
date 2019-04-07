<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AddStockController extends AbstractController
{
    public function index(string $id)
    {
        return $this->render('stocks/add_stock.html.twig', [
            'search' => $id,
            'controller_name' => 'AddStockController',
        ]);
    }
}
