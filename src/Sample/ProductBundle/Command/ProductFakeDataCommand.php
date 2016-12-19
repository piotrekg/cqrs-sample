<?php

namespace Sample\ProductBundle\Command;

use Faker;
use Ramsey\Uuid\Uuid;
use Sample\Domain\Product\Command\CreateCommand;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ProductFakeDataCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('product:fake-data')
            ->setDescription('Fake product data')
            ->addOption('limit', null, InputOption::VALUE_OPTIONAL, 'Numer of fake rows to generate', 100)
        ;
    }

    /**
     * @param InputInterface  $input  [description]
     * @param OutputInterface $output [description]
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $limit = (int) $input->getOption('limit');
        $faker = Faker\Factory::create();
        $commandBus = $this->getContainer()->get('tactician.commandbus');

        $progress = new ProgressBar($output, 10);
        $progress->start();
        for ($i = 0; $i < $limit; ++$i) {
            $command = new CreateCommand(
                Uuid::fromString($faker->uuid()),
                $faker->word(),
                $faker->randomNumber(2),
                $faker->paragraph(),
                $faker->dateTime()
            );

            $commandBus->handle($command);
            $progress->advance();
        }

        $progress->finish();
        $progress->setMessage('Task is finished');
    }
}
