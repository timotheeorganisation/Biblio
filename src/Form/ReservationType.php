<?php


namespace App\Form;


use App\Entity\Book;
use App\Entity\Reserve;
use App\Entity\Subscription;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('book', EntityType::class, [
                'class' => Book::class,
                'choice_label' => 'label',
                'choice_value' => 'id',
                'label' => 'Choisir un livre à réserver',
                'attr' => [ 'class' => "js-example-basic-single"]
    ])
        ->add('submit', SubmitType::class, [
            'label' => "Réserver ce Livre",
            'attr' => [ "class" => 'btn-warning']]);

    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reserve::class,
        ]);
    }
}