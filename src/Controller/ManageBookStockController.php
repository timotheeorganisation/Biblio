<?php

namespace App\Controller;

use App\Entity\StockMoving;
use App\Repository\BookRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ManageBookStockController extends AbstractController
{
    public function index(BookRepository $bookRepository, int $id, Request $request)
    {
//récupération du livre
        $book = $bookRepository->findOneById($id);

        //formulaire d'ajout des quantités
        $formFactory = $this->createFormBuilder()
            ->add('add', IntegerType::class)
            ->add('delete', IntegerType::class)
            ->add('save', SubmitType::class, ['label' => 'Ajouter'])
            ->getForm();
        $formFactory->handleRequest($request);
        //on met à jour la valeur de stock du livre.
        if ($formFactory->isSubmitted() && $formFactory->isValid()) {
            $addStock = (!empty($formFactory['add']->getData()) ? $formFactory['add']->getData() : 0);
            $deleteStock = (!empty($formFactory['delete']->getData()) ? $formFactory['delete']->getData() : 0);
            $oldStock = (!empty($book->getStock()) ? (int)str_replace(' ', '', $book->getStock()) : 0);
            $book->setStock($oldStock + $addStock - $deleteStock);
            $em = $this->getDoctrine()->getManager();
            $em->persist($book);
            $em->flush();
            //Enregistrelent entrée/sortie
            $this->UpdateStockMoving($addStock, $deleteStock, $book);
            return $this->redirectToRoute('stocks');
        }
        return $this->render('stocks/manage_book_stock.html.twig', [
            'controller_name' => 'ManageBookStockController',
            'book' => $book,
            'form' => $formFactory->createView(),
        ]);
    }

    //Fonction permettant de mettre à jour la table Entrée/Sortie (Moving Stock).
    private function UpdateStockMoving($addStock, $deleteStock, $book)
    {
        $em = $this->getDoctrine()->getManager();
        if ($addStock != 0) {
            $addStockMoving = new StockMoving();
            $addStockMoving->setQuantity($addStock);
            $addStockMoving->setType("Entrée");
            $addStockMoving->setDate(new DateTime('now'));
            $addStockMoving->setUser($this->getUser());
            $addStockMoving->setBook($book);
            $em->persist($addStockMoving);
        }

        if ($deleteStock != 0) {
            $deleteStockMoving = new StockMoving();
            $deleteStockMoving->setQuantity($deleteStock);
            $deleteStockMoving->setType("Sortie");
            $deleteStockMoving->setDate(new DateTime('now'));
            $deleteStockMoving->setUser($this->getUser());
            $deleteStockMoving->setBook($book);
            $em->persist($deleteStockMoving);
        }
        $em->flush();
    }
}
