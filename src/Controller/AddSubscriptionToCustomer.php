<?php


namespace App\Controller;


use App\Form\AddSubsciptionType;
use App\Form\AddSubscriptionToCustomerType;
use App\Repository\SubscriptionRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

class AddSubscriptionToCustomer extends AbstractController
{
    public function index(FormFactoryInterface $formFactory, Request $request)
    {
        $form = $formFactory->createBuilder(AddSubscriptionToCustomerType::class)->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $subscription = $form->getData();
           // $role =  $form['Subscription']->getData();
            //$subscription->setRoles($role);
            $subscription->setUser($this->getUser());
            $subscription->setDate(new \DateTime('now'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($subscription);
            $em->flush();
            return $this->redirectToRoute('read_subscription');
        }
        return $this->render('subscription\add_subscription_to_customer.html.twig', [
            'controller_name' => 'AddEmployeeController',
            'form' => $form->createView()
        ]);
    }
}