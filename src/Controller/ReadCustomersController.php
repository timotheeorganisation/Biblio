<?php

namespace App\Controller;

use App\Repository\SubscribeRepository;
use App\Repository\SubscriptionRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ReadCustomersController extends AbstractController
{
    /**
     * @Route("/read/customers", name="read_customers")
     */
    public function index(UserRepository $userRepository, Request $request)
    {
        $rep=   $userRepository->findCustomers();
        return $this->render('customers/read_customer.html.twig', [
            'controller_name' => 'ReadCustomersController',
            'customers' => $rep
        ]);
    }
}
