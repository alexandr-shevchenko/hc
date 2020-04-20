<?php

declare(strict_types=1);

namespace App\Console;

use Doctrine\Bundle\DoctrineBundle\Command\Proxy\UpdateSchemaDoctrineCommand;
use Doctrine\DBAL\DBALException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateUsersTableCommand extends UpdateSchemaDoctrineCommand
{
    private const NAME = 'app:users:update';

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

        $connection->beginTransaction();
        $connection->exec('LOCK TABLE users IN SHARE MODE;');

        try {
            $connection->exec('
                CREATE TABLE new_users AS
                SELECT id, name, date_of_birth, email, avatar, \'EN\' AS locale
                FROM users;
                
                ALTER TABLE new_users ALTER COLUMN locale TYPE VARCHAR(6);
                
                DROP TABLE users;
                ALTER TABLE new_users RENAME TO users;
            ');

            $connection->commit();
        } catch (Throwable $e) {
            $connection->rollBack();

            throw $e;
        }


        return parent::execute($input, $output);
    }
}