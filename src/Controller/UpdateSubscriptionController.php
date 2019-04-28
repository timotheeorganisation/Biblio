<?php


namespace App\Controller;


use App\Form\AddCustomerType;
use App\Form\AddSubsciptionType;
use App\Repository\SubscriptionRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

class UpdateSubscriptionController extends AbstractController
{
    public function index(int $id, SubscriptionRepository $subscriptionRepository, FormFactoryInterface $formFactory, Request $request)
    {
        $subscription = $subscriptionRepository->find($id);
        $form = $formFactory->createBuilder(AddSubsciptionType::class, $subscription)->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $employee = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($employee);
            $em->flush();
            return  $this->redirectToRoute('read_subscription');
        }
        return $this->render('subscription/update_subscription.html.twig', [
            'controller_name' => 'UpdateEmployeeController',
            'subscription' => $subscription,
            'form' => $form->createView()
        ]);
    }



}