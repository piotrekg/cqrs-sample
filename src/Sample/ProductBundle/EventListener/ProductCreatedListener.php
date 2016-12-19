<?php

namespace Sample\ProductBundle\EventListener;

use Sample\Domain\Event\ProductCreatedEvent;

class ProductCreatedListener
{
    private $mailer;
    private $trans;

    public function __construct($mailer, $trans)
    {
        $this->mailer = $mailer;
        $this->trans = $trans;
    }

    public function onProductCreated(ProductCreatedEvent $event)
    {
        $product = $event->getProduct();

        $this->mailer->send(
            $this->trans->trans('product.created.subject', [], 'notification'),
            $this->trans->trans('product.created.content', [
                '%name%' => $product->getName(),
                '%price%' => $product->getPrice(),
                '%description%' => $product->getDescription(),
            ], 'notification')
        );
    }
}
