<?php

namespace Sample\Domain\Event;

use Sample\Domain\Product\Product;
use Symfony\Component\EventDispatcher\Event;

class ProductCreatedEvent extends Event
{
    const NAME = 'product.created';

    /**
     * @var Product
     */
    private $product;

    /**
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Gets the value of product.
     *
     * @return Product
     */
    public function getProduct() : Product
    {
        return $this->product;
    }
}
