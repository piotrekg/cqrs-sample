<?php

namespace Sample\Domain\Tests\Product\Command\Handler;

use Doctrine\DBAL\Connection;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Ramsey\Uuid\Uuid;
use Sample\Domain\Product\Command\CreateCommand;
use Sample\Domain\Product\Command\Handler\CreateHandler;

class CreateHandlerTest extends TestCase
{
    public function testCreate()
    {
        $dbal = $provider = $this->prophesize(Connection::class);

        $command = new CreateCommand(
            Uuid::uuid4(),
            'test',
            12.12,
            'lorem',
            new \DateTime()
        );

        $handler = new CreateHandler($dbal->reveal());
        $handler->handle($command);

        $dbal
            ->insert(
                Argument::exact('product'),
                Argument::exact([
                    'id' => $command->getId(),
                    'name' => $command->getName(),
                    'price' => $command->getPrice(),
                    'description' => $command->getDescription(),
                    'created_at' => $command->getCreatedAt(),
                ]),
                Argument::exact([
                    \PDO::PARAM_STR,
                    \PDO::PARAM_STR,
                    \PDO::FETCH_NUM,
                    \PDO::PARAM_STR,
                    'datetime',
                ])
            )
            ->shouldBeCalledTimes(1)
        ;
    }
}
