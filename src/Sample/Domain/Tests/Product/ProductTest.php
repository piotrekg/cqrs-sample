<?php

namespace Sample\Domain\Tests\Product;

use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Sample\Domain\Product\Product;

class ProductTest extends TestCase
{
    public function testConstructor()
    {
        $product = new Product(
            'test',
            12.12,
            'lorem'
        );

        $this->assertTrue(Uuid::isValid($product->getId()));
        $this->assertEquals('test', $product->getName());
        $this->assertEquals(12.12, $product->getPrice());
        $this->assertEquals('lorem', $product->getDescription());
    }
}
