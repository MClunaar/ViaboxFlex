<?php
/**
 * Created by PhpStorm.
 * User: BASIRICO
 * Date: 04/07/2018
 * Time: 16:48
 */

namespace App\Form;
use App\Entity\Customer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class CustomerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id',HiddenType::class)
            ->add('firstName',null,array ('label'=>'Prénom:'))
            ->add('lastName',null,array ('label'=>'Nom:'))
            ->add('birthday',DateTimeType::class,array ('label'=>'Date de Naissance:'))
            ->add('phoneNumber',null,array ('label'=>'Téléphone fixe:'))
            ->add('phoneNumberSecondary',null,array ('label'=>'Téléphone portable:'))
            ->add('customerAddress',  CustomerAddressType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Customer::class
        ));
    }
}