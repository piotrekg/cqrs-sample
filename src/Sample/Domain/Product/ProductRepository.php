<?php

namespace Sample\Domain\Product;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;
use Sample\ProductBundle\Entity\Product;

class ProductRepository
{
    /**
     * @var Connection
     */
    private $dbal;

    /**
     * @param Connection $dbal
     */
    public function __construct(Connection $dbal)
    {
        $this->dbal = $dbal;
    }

    /**
     * Prepere find all products query.
     *
     * @return string
     */
    public function findAllQuery()
    {
        $qb = new QueryBuilder($this->dbal);

        return $qb
            ->select('*')
            ->from('Product', 'a')
        ;
    }
}
