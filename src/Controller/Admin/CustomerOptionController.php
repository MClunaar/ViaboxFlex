<?php

namespace App\Controller\Admin;

use App\Entity\CustomerOption;
use App\Form\CustomerOptionType;
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
 * @Route("admin/customerOption/")
 *
 * Class CustomerOptionController
 * @package App\Controller\Admin
 */
class CustomerOptionController {

	/**
	 * @Route("list", name="admin.customerOption.list")
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
		$customerOptions = $entity_manager->getRepository(CustomerOption::class)->findAll();

		return new Response($twig->render('admin/customerOption/list.html.twig', [
			'customerOptions' => $customerOptions
		]));
	}

	public function add() {
	}

	/**
	 * @Route("edit/{customerOption}", name="admin.customerOption.edit")
	 *
	 * @param CustomerOption                   $customerOption
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
	public function edit(CustomerOption $customerOption, Request $request, FormFactoryInterface $form_factory,   EntityManagerInterface $entity_manager, \Twig_Environment $twig, RouterInterface $router) {

		$form = $form_factory->create(CustomerOptionType::class, $customerOption);
		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid()) {
			$entity_manager->persist($customerOption);
			$entity_manager->flush();

			$route = $router->generate('admin.customerOption.edit', ['customerOption' => $customerOption->getId()]);

			return new RedirectResponse($route);
		}

		return new Response($twig->render('admin/customerOption/edit.html.twig', [
			'form' => $form->createView(),
			'customerOption' => $customerOption
		]));
	}
}