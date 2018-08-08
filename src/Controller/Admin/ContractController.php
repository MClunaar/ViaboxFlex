<?php

namespace App\Controller\Admin;

use App\Entity\Contract;
use App\Form\ContractType;
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
 * @Route("admin/contract/")
 *
 * Class ContractController
 * @package App\Controller\Admin
 */
class ContractController {

	/**
	 * @Route("list", name="admin.contract.list")
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
		$contracts = $entity_manager->getRepository(Contract::class)->findAll();

		return new Response($twig->render('admin/contract/list.html.twig', [
			'contracts' => $contracts
		]));
	}

	public function add() {
	}

	/**
	 * @Route("edit/{contract}", name="admin.contract.edit")
	 *
	 * @param Contract                   $contract
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
	public function edit(Contract $contract, Request $request, FormFactoryInterface $form_factory,   EntityManagerInterface $entity_manager, \Twig_Environment $twig, RouterInterface $router) {

		$form = $form_factory->create(ContractType::class, $contract);
		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid()) {
			$entity_manager->persist($contract);
			$entity_manager->flush();

			$route = $router->generate('admin.contract.edit', ['contract' => $contract->getId()]);

			return new RedirectResponse($route);
		}

		return new Response($twig->render('admin/contract/edit.html.twig', [
			'form' => $form->createView(),
			'contract' => $contract
		]));
	}
}