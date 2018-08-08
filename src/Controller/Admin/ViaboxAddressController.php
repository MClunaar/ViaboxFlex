<?php


namespace App\Controller\Admin;

use App\Entity\ViaboxAddress  ;
use App\Form\ViaboxAddressType;
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
 * @Route("admin/viaboxAddress/")
 *
 * Class ViaboxAddressController
 * @package App\Controller\Admin
 */
class ViaboxAddressController {

    /**
     * @Route("list", name="admin.viaboxAddress.list")
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
        $viaboxAddresses = $entity_manager->getRepository(ViaboxAddress::class)->findAll();

        return new Response($twig->render('admin/viaboxAddress/list.html.twig', [
            'viaboxAddresses' => $viaboxAddresses
        ]));
    }

    public function add() {
    }

    /**
     * @Route("edit/{viaboxAddress}", name="admin.viaboxAddress.edit")
     *
     * @param ViaboxAddress             $viaboxAddress
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
    public function edit(ViaboxAddress $viaboxAddress, Request $request, FormFactoryInterface $form_factory, EntityManagerInterface $entity_manager, \Twig_Environment $twig, RouterInterface $router) {

        $form = $form_factory->create(ViaboxAddressType::class, $viaboxAddress);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $entity_manager->persist($viaboxAddress);
            $entity_manager->flush();

            $route = $router->generate('admin.viaboxAddress.edit', ['viaboxAddress' => $viaboxAddress->getId()]);

            return new RedirectResponse($route);
        }

        return new Response($twig->render('admin/viaboxAddress/edit.html.twig', [
            'form' => $form->createView(),
            'ViaboxAddress' => $viaboxAddress
        ]));
    }
}
