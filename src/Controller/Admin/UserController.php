<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\UserType;
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
 * @Route("admin/user/")
 *
 * Class UserController
 * @package App\Controller\Admin
 */
class UserController {

	/**
	 * @Route("list", name="admin.user.list")
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
		$users = $entity_manager->getRepository(User::class)->findAll();

		return new Response($twig->render('admin/user/list.html.twig', [
			'users' => $users
		]));
	}

	public function add() {
	}

	/**
	 * @Route("edit/{user}", name="admin.user.edit")
	 *
	 * @param User                   $user
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
	public function edit(User $user, Request $request, FormFactoryInterface $form_factory,   EntityManagerInterface $entity_manager, \Twig_Environment $twig, RouterInterface $router) {

		$form = $form_factory->create(UserType::class, $user);
		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid()) {
			$entity_manager->persist($user);
			$entity_manager->flush();

			$route = $router->generate('admin.user.edit', ['user' => $user->getId()]);

			return new RedirectResponse($route);
		}

		return new Response($twig->render('admin/user/edit.html.twig', [
			'form' => $form->createView(),
			'user' => $user
		]));
	}
}