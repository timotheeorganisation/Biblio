<?php
namespace App\Controller;

use App\Form\AddBorrowType;
use App\Form\AddCustomerType;
use App\Security\SendMail;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

class AddBorrowController extends AbstractController
{
    public function index(FormFactoryInterface $formFactory, Request $request, SendMail $sendMail)
    {
        $form = $formFactory->createBuilder(AddBorrowType::class)->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            ///vérifier si livre a du stock disponible
            //
            $borrow = $form->getData();
            $borrow->setStartDate(new DateTime('now'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($borrow);
            $em->flush();
            $sendMail->sendMail();


            return $this->redirectToRoute('read_borrow');
        }
        return $this->render('borrow/add_borrow.html.twig', [
            'form' => $form->createView()
        ]);
    }
}