<?php

namespace App\Controller\Admin;

use App\Entity\ScanOption   ;
use App\Form\ScanOptionType;
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
 * @Route("admin/scanOption/")
 *
 * Class ScanOptionController
 * @package App\Controller\Admin
 */
class ScanOptionController {

    /**
     * @Route("list", name="admin.scanOption.list")
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
        $scanOptions = $entity_manager->getRepository(ScanOption::class)->findAll();

        return new Response($twig->render('admin/scanOption/list.html.twig', [
            'scanOptions' => $scanOptions
        ]));
    }

    public function add() {
    }

    /**
     * @Route("edit/{scanOption}", name="admin.scanOption.edit")
     *
     * @param ScanOption             $scanOption
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
    public function edit(ScanOption $scanOption, Request $request, FormFactoryInterface $form_factory, EntityManagerInterface $entity_manager, \Twig_Environment $twig, RouterInterface $router) {

        $form = $form_factory->create(ScanOptionType::class, $scanOption);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $entity_manager->persist($scanOption);
            $entity_manager->flush();

            $route = $router->generate('admin.scanOption.edit', ['scanOption' => $scanOption->getId()]);

            return new RedirectResponse($route);
        }

        return new Response($twig->render('admin/scanOption/edit.html.twig', [
            'form' => $form->createView(),
            'scanOptions' => $scanOption
        ]));
    }
}
