<?php

namespace Sample\Domain\Tests\Product\Command\Handler;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;
use PHPUnit\Framework\TestCase;
use Sample\Domain\Product\ProductRepository;

class ProductRepositoryTest extends TestCase
{
    public function testCreate()
    {
        $dbal = $provider = $this->prophesize(Connection::class);
        $repository = new ProductRepository($dbal->reveal());

        $query = (new QueryBuilder($dbal->reveal()))
            ->select('*')
            ->from('Product', 'a')
        ;

        $this->assertEquals($query, $repository->findAllQuery());
    }
}
