<?php


namespace App\Controller;


use App\Form\AddCustomerType;
use App\Form\AddSubsciptionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

class AddSubscriptionController extends AbstractController
{
    public function index(FormFactoryInterface $formFactory, Request $request)
    {
        $form = $formFactory->createBuilder(AddSubsciptionType::class)->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $subscription = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($subscription);
            $em->flush();
            return $this->redirectToRoute('read_subscription');
        }
        return $this->render('subscription\add_subscription.html.twig', [
            'controller_name' => 'AddEmployeeController',
            'form' => $form->createView()
        ]);
    }
}