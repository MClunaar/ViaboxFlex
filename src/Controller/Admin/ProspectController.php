<?php

namespace App\Controller\Admin;

use App\Entity\Prospect;
use App\Form\ProspectType;
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
 * @Route("admin/prospect/")
 *
 * Class ProspectController
 * @package App\Controller\Admin
 */
class ProspectController {

	/**
	 * @Route("list", name="admin.prospect.list")
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
		$prospects = $entity_manager->getRepository(Prospect::class)->findAll();

		return new Response($twig->render('admin/prospect/list.html.twig', [
			'prospects' => $prospects
		]));
	}

	public function add() {
	}

	/**
	 * @Route("edit/{prospect}", name="admin.prospect.edit")
	 *
	 * @param Prospect                   $prospect
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
	public function edit(Prospect $prospect, Request $request, FormFactoryInterface $form_factory,   EntityManagerInterface $entity_manager, \Twig_Environment $twig, RouterInterface $router) {

		$form = $form_factory->create(ProspectType::class, $prospect);
		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid()) {
			$entity_manager->persist($prospect);
			$entity_manager->flush();

			$route = $router->generate('admin.prospect.edit', ['prospect' => $prospect->getId()]);

			return new RedirectResponse($route);
		}

		return new Response($twig->render('admin/prospect/edit.html.twig', [
			'form' => $form->createView(),
			'prospect' => $prospect
		]));
	}
}