<?php


namespace App\Controller;


use App\Form\AddBorrowType;
use App\Repository\BorrowRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

class DeleteBorrowController extends AbstractController
{
    public function index(int $id, FormFactoryInterface $formFactory, Request $request, BorrowRepository $borrowRepository)
    {
        $borrow = $borrowRepository->find($id);

            ///vérifier si livre a du stock disponible
            //
            $em = $this->getDoctrine()->getManager();
            $em->remove($borrow);
            $em->flush();


        return $this->render('borrow/read_borrow.html.twig', [
        ]);
    }
}