<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use Circle\RestClientBundle\Exceptions\OperationTimedOutException;
use Circle\RestClientBundle\Services\RestClient;
use Circle\RestClientBundle\Tests\Unit\Services\RestClientTest;
use Doctrine\DBAL\Types\IntegerType;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AddStockController extends AbstractController
{
    public function index(string $id, FormFactoryInterface $formFactory, Request $request, BookRepository $bookRepository)
    {
        $url = ('https://www.googleapis.com/books/v1/volumes?q=' . $id);
        $book = $bookRepository->findOneByIdApi($id);
        $arr = file_get_contents($url);
        $arr2 = json_encode($arr);
        $json_data = json_decode($arr, true);
        $titre = $json_data["items"][0]['volumeInfo']['title'];
        $author = $json_data["items"][0]['volumeInfo']['authors'];
        $description = $json_data["items"][0]['volumeInfo']['description'];
        $datePubliciation = $json_data["items"][0]['volumeInfo']['publishedDate'];
        $image = $json_data["items"][0]['volumeInfo']['imageLinks']['thumbnail'];
        // $restClient = new RestClient($arr);
        //     (RestClient::class)->get('https://www.googleapis.com/books/v1/volumes?q=froome');

        if ($book  != NULL) {
            $printStock = $book->getStock();
        } else{
            $printStock = 0;
        }

            $formFactory = $this->createFormBuilder()
                ->add('stock', \Symfony\Component\Form\Extension\Core\Type\IntegerType::class)
                ->add('save', SubmitType::class, ['label' => 'Ajouter'])
                ->getForm();
        $formFactory->handleRequest($request);

        if ($formFactory->isSubmitted() && $formFactory->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $stock = $formFactory['stock']->getData();
            var_dump($stock);
            if ($book == null) {
                $book = new Book();
                $book->setDescription($description);
                $book->setLabel($titre);
                $book->setPublicationDate(new \DateTime('now'));
                ///  $book->setPublicationDate(\DateTime::createFromFormat('Y-d-m', $datePubliciation));
                $book->setIdApi($id);
                $book->setImage($image);
                $book->setAuthor(json_encode($author));
                $book->setStock($stock);
                $em = $this->getDoctrine()->getManager();
                $em->persist($book);
                $em->flush();
                //recup auteur, description, label, datePublication idApi
                //ajouter nouvelle data
            } else {
                $oldStock = (int)str_replace(' ', '', $book->getStock());
                var_dump($oldStock);
                $book->setStock($oldStock + $stock);
                $em = $this->getDoctrine()->getManager();
                $em->persist($book);
                $em->flush();
                //éditer data existanre ($book)
            }
            return $this->redirectToRoute('stocks');
        }


        return $this->render('stocks/add_stock.html.twig', [
            'search' => $id,
            'controller_name' => 'AddStockController',
            'form' => $formFactory->createView(),
            'stock' => $printStock,
        ]);
    }
}
