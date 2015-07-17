<?php

namespace Command;

use Repositories\EventRepository;
use Repositories\IceCreamRepository;
use Services\IceCreamService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ParseIceCreamCommand extends Command
{
    /**
     * @var Connection
     */
    protected $connection;

    /**
     * Configure command
     */
    protected function configure()
    {
        $this->setName('parse:icecream');
    }

    /**
     * Execute command
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $iceCreamService = new IceCreamService(new IceCreamRepository($this->getConnection()), new EventRepository($this->getConnection()));
        $iceCreamService->processEvents();
    }

    /**
     * @return Connection
     */
    protected function getConnection()
    {
        if ($this->connection !== null) {
            return $this->connection;
        }
        $connection = $this->getHelper('connection');
        $this->connection = $connection->getConnection();

        return $this->connection;
    }
}
