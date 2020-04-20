<?php

declare(strict_types=1);

namespace App\Console;

use Doctrine\Bundle\DoctrineBundle\Command\Proxy\UpdateSchemaDoctrineCommand;
use Doctrine\DBAL\DBALException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RollbackUpdateUsersTableCommand extends UpdateSchemaDoctrineCommand
{
    private const NAME = 'app:users:rollback';

    /**
     * @var string
     */
    protected static $defaultName = self::NAME;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;

        parent::__construct();
    }

    protected function configure(): void
    {
        parent::configure();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null
     * @throws DBALException
     */
    protected function execute(InputInterface $input, OutputInterface $output): ?int
    {
        $output->writeln('Success!');
        $connection = $this->entityManager->getConnection();

        $connection->exec('ALTER TABLE users DROP COLUMN locale');

        return parent::execute($input, $output);
    }
}