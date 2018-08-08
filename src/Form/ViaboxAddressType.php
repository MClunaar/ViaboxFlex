<?php

namespace App\Form;

use App\Entity\ViaboxAddress;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ViaboxAddressType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id',HiddenType::class)
            ->add('name' ,null,array ('label'=>'Nom du viaboxAddress'))
            ->add('address' ,null,array ('label'=>'Adresse'))
            ->add('address2' ,null,array ('label'=>'Complément adresse:'))
            ->add('country',null,array ('label'=>'Pays'))
            ->add('city' ,null,array ('label'=>'Ville'))
            ->add('zipCode' ,null,array ('label'=>'Code postal'))
            ->add('siret' ,null,array ('label'=>'Siret'))
            ->add('codeNaf' ,null,array ('label'=>'CodeNaf'))
            ->add('codeApe' ,null,array ('label'=>'codeApe'))
            ->add('phone' ,null,array ('label'=>'phone'));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => ViaboxAddress::class
        ));
    }
}
