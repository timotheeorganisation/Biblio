<?php

namespace App\Controller;

use App\Form\AddEmployeeType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UpdateEmployeeController extends AbstractController
{
    public function index(int $id, UserRepository $userRepository, FormFactoryInterface $formFactory, Request $request)
    {
        $user = $userRepository->find($id);
        $form = $formFactory->createBuilder(AddEmployeeType::class, $user)->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $employee = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($employee);
            $em->flush();
            return  $this->redirectToRoute('read_employees');
        }
        return $this->render('employees/update_employee.html.twig', [
            'controller_name' => 'UpdateEmployeeController',
            'form' => $form->createView()
        ]);
    }
}
