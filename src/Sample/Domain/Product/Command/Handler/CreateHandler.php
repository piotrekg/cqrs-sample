<?php

namespace Sample\Domain\Product\Command\Handler;

use Doctrine\DBAL\Connection;
use Sample\Domain\Product\Command\CreateCommand;

class CreateHandler
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
     * Handle create command.
     *
     * @param CreateCommand $command
     */
    public function handle(CreateCommand $command)
    {
        $this->dbal->insert('product', [
            'id' => $command->getId(),
            'name' => $command->getName(),
            'price' => $command->getPrice(),
            'description' => $command->getDescription(),
            'created_at' => $command->getCreatedAt(),
        ], [
            \PDO::PARAM_STR,
            \PDO::PARAM_STR,
            \PDO::FETCH_NUM,
            \PDO::PARAM_STR,
            'datetime',
        ]);
    }
}
