<?php


namespace App\Controller;


use App\Repository\SubscriptionRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReadSubscriptionsController extends AbstractController
{
    public function index(SubscriptionRepository $subscriptionRepository)
    {
        $rep =$subscriptionRepository->findAll();

        return $this->render('subscription/read_subscriptions.html.twig', [
            'controller_name' => 'ReadBookController',
            'subscription' => $rep
        ]);
    }
}