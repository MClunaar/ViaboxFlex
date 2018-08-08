<?php

namespace App\Controller\Admin;

use App\Entity\CustomerAddress;
use App\Form\CustomerAddressType;
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
 * @Route("admin/customerAddress/")
 *
 * Class CustomerAddressController
 * @package App\Controller\Admin
 */
class CustomerAddressController {

	/**
	 * @Route("list", name="admin.customerAddress.list")
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
		$customerAddresss = $entity_manager->getRepository(CustomerAddress::class)->findAll();

		return new Response($twig->render('admin/customerAddress/list.html.twig', [
			'customerAddresss' => $customerAddresss
		]));
	}

	public function add() {
	}

	/**
	 * @Route("edit/{customerAddress}", name="admin.customerAddress.edit")
	 *
	 * @param CustomerAddress                   $customerAddress
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
	public function edit(CustomerAddress $customerAddress, Request $request, FormFactoryInterface $form_factory,   EntityManagerInterface $entity_manager, \Twig_Environment $twig, RouterInterface $router) {

		$form = $form_factory->create(CustomerAddressType::class, $customerAddress);
		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid()) {
			$entity_manager->persist($customerAddress);
			$entity_manager->flush();

			$route = $router->generate('admin.customerAddress.edit', ['customerAddress' => $customerAddress->getId()]);

			return new RedirectResponse($route);
		}

		return new Response($twig->render('admin/customerAddress/edit.html.twig', [
			'form' => $form->createView(),
			'customerAddress' => $customerAddress
		]));
	}
}