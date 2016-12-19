<?php

namespace ProductBundle\Controller;

use Sample\Domain\Product\Command\CreateCommand;
use Sample\Domain\Product\Product;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProductControllerTest extends WebTestCase
{
    private $container;

    public function setUp()
    {
        self::bootKernel();

        $this->container = self::$kernel->getContainer();
    }

    public function testList()
    {
        $product = new Product(
            'product name',
            12.12,
            'product description'

        );

        $command = new CreateCommand(
            $product->getId(),
            $product->getName(),
            $product->getPrice(),
            $product->getDescription(),
            $product->getCreatedAt()
        );

        // @TOTO use test connection
        $this->container->get('doctrine.dbal.write_connection')->query('TRUNCATE TABLE product');
        $this->container->get('tactician.commandbus')->handle($command);

        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertContains($product->getId()->toString(), $client->getResponse()->getContent());
        $this->assertContains($product->getName(), $client->getResponse()->getContent());
    }
}
