<?php

namespace App\Controller\Admin;

use App\Entity\TypePayment;
use App\Form\TypePaymentType;
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
 * @Route("admin/typePayment/")
 *
 * Class TypePaymentController
 * @package App\Controller\Admin
 */
class TypePaymentController {

	/**
	 * @Route("list", name="admin.typePayment.list")
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
		$typePayments = $entity_manager->getRepository(TypePayment::class)->findAll();

		return new Response($twig->render('admin/typePayment/list.html.twig', [
			'typePayments' => $typePayments
		]));
	}

	public function add() {
	}

	/**
	 * @Route("edit/{typePayment}", name="admin.typePayment.edit")
	 *
	 * @param TypePayment                   $typePayment
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
	public function edit(TypePayment $typePayment, Request $request, FormFactoryInterface $form_factory,   EntityManagerInterface $entity_manager, \Twig_Environment $twig, RouterInterface $router) {

		$form = $form_factory->create(TypePaymentType::class, $typePayment);
		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid()) {
			$entity_manager->persist($typePayment);
			$entity_manager->flush();

			$route = $router->generate('admin.typePayment.edit', ['typePayment' => $typePayment->getId()]);

			return new RedirectResponse($route);
		}

		return new Response($twig->render('admin/typePayment/edit.html.twig', [
			'form' => $form->createView(),
			'typePayment' => $typePayment
		]));
	}
}