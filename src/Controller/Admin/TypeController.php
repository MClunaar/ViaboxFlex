<?php

namespace App\Controller\Admin;

use App\Entity\Type;
use App\Form\TypeType;
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
 * @Route("admin/type/")
 *
 * Class TypeController
 * @package App\Controller\Admin
 */
class TypeController {

	/**
	 * @Route("list", name="admin.type.list")
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
		$types = $entity_manager->getRepository(Type::class)->findAll();

		return new Response($twig->render('admin/type/list.html.twig', [
			'types' => $types
		]));
	}

	public function add() {
	}

	/**
	 * @Route("edit/{type}", name="admin.type.edit")
	 *
	 * @param Type                   $type
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
	public function edit(Type $type, Request $request, FormFactoryInterface $form_factory,   EntityManagerInterface $entity_manager, \Twig_Environment $twig, RouterInterface $router) {

		$form = $form_factory->create(TypeType::class, $type);
		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid()) {
			$entity_manager->persist($type);
			$entity_manager->flush();

			$route = $router->generate('admin.type.edit', ['type' => $type->getId()]);

			return new RedirectResponse($route);
		}

		return new Response($twig->render('admin/type/edit.html.twig', [
			'form' => $form->createView(),
			'type' => $type
		]));
	}
}