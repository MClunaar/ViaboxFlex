<?php

namespace App\Controller\Admin;

use App\Entity\MailOption   ;
use App\Form\MailOptionType;
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
 * @Route("admin/mailOption/")
 *
 * Class MailOptionController
 * @package App\Controller\Admin
 */
class MailOptionController {

    /**
     * @Route("list", name="admin.mailOption.list")
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
        $mailOptions = $entity_manager->getRepository(MailOption::class)->findAll();

        return new Response($twig->render('admin/mailOption/list.html.twig', [
            'mailOptions' => $mailOptions
        ]));
    }

    public function add() {
    }

    /**
     * @Route("edit/{mailOption}", name="admin.mailOption.edit")
     *
     * @param MailOption             $mailOption
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
    public function edit(MailOption $mailOption, Request $request, FormFactoryInterface $form_factory, EntityManagerInterface $entity_manager, \Twig_Environment $twig, RouterInterface $router) {

        $form = $form_factory->create(MailOptionType::class, $mailOption);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $entity_manager->persist($mailOption);
            $entity_manager->flush();

            $route = $router->generate('admin.mailOption.edit', ['mailOption' => $mailOption->getId()]);

            return new RedirectResponse($route);
        }

        return new Response($twig->render('admin/mailOption/edit.html.twig', [
            'form' => $form->createView(),
            'mailOptions' => $mailOption
        ]));
    }
}
