<?php

namespace App\Controller\Admin;

use App\Entity\Production;
use App\Form\ProductionType;
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
 * @Route("admin/production/")
 *
 * Class ProductionController
 * @package App\Controller\Admin
 */
class ProductionController {

	/**
	 * @Route("list", name="admin.production.list")
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
		$productions = $entity_manager->getRepository(Production::class)->findAll();

		return new Response($twig->render('admin/production/list.html.twig', [
			'productions' => $productions
		]));
	}

	public function add() {
	}

	/**
	 * @Route("edit/{production}", name="admin.production.edit")
	 *
	 * @param Production                   $production
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
	public function edit(Production $production, Request $request, FormFactoryInterface $form_factory,   EntityManagerInterface $entity_manager, \Twig_Environment $twig, RouterInterface $router) {

		$form = $form_factory->create(ProductionType::class, $production);
		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid()) {
			$entity_manager->persist($production);
			$entity_manager->flush();

			$route = $router->generate('admin.production.edit', ['production' => $production->getId()]);

			return new RedirectResponse($route);
		}

		return new Response($twig->render('admin/production/edit.html.twig', [
			'form' => $form->createView(),
			'production' => $production
		]));
	}
}