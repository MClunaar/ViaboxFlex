<?php

namespace App\Controller\Admin;

use App\Entity\Invoice;
use App\Form\InvoiceType;
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
 * @Route("admin/invoice/")
 *
 * Class InvoiceController
 * @package App\Controller\Admin
 */
class InvoiceController {

	/**
	 * @Route("list", name="admin.invoice.list")
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
		$invoices = $entity_manager->getRepository(Invoice::class)->findAll();

		return new Response($twig->render('admin/invoice/list.html.twig', [
			'invoices' => $invoices
		]));
	}

	public function add() {
	}

	/**
	 * @Route("edit/{invoice}", name="admin.invoice.edit")
	 *
	 * @param Invoice                   $invoice
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
	public function edit(Invoice $invoice, Request $request, FormFactoryInterface $form_factory,   EntityManagerInterface $entity_manager, \Twig_Environment $twig, RouterInterface $router) {

		$form = $form_factory->create(InvoiceType::class, $invoice);
		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid()) {
			$entity_manager->persist($invoice);
			$entity_manager->flush();

			$route = $router->generate('admin.invoice.edit', ['invoice' => $invoice->getId()]);

			return new RedirectResponse($route);
		}

		return new Response($twig->render('admin/invoice/edit.html.twig', [
			'form' => $form->createView(),
			'invoice' => $invoice
		]));
	}
}