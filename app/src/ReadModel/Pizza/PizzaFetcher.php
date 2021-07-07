<?php

declare(strict_types=1);

namespace App\ReadModel\Pizza;

use Doctrine\DBAL\Connection;

class PizzaFetcher
{
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function findAll(): array
    {
        $stmt = $this->connection->createQueryBuilder()
            ->select(
                'id',
                'name'
            )
            ->from('pizzas')
            ->orderBy('name')
            ->execute();

        return $stmt->fetchAllKeyValue();
    }

}

