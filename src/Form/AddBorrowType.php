<?php


namespace App\Form;


use App\Entity\Book;
use App\Entity\Borrow;
use App\Entity\Subscribe;
use App\Entity\Subscription;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddBorrowType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'email',
                'choice_value' => 'id'])
            ->add('book', EntityType::class, [
                'class' => Book::class,
                'choice_label' => 'label',
                'choice_value' => 'id'])
            ->add('comment', TextType::class, [
                'required' => false
            ])
            ->add('submit', SubmitType::class, [ 'attr' => ['class' => "btn btn-success"]]);

    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Borrow::class,
        ]);
    }
}