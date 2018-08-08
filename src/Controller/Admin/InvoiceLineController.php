<?php

namespace App\Controller\Admin;

use App\Entity\InvoiceLine;
use App\Form\InvoiceLineType;
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
 * @Route("admin/invoiceLine/")
 *
 * Class InvoiceLineController
 * @package App\Controller\Admin
 */
class InvoiceLineController {

	/**
	 * @Route("list", name="admin.invoiceLine.list")
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
		$invoiceLines = $entity_manager->getRepository(InvoiceLine::class)->findAll();

		return new Response($twig->render('admin/invoiceLine/list.html.twig', [
			'invoiceLines' => $invoiceLines
		]));
	}

	public function add() {
	}

	/**
	 * @Route("edit/{invoiceLine}", name="admin.invoiceLine.edit")
	 *
	 * @param InvoiceLine                   $invoiceLine
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
	public function edit(InvoiceLine $invoiceLine, Request $request, FormFactoryInterface $form_factory,   EntityManagerInterface $entity_manager, \Twig_Environment $twig, RouterInterface $router) {

		$form = $form_factory->create(InvoiceLineType::class, $invoiceLine);
		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid()) {
			$entity_manager->persist($invoiceLine);
			$entity_manager->flush();

			$route = $router->generate('admin.invoiceLine.edit', ['invoiceLine' => $invoiceLine->getId()]);

			return new RedirectResponse($route);
		}

		return new Response($twig->render('admin/invoiceLine/edit.html.twig', [
			'form' => $form->createView(),
			'invoiceLine' => $invoiceLine
		]));
	}
}