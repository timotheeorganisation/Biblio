<?php

namespace App\Controller;

use App\Form\AddCustomerType;
use App\Form\AddEmployeeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AddCustomerController extends AbstractController
{
    /**
     * @Route("/add/customer", name="add_customer")
     */
    public function index(FormFactoryInterface $formFactory, Request $request)
    {
        $pass = password_hash('yes', PASSWORD_ARGON2I);

        $form = $formFactory->createBuilder(AddCustomerType::class)->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $customer = $form->getData();
            $customer->setRoles(["ROLE_USER"]);
            $customer->setPassword($pass);
            $em = $this->getDoctrine()->getManager();
            $em->persist($customer);
            $em->flush();
        }
        return $this->render('employees/add_employee.html.twig', [
            'controller_name' => 'AddEmployeeController',
            'form' => $form->createView()
        ]);
    }
}
