<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\ViaboxAddress;
use App\Entity\Form;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id',HiddenType::class)
            ->add('price',null,array ('label'=>'Prix'))
            ->add('address', EntityType::class, [
                'class' => ViaboxAddress::class,
                'placeholder' => ' - Veuillez choisir une addresse- ',
                'choice_label' => 'getName'
            ])
        ;
    }

    public function configureOptionsP(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Product::class
        ));
    }

}
