<?php

namespace Sample\Domain\Tests\Product\Command;

use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Sample\Domain\Product\Command\CreateCommand;

class CreateCommandTest extends TestCase
{
    public function testConstructor()
    {
        $id = Uuid::uuid4();
        $createdAd = new \DateTime();
        $command = new CreateCommand(
            $id,
            'test',
            12.12,
            'lorem',
            $createdAd
        );

        $this->assertTrue(Uuid::isValid($command->getId()));
        $this->assertEquals($id, $command->getId());
        $this->assertEquals('test', $command->getName());
        $this->assertEquals(12.12, $command->getPrice());
        $this->assertEquals('lorem', $command->getDescription());
        $this->assertEquals($createdAd, $command->getCreatedAt());
    }
}
