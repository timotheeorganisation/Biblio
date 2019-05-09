<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ReadEmployeesController extends AbstractController
{
    public function index(UserRepository $userRepository)
    {
        $rep =$userRepository->findEmployees();

        return $this->render('employees/read_employees.html.twig', [
            'controller_name' => 'ReadBookController',
            'employees' => $rep
        ]);
    }
}
