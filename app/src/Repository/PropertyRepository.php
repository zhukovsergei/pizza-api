<?php

namespace App\Repository;

use App\Entity\Pizza\Pizza;
use App\Entity\Property\Property;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;


class PropertyRepository
{
    private $em;
    /**
     * @var \Doctrine\ORM\EntityRepository
     */
    private $repo;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->repo = $em->getRepository(Property::class);
    }

    public function add(Property $property): void
    {
        $this->em->persist($property);
    }

    public function get($id): Property
    {
        /** @var Property $property */
        if (!$property = $this->repo->find($id)) {
            throw new EntityNotFoundException('Pizza is not found.');
        }
        return $property;
    }

    // /**
    //  * @return Pizza[] Returns an array of Pizza objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Pizza
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
