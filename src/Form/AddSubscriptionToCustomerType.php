<?php


namespace App\Form;


use App\Entity\Subscribe;
use App\Entity\Subscription;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddSubscriptionToCustomerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('subscription', EntityType::class, [
            'class' => Subscription::class,
                'choice_label' => 'label',
            'choice_value' => 'id'])
        ->add('submit', SubmitType::class, [ 'attr' => ['class' => "btn btn-success"]]);

    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Subscribe::class,
        ]);
    }
}