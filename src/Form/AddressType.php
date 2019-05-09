<?php


namespace App\Form;


use Doctrine\ORM\Query\Expr\Base;
use Symfony\Component\Form\Extension\Core\Type\BaseType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class AddressType extends AddEmployeeType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('number', IntegerType::class)
            ->add('street', TextType::class)
            ->add('CP', IntegerType::class)
            ->add('city', TextType::class);
        ;
    }
}