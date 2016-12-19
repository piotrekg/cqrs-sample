<?php

namespace Sample\ProductBundle\Controller;

use League\Tactician\CommandBus;
use Sample\Domain\Event\ProductCreatedEvent;
use Sample\Domain\Product\Command\CreateCommand;
use Sample\ProductBundle\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductAdminController extends Controller
{
    /**
     * @param Request $request
     *
     * @return Response
     */
    public function createAction(Request $request)
    {
        $form = $this->createForm(ProductType::class, null);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $product = $form->getData();

            $command = new CreateCommand(
                $product->getId(),
                $product->getName(),
                $product->getPrice(),
                $product->getDescription(),
                $product->getCreatedAt()
            );

            $this->get('tactician.commandbus')->handle($command);
            $this->get('event_dispatcher')->dispatch(
                ProductCreatedEvent::NAME,
                new ProductCreatedEvent($product)
            );

            $this->addFlash(
                'notice',
                'product.created'
            );

            return $this->redirectToRoute('product_admin_create');
        }

        return $this->render('admin/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
