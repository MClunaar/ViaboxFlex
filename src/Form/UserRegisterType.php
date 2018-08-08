<?php
/**
 * Created by PhpStorm.
 * User: BASIRICO
 * Date: 04/07/2018
 * Time: 16:48
 */

namespace App\Form;
use App\Entity\Customer;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserRegisterType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
            ->add('id',HiddenType::class)
			->add('email', EmailType::class,
				array(
					'label' => 'E-mail'
				))
		;
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => User::class,
			'validation_groups' => ['Default', 'registration']
		));
	}
}