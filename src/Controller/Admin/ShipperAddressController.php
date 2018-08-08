<?php

namespace App\Controller\Admin;

use App\Entity\ShipperAddress;
use App\Form\ShipperAddressType;
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
 * @Route("admin/shipperAddress/")
 *
 * Class ShipperAddressController
 * @package App\Controller\Admin
 */
class ShipperAddressController {

	/**
	 * @Route("list", name="admin.shipperAddress.list")
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
		$shipperAddresss = $entity_manager->getRepository(ShipperAddress::class)->findAll();

		return new Response($twig->render('admin/shipperAddress/list.html.twig', [
			'shipperAddresss' => $shipperAddresss
		]));
	}

	public function add() {
	}

	/**
	 * @Route("edit/{shipperAddress}", name="admin.shipperAddress.edit")
	 *
	 * @param ShipperAddress                   $shipperAddress
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
	public function edit(ShipperAddress $shipperAddress, Request $request, FormFactoryInterface $form_factory,   EntityManagerInterface $entity_manager, \Twig_Environment $twig, RouterInterface $router) {

		$form = $form_factory->create(ShipperAddressType::class, $shipperAddress);
		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid()) {
			$entity_manager->persist($shipperAddress);
			$entity_manager->flush();

			$route = $router->generate('admin.shipperAddress.edit', ['shipperAddress' => $shipperAddress->getId()]);

			return new RedirectResponse($route);
		}

		return new Response($twig->render('admin/shipperAddress/edit.html.twig', [
			'form' => $form->createView(),
			'shipperAddress' => $shipperAddress
		]));
	}
}