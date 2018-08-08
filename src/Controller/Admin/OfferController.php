<?php

namespace App\Controller\Admin;

use App\Entity\Offer;
use App\Form\OfferType;
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
 * @Route("admin/offer/")
 *
 * Class OfferController
 * @package App\Controller\Admin
 */
class OfferController {

	/**
	 * @Route("list", name="admin.offer.list")
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
		$offers = $entity_manager->getRepository(Offer::class)->findAll();

		return new Response($twig->render('admin/offer/list.html.twig', [
			'offers' => $offers
		]));
	}

	public function add() {
	}

	/**
	 * @Route("edit/{offer}", name="admin.offer.edit")
	 *
	 * @param Offer                   $offer
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
	public function edit(Offer $offer, Request $request, FormFactoryInterface $form_factory,   EntityManagerInterface $entity_manager, \Twig_Environment $twig, RouterInterface $router) {

		$form = $form_factory->create(OfferType::class, $offer);
		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid()) {
			$entity_manager->persist($offer);
			$entity_manager->flush();

			$route = $router->generate('admin.offer.edit', ['offer' => $offer->getId()]);

			return new RedirectResponse($route);
		}

		return new Response($twig->render('admin/offer/edit.html.twig', [
			'form' => $form->createView(),
			'offer' => $offer
		]));
	}
}