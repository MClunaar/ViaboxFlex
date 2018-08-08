<?php

namespace App\Controller\Admin;

use App\Entity\Customer   ;
use App\Form\CustomerType;
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
 * @Route("admin/customer/")
 *
 * Class CustomerController
 * @package App\Controller\Admin
 */
class CustomerController {

    /**
     * @Route("list", name="admin.customer.list")
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
        $customers = $entity_manager->getRepository(Customer::class)->findAll();

        return new Response($twig->render('admin/customer/list.html.twig', [
            'customers' => $customers
        ]));
    }

    public function add() {
    }

    /**
     * @Route("edit/{customer}", name="admin.customer.edit")
     *
     * @param Customer             $customer
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
    public function edit(Customer $customer, Request $request, FormFactoryInterface $form_factory, EntityManagerInterface $entity_manager, \Twig_Environment $twig, RouterInterface $router) {

        $form = $form_factory->create(CustomerType::class, $customer);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $entity_manager->persist($customer);
            $entity_manager->flush();

            $route = $router->generate('admin.customer.edit', ['customer' => $customer->getId()]);

            return new RedirectResponse($route);
        }

        return new Response($twig->render('admin/customer/edit.html.twig', [
            'form' => $form->createView(),
            'customers' => $customer
        ]));
    }
}
