<?php

namespace App\Controller;

use App\Form\AddEmployeeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AddEmployeeController extends AbstractController
{

    public function index(FormFactoryInterface $formFactory, Request $request)
    {
        $pass =  password_hash('yes', PASSWORD_ARGON2I);

        $form = $formFactory->createBuilder(AddEmployeeType::class)->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $employee = $form->getData();
            $role =  $form['roles']->getData();
            $employee->setRoles($role);
            $employee->setPassword($pass);
            $em = $this->getDoctrine()->getManager();
            $em->persist($employee);
            $em->flush();

        }
        return $this->render('employees/add_employee.html.twig', [
            'controller_name' => 'AddEmployeeController',
            'form' => $form->createView()
        ]);
    }
}
