<?php

namespace App\Form;

use App\Entity\CustomerAddress;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomerAddressType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id',HiddenType::class)
            ->add('address' ,null,array ('label'=>'Votre adresse:'))
            ->add('address2' ,null,array ('label'=>'Complément adresse:'))
            ->add('country',null,array ('label'=>'Pays:'))
            ->add('city' ,null,array ('label'=>'Ville:'))
            ->add('codePostal' ,null,array ('label'=>'Code postal:'))
            ->add('activeAddress' ,null,array ('label'=>'Activer cette adresse'));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => CustomerAddress::class
        ));
    }
}
