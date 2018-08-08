<?php

namespace App\Controller\Admin;

use App\Entity\Payment;
use App\Form\PaymentType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionBagInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;

/**
 * @Route("admin/payment/")
 *
 * Class PaymentController
 * @package App\Controller\Admin
 */
class PaymentController {

	/**
	 * @Route("list", name="admin.payment.list")
	 *
	 * @param EntityManagerInterface $entity_manager
	 * @param \Twig_Environment      $twig
	 *
	 * @return Response
	 * @throws \Twig_Error_Loader
	 * @throws \Twig_Error_Runtime
	 * @throws \Twig_Error_Syntax
	 */
	public function list(EntityManagerInterface $entity_manager,  \Twig_Environment $twig) {
		$payments = $entity_manager->getRepository(Payment::class)->findAll();

		return new Response($twig->render('admin/payment/list.html.twig', [
			'payments' => $payments
		]));
	}

	public function add() {
	}

	/**
	 * @Route("edit/{payment}", name="admin.payment.edit")
	 *
	 * @param Payment                   $payment
	 * @param Request                $request
	 * @param FormFactoryInterface   $form_factory
	 * @param EntityManagerInterface $entity_manager
	 * @param \Twig_Environment      $twig
	 *
	 * @return Response|RedirectResponse
	 * @throws \Twig_Error_Loader
	 * @throws \Twig_Error_Runtime
	 * @throws \Twig_Error_Syntax
	 */
	public function edit(Payment $payment, Request $request, FormFactoryInterface $form_factory,   EntityManagerInterface $entity_manager, \Twig_Environment $twig, RouterInterface $router) {

		$form = $form_factory->create(PaymentType::class, $payment);
		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid()) {
			$entity_manager->persist($payment);
			$entity_manager->flush();

			$route = $router->generate('admin.payment.edit', ['payment' => $payment->getId()]);

			return new RedirectResponse($route);
		}

		return new Response($twig->render('admin/payment/edit.html.twig', [
			'form' => $form->createView(),
			'payment' => $payment
		]));
	}
}