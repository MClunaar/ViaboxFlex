<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use App\Form\ProductType;
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
 * @Route("admin/product/")
 *
 * Class ProductController
 * @package App\Controller\Admin
 */
class ProductController {

    /**
     * @Route("list", name="admin.product.list")
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
        $products = $entity_manager->getRepository(Product::class)->findAll();

        return new Response($twig->render('admin/product/list.html.twig', [
            'products' => $products
        ]));
    }

    public function add() {
    }

    /**
     * @Route("edit/{product}", name="admin.product.edit")
     *
     * @param Product                $product
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
    public function edit(Product $product, Request $request, FormFactoryInterface $form_factory, EntityManagerInterface $entity_manager, \Twig_Environment $twig, RouterInterface $router) {

        $form = $form_factory->create(ProductType::class, $product);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $entity_manager->persist($product);
            $entity_manager->flush();

            $route = $router->generate('admin.product.edit', ['product' => $product->getId()]);

            return new RedirectResponse($route);
        }

        return new Response($twig->render('admin/product/edit.html.twig', [
            'form' => $form->createView(),
            'product' => $product
        ]));
    }
}