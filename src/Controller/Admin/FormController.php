<?php

namespace App\Controller\Admin;

use App\Entity\Form;
use App\Form\FormType;
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
 * @Route("admin/form/")
 *
 * Class FormController
 * @package App\Controller\Admin
 */
class FormController {

    /**
     * @Route("list", name="admin.form.list")
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
        $forms = $entity_manager->getRepository(Form::class)->findAll();

        return new Response($twig->render('admin/form/list.html.twig', [
            'forms' => $forms
        ]));
    }

    public function add() {
    }

    /**
     * @Route("edit/{formEntity}", name="admin.form.edit")
     *
     * @param Form                   $formEntity
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
    public function edit(Form $formEntity, Request $request, FormFactoryInterface $form_factory, EntityManagerInterface $entity_manager, \Twig_Environment $twig, RouterInterface $router) {

        $form = $form_factory->create(FormType::class, $formEntity);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $entity_manager->persist($formEntity);
            $entity_manager->flush();

            $route = $router->generate('admin.form.edit', ['formEntity' => $formEntity->getId()]);

            return new RedirectResponse($route);
        }

        return new Response($twig->render('admin/form/edit.html.twig', [
            'form' => $form->createView(),
            'formEntity' => $formEntity
        ]));
    }
}