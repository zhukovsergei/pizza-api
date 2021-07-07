<?php

declare(strict_types=1);

namespace App\ReadModel\Pizza;

use Doctrine\DBAL\Connection;

class PriceFetcher
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
                'pz.name AS pizza_name',
                'prop.name AS property_name',
                't.price'
            )
            ->from('prices', 't')
            ->innerJoin('t', 'pizzas', 'pz', 't.pizza_id = pz.id')
            ->innerJoin('t', 'properties', 'prop', 't.property_id = prop.id')
            ->execute();

        return $stmt->fetchAllAssociative();
    }

}

