<?php

namespace App\Controller\Admin;

use App\Entity\UserHistory;
use App\Form\UserHistoryType;
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
 * @Route("admin/userHistory/")
 *
 * Class UserHistoryController
 * @package App\Controller\Admin
 */
class UserHistoryController {

	/**
	 * @Route("list", name="admin.userHistory.list")
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
		$userHistorys = $entity_manager->getRepository(UserHistory::class)->findAll();

		return new Response($twig->render('admin/userHistory/list.html.twig', [
			'userHistorys' => $userHistorys
		]));
	}

	public function add() {
	}

	/**
	 * @Route("edit/{userHistory}", name="admin.userHistory.edit")
	 *
	 * @param UserHistory                   $userHistory
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
	public function edit(UserHistory $userHistory, Request $request, FormFactoryInterface $form_factory,   EntityManagerInterface $entity_manager, \Twig_Environment $twig, RouterInterface $router) {

		$form = $form_factory->create(UserHistoryType::class, $userHistory);
		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid()) {
			$entity_manager->persist($userHistory);
			$entity_manager->flush();

			$route = $router->generate('admin.userHistory.edit', ['userHistory' => $userHistory->getId()]);

			return new RedirectResponse($route);
		}

		return new Response($twig->render('admin/userHistory/edit.html.twig', [
			'form' => $form->createView(),
			'userHistory' => $userHistory
		]));
	}
}